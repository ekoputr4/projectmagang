<?
/*
  Write : Onix
  Last Modified : Nov 05, 2008
*/

class PraOP
{

    var $session,$jenis_op,$user_id,$date_need;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "pra_op";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Session Key", $this->session, "text", "y", 32, 32);
	   $example->add_num_field("Jenis OP", $this->jenis_op, "text", "y", 0, 0, 1);
	   $example->add_num_field("User ID", $this->user_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Tgl Butuh", $this->date_need, "text", "n",  20, 10);
	   if ($example->validation()) {
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 



	function filterPraOP()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->session;
		$this->session		= $myFilter->process($before);
		$before 			= $this->jenis_op;
		$this->jenis_op		= $myFilter->process($before);
		$before 			= $this->user_id;
		$this->user_id 		= $myFilter->process($before);
		$before 			= $this->date_need;
		$this->date_need	= $myFilter->process($before);
	}


	function getData()
	{
         $this->session	 		= $this->data['session'];   
         $this->jenis_op		= $this->data['jenis_op'];   
	     $this->user_id			= $this->data['user_id'];
	     $this->date_need		= $this->data['date_need'];
	}

	function existPraOP($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where user_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getPraOP($txt_id,$db) 
    {
       if (! $this->existPraOP($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }


	function delPraOP($txt_id,$db) 
	{
       if ($this->existPraOP($txt_id,$db)) {
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
	       $this->error = "Data is not exist";
	       return False;
	   }
	}

	function savePraOP($db) 
	{   
	  $this->filterPraOP();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPraOP($this->user_id,$db)) {
  	         $sqlstr = "update $this->tablename set jenis_op='".safeString($this->jenis_op)."',
			  session='".safeString($this->session)."',
			  date_need='".safeString(date("Y-m-d H:i:s"))."'
		        where user_id='".safeString($this->user_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(session,jenis_op,user_id,date_need) 
		        values ('".safeString($this->session)."',
				'".safeString($this->jenis_op)."',
				'".safeString($this->user_id)."',
		        '".safeString(date("Y-m-d H:i:s"))."')";
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