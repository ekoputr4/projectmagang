<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class HLogin
{

    var $log_id,$tgl_login,$tgl_logout,$user_id,$ip_address;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "login_history";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("User", $this->user_id, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHLogin()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->log_id;
		$this->log_id		= $myFilter->process($before);
		$before 			= $this->tgl_logout;
		$this->tgl_logout	= $myFilter->process($before);
		$before 			= $this->tgl_login;
		$this->tgl_login	= $myFilter->process($before);
		$before 			= $this->user_id;
		$this->user_id		= $myFilter->process($before);
	}


	function getData()
	{
         $this->log_id			= $this->data['log_id'];   
         $this->tgl_login		= $this->data['tgl_login'];   
         $this->tgl_logout 		= $this->data['tgl_logout'];   
         $this->user_id 		= $this->data['user_id'];   
         $this->ip_address 		= $this->data['ip_address'];   
	}

	function existHLogin($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where log_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHLogin($txt_id,$db) 
    {
       if (! $this->existHLogin($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delHLogin($txt_id,$db) 
	{
       if ($this->existHLogin($txt_id,$db)) {
		       $sqlstr = "delete from $this->tablename where log_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveHLogin($db) 
	{   
	  $this->filterHLogin();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existHLogin($this->log_id,$db)) {
  	         $sqlstr = "update $this->tablename set tgl_logout='".safeString(date("Y-m-d H:i:s"))."'
		        where log_id='".safeString($this->log_id)."'";
	       } else {
   			  $this->new=1;
  	          $sqlstr = "insert into $this->tablename(tgl_login,user_id,ip_address) 
		        values ('".safeString(date("Y-m-d H:i:s"))."',
				'".safeString($this->user_id)."',
				'".safeString($this->ip_address)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->log_id = mysql_insert_id(); 			  
		      return True;
		    }  
       }
	} 

	function saveHLogout($db) 
	{   
	  $this->filterHLogin();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existHLogin($this->log_id,$db)) {
  	         $sqlstr = "update $this->tablename set tgl_logout='".safeString(date("Y-m-d H:i:s"))."'
		        where log_id='".safeString($this->log_id)."'";
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

}

?>