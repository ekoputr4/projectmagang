<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class KelKaryawan
{

    var $kl_id,$kry_id,$tpkl_id,$kl_nama,$kl_kelamin,$kl_tgl_lahir,$kl_pendidikan,$kl_pekerjaan;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "keluarga_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Tipe", $this->tpkl_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Nama Anggota", $this->kl_nama, "text", "y", 30, 1);
	   $example->add_num_field("Jenis Kelamin", $this->kl_kelamin, "number", "y", 1, 0, 0);
	   $example->add_date_field("Tanggal Lahir", $this->kl_tgl_lahir, "date", "us", "y");
	   $example->add_text_field("Pendidikan", $this->kl_pendidikan, "text", "n", 500, 0);
	   $example->add_text_field("Pekerjaan", $this->kl_pekerjaan, "text", "n", 50, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKelKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->kl_id;
		$this->kl_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->tpkl_id;
		$this->tpkl_id			= $myFilter->process($before);
		$before 				= $this->kl_nama;
		$this->kl_nama			= $myFilter->process($before);
		$before 				= $this->kl_kelamin;
		$this->kl_kelamin		= $myFilter->process($before);
		$before 				= $this->kl_tgl_lahir;
		$this->kl_tgl_lahir		= $myFilter->process($before);
		$before 				= $this->kl_pendidikan;
		$this->kl_pendidikan	= $myFilter->process($before);
		$before 				= $this->kl_pekerjaan;
		$this->kl_pekerjaan		= $myFilter->process($before);
	}


	function getData()
	{
         $this->kl_id			= $this->data['kl_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->tpkl_id			= $this->data['tpkl_id'];   
         $this->kl_nama			= $this->data['kl_nama'];   
         $this->kl_kelamin		= $this->data['kl_kelamin'];   
         $this->kl_tgl_lahir	= $this->data['kl_tgl_lahir'];   
         $this->kl_pendidikan	= $this->data['kl_pendidikan'];   
         $this->kl_pekerjaan	= $this->data['kl_pekerjaan'];   
	}

	function existKelKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kl_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKelKaryawan($txt_id,$db) 
    {
       if (! $this->existKelKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKelKaryawan($txt_id,$db) 
	{
       if ($this->existKelKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where kl_id='".safeString($txt_id)."'";
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

	
	function saveKelKaryawan($db) 
	{   
	  $this->filterKelKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKelKaryawan($this->kl_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 tpkl_id='".safeString($this->tpkl_id)."',
			 kl_nama='".safeString($this->kl_nama)."',
			 kl_kelamin='".safeString($this->kl_kelamin)."',
			 kl_tgl_lahir='".safeString($this->kl_tgl_lahir)."',
			 kl_pendidikan='".safeString($this->kl_pendidikan)."',
			 kl_pekerjaan='".safeString($this->kl_pekerjaan)."'
		        where kl_id='".safeString($this->kl_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,tpkl_id,kl_nama,kl_kelamin,kl_tgl_lahir,kl_pendidikan,kl_pekerjaan) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->tpkl_id)."',
				'".safeString($this->kl_nama)."',
				'".safeString($this->kl_kelamin)."',
				'".safeString($this->kl_tgl_lahir)."',
				'".safeString($this->kl_pendidikan)."',
				'".safeString($this->kl_pekerjaan)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->kl_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>