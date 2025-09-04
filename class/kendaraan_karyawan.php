<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class KendaraanKaryawan
{

    var $kend_kry_id,$kry_id,$kend_id,$kend_merk,$kend_tipe,$kend_tahun,$kend_warna,$kend_nopol;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "kendaraan_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Jenis Kendaraan", $this->kend_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Merk", $this->kend_merk, "text", "y", 30, 1);
	   $example->add_text_field("Tipe", $this->kend_tipe, "text", "y", 30, 1);
	   $example->add_num_field("Tahun", $this->kend_tahun, "number", "y", 1, 0, 0);
	   $example->add_text_field("Warna", $this->kend_warna, "text", "y", 15, 1);
	   $example->add_text_field("Nopol", $this->kend_nopol, "text", "y", 10, 5);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKendaraanKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->kend_kry_id;
		$this->kend_kry_id		= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->kend_id;
		$this->kend_id			= $myFilter->process($before);
		$before 				= $this->kend_merk;
		$this->kend_merk		= $myFilter->process($before);
		$before 				= $this->kend_tipe;
		$this->kend_tipe		= $myFilter->process($before);
		$before 				= $this->kend_tahun;
		$this->kend_tahun		= $myFilter->process($before);
		$before 				= $this->kend_warna;
		$this->kend_warna		= $myFilter->process($before);
		$before 				= $this->kend_nopol;
		$this->kend_nopol		= $myFilter->process($before);
	}


	function getData()
	{
         $this->kend_kry_id		= $this->data['kend_kry_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->kend_id			= $this->data['kend_id'];   
         $this->kend_merk		= $this->data['kend_merk'];   
         $this->kend_tipe		= $this->data['kend_tipe'];   
         $this->kend_tahun		= $this->data['kend_tahun'];   
         $this->kend_warna		= $this->data['kend_warna'];   
         $this->kend_nopol		= $this->data['kend_nopol'];   
	}

	function existKendaraanKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kend_kry_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKendaraanKaryawan($txt_id,$db) 
    {
       if (! $this->existKendaraanKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKendaraanKaryawan($txt_id,$db) 
	{
       if ($this->existKendaraanKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where kend_kry_id='".safeString($txt_id)."'";
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

	
	function saveKendaraanKaryawan($db) 
	{   
	  $this->filterKendaraanKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKendaraanKaryawan($this->kend_kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 kend_id='".safeString($this->kend_id)."',
			 kend_merk='".safeString($this->kend_merk)."',
			 kend_tipe='".safeString($this->kend_tipe)."',
			 kend_tahun='".safeString($this->kend_tahun)."',
			 kend_warna='".safeString($this->kend_warna)."',
			 kend_nopol='".safeString($this->kend_nopol)."'
		        where kend_kry_id='".safeString($this->kend_kry_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,kend_id,kend_merk,kend_tipe,kend_tahun,kend_warna,kend_nopol) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->kend_id)."',
				'".safeString($this->kend_merk)."',
				'".safeString($this->kend_tipe)."',
				'".safeString($this->kend_tahun)."',
				'".safeString($this->kend_warna)."',
				'".safeString($this->kend_nopol)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->kend_kry_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>