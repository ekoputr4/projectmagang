<?
/*
  Write : Onix
  Last Modified : July 11, 2009
*/

class UserPriv
{

    var $user_id,$group_id,$value;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "user_priv";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("User", $this->user_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Group", $this->group_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Level", $this->value, "number", "n", 0, 0, 1);
	   if ($example->validation()) {
	        return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterUserPriv()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->user_id;
		$this->user_id			= $myFilter->process($before);
		$before 				= $this->group_id;
		$this->group_id			= $myFilter->process($before);
		$before 				= $this->value;
		$this->value			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->user_id	 		= $this->data['user_id']; 
         $this->group_id		= $this->data['group_id'];   
	     $this->value			= $this->data['value'];
	}

	function existUserPriv($txt_id,$txt_id2,$db) 
	{
	   $sqlstr = "select * from $this->tablename where user_id='".safeString($txt_id)."'
	   	and group_id='".safeString($txt_id2)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getUserPriv($txt_id,$txt_id2,$db) 
    {
       if (! $this->existUserPriv($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delUserPriv($txt_id,$txt_id2,$db) 
	{
       if ($this->existUserPriv($txt_id,$txt_id2,$db)) {
		   $sqlstr = "delete from $this->tablename where user_id='".safeString($txt_id)."'";
		   if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    
			}
											  
		   if (! $result) { 
			  return False;
			} else { 
			  return True;
			}  
	   } else {
	       $this->error = "User Priv not found";
	       return False;
	   }
	}


	function saveUserPriv($db) 
	{   
	  $this->filterUserPriv();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existUserPriv($this->user_id,$this->group_id,$db)) {
  	         $sqlstr = "update $this->tablename set value='".safeString($this->value)."'
		        where user_id='".safeString($this->user_id)."'
					and group_id='".safeString($this->group_id)."'";
	       } else {
			 $sqlstr = "insert into $this->tablename(user_id,group_id,value) 
		        values ('".safeString($this->user_id)."',
		        '".safeString($this->group_id)."',
		        '".safeString($this->value)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
       }
	} 
}

?>