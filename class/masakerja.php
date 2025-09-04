<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MasaKerja
{

    var $masa_id,$masa_name,$masa_time;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "masakerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama", $this->masa_name, "text", "y", 30, 2);
	   $example->add_num_field("Pengingat", $this->masa_time, "number", "y", 1, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasaKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->masa_name;
		$this->masa_name	= $myFilter->process($before);
		$before 			= $this->masa_time;
		$this->masa_time	= $myFilter->process($before);
	}


	function getData()
	{
         $this->masa_id		= $this->data['masa_id'];   
         $this->masa_name 	= $this->data['masa_name'];   
         $this->masa_time 	= $this->data['masa_time'];   
	}

	function existMasaKerja($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where masa_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasaKerja($txt_id,$db) 
    {
       if (! $this->existMasaKerja($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delMasaKerja($txt_id,$db) 
	{
       if ($this->existMasaKerja($txt_id,$db)) {
/*	       $sqlstr = "select masa_id from karyawan where masa_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where masa_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "MasaKerja masih digunakan pada Karyawan";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMasaKerja($db) 
	{   
	  $this->filterMasaKerja();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasaKerja($this->masa_id,$db)) {
  	         $sqlstr = "update $this->tablename set masa_name='".safeString($this->masa_name)."',
			 masa_time='".safeString($this->masa_time)."'
		        where masa_id='".safeString($this->masa_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(masa_name,masa_time) 
		        values ('".safeString($this->masa_name)."',
		        '".safeString($this->masa_time)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->masa_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>