<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Kendaraan
{

    var $kend_id,$kend_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "kendaraan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Jenis Kendaraan", $this->kend_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKendaraan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->kend_name;
		$this->kend_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->kend_id		= $this->data['kend_id'];   
         $this->kend_name 	= $this->data['kend_name'];   
	}

	function existKendaraan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kend_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKendaraan($txt_id,$db) 
    {
       if (! $this->existKendaraan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKendaraan($txt_id,$db) 
	{
       if ($this->existKendaraan($txt_id,$db)) {
	       $sqlstr = "select kend_id from kendaraan_karyawan where kend_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where kend_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Kendaraan masih digunakan pada data karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveKendaraan($db) 
	{   
	  $this->filterKendaraan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKendaraan($this->kend_id,$db)) {
  	         $sqlstr = "update $this->tablename set kend_name='".safeString($this->kend_name)."'
		        where kend_id='".safeString($this->kend_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kend_name) 
		        values ('".safeString($this->kend_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->kend_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>