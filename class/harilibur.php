<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Harilibur
{

    var $libur_id,$tanggal,$keterangan;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "harilibur";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Tanggal", $this->tanggal, "date");
	   $example->add_text_field("Hari Libur", $this->keterangan, "text", "y", 100, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHarilibur()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->keterangan;
		$this->keterangan	= $myFilter->process($before);
	}


	function getData()
	{
         $this->libur_id		= $this->data['libur_id']; 
		 $this->tanggal			= $this->data['tanggal'];  
         $this->keterangan	 	= $this->data['keterangan'];   
	}

	function existHarilibur($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where libur_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHarilibur($txt_id,$db) 
    {
       if (! $this->existHarilibur($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delHarilibur($txt_id,$db) 
	{
       if ($this->existHarilibur($txt_id,$db)) {
	     /*  $sqlstr = "select libur_id from harilibur where libur_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where libur_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		/*   } else {
		      $this->error = "Harilibur masih digunakan";
			  return False;
		   }				*/		
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveHarilibur($db) 
	{   
	  $this->filterHarilibur();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existHarilibur($this->libur_id,$db)) {
  	         $sqlstr = "update $this->tablename set tanggal='".$this->tanggal."',keterangan='".safeString($this->keterangan)."'
		        where libur_id='".safeString($this->libur_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(tanggal,keterangan) 
		        values ('".safeString($this->tanggal)."',
		        '".safeString($this->keterangan)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->libur_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>