<?
/*
  Write : Onix
  Last Modified : October 12, 2008
*/

class Satuan
{

    var $satuan_id,$satuan_name;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "satuan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama", $this->satuan_name, "text", "y", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSatuan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->satuan_name;
		$this->satuan_name	= $myFilter->process($before);
	}


	function getData()
	{
         $this->satuan_id	= $this->data['satuan_id'];   
         $this->satuan_name = $this->data['satuan_name'];   
	}

	function existSatuan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where satuan_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSatuan($txt_id,$db) 
    {
       if (! $this->existSatuan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delSatuan($txt_id,$db) 
	{
       if ($this->existSatuan($txt_id,$db)) {
	       $sqlstr = "select satuan_id from master_barang where satuan_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where satuan_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Satuan masih digunakan pada master barang";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveSatuan($db) 
	{   
	  $this->filterSatuan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSatuan($this->satuan_id,$db)) {
  	         $sqlstr = "update $this->tablename set satuan_name='".safeString($this->satuan_name)."'
		        where satuan_id='".safeString($this->satuan_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(satuan_name) 
		        values ('".safeString($this->satuan_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->satuan_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>