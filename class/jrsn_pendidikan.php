<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class JrsnPendidikan
{

    var $jrsn_id,$pend_id,$jrsn_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "jrsn_pendidikan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Jurusan", $this->jrsn_name, "text", "y", 50, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterJrsnPendidikan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->pend_id;
		$this->pend_id		= $myFilter->process($before);
		$before 			= $this->jrsn_name;
		$this->jrsn_name	= $myFilter->process($before);
	}


	function getData()
	{
         $this->jrsn_id		= $this->data['jrsn_id'];   
         $this->pend_id		= $this->data['pend_id'];   
         $this->jrsn_name 	= $this->data['jrsn_name'];   
	}

	function existJrsnPendidikan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where jrsn_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getJrsnPendidikan($txt_id,$db) 
    {
       if (! $this->existJrsnPendidikan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delJrsnPendidikan($txt_id,$db) 
	{
       if ($this->existJrsnPendidikan($txt_id,$db)) {
	       $sqlstr = "select jrsn_id from karyawan where jrsn_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where jrsn_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Jurusan masih digunakan pada data karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveJrsnPendidikan($db) 
	{   
	  $this->filterJrsnPendidikan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existJrsnPendidikan($this->jrsn_id,$db)) {
  	         $sqlstr = "update $this->tablename set pend_id='".safeString($this->pend_id)."',
			 jrsn_name='".safeString($this->jrsn_name)."'
		        where jrsn_id='".safeString($this->jrsn_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(pend_id,jrsn_name) 
		        values ('".safeString($this->pend_id)."',
		        '".safeString($this->jrsn_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->jrsn_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>