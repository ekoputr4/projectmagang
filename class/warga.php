<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Warga
{

    var $wrg_id,$wrg_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "warga";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kewarganegaraan", $this->wrg_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterWarga()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->wrg_name;
		$this->wrg_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->wrg_id		= $this->data['wrg_id'];   
         $this->wrg_name 	= $this->data['wrg_name'];   
	}

	function existWarga($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where wrg_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getWarga($txt_id,$db) 
    {
       if (! $this->existWarga($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delWarga($txt_id,$db) 
	{
       if ($this->existWarga($txt_id,$db)) {
	       $sqlstr = "select wrg_id from karyawan where wrg_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where wrg_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Warga masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveWarga($db) 
	{   
	  $this->filterWarga();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existWarga($this->wrg_id,$db)) {
  	         $sqlstr = "update $this->tablename set wrg_name='".safeString($this->wrg_name)."'
		        where wrg_id='".safeString($this->wrg_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(wrg_name) 
		        values ('".safeString($this->wrg_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->wrg_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>