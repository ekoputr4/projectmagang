<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class StatusNikah
{

    var $nkh_id,$nkh_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "status_nikah";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Status Nikah", $this->nkh_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterStatusNikah()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->nkh_name;
		$this->nkh_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->nkh_id		= $this->data['nkh_id'];   
         $this->nkh_name 	= $this->data['nkh_name'];   
	}

	function existStatusNikah($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where nkh_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getStatusNikah($txt_id,$db) 
    {
       if (! $this->existStatusNikah($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delStatusNikah($txt_id,$db) 
	{
       if ($this->existStatusNikah($txt_id,$db)) {
	       $sqlstr = "select nkh_id from karyawan where nkh_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select nkh_id from master_ptkp where nkh_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {
				   $sqlstr = "delete from $this->tablename where nkh_id='".safeString($txt_id)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
									  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
			   } else {
				  $this->error = "Status Nikah masih digunakan pada data master ptkp";
				  return False;
			   }						
		   } else {
		      $this->error = "Status Nikah masih digunakan pada data karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveStatusNikah($db) 
	{   
	  $this->filterStatusNikah();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existStatusNikah($this->nkh_id,$db)) {
  	         $sqlstr = "update $this->tablename set nkh_name='".safeString($this->nkh_name)."'
		        where nkh_id='".safeString($this->nkh_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(nkh_name) 
		        values ('".safeString($this->nkh_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->nkh_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>