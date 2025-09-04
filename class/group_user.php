<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class GroupUser
{

    var $group_id,$group_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "group_user";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("GroupUser", $this->group_name, "text", "y", 3, 3);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterGroupUser()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->group_name;
		$this->group_name	= $myFilter->process($before);
	}


	function getData()
	{
         $this->group_id	= $this->data['group_id'];   
         $this->group_name 	= $this->data['group_name'];   
	}

	function existGroupUser($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where group_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getGroupUser($txt_id,$db) 
    {
       if (! $this->existGroupUser($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delGroupUser($txt_id,$db) 
	{
       if ($this->existGroupUser($txt_id,$db)) {
	       $sqlstr = "select group_id from user where group_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where group_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Group User masih digunakan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveGroupUser($db) 
	{   
	  $this->filterGroupUser();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existGroupUser($this->group_id,$db)) {
  	         $sqlstr = "update $this->tablename set group_name='".safeString($this->group_name)."'
		        where group_id='".safeString($this->group_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(group_name) 
		        values ('".safeString($this->group_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->group_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>