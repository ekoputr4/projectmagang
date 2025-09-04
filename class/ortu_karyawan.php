<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class OrtuKaryawan
{

    var $ortu_id,$kry_id,$tpkl_id,$ortu_nama,$ortu_kelamin,$ortu_tgl_lahir,$ortu_pendidikan,$ortu_pekerjaan;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "ortu_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Tipe", $this->tpkl_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Nama Anggota", $this->ortu_nama, "text", "y", 30, 1);
	   $example->add_num_field("Jenis Kelamin", $this->ortu_kelamin, "number", "y", 1, 0, 0);
	   $example->add_date_field("Tanggal Lahir", $this->ortu_tgl_lahir, "date", "us", "y");
	   $example->add_text_field("Pendidikan", $this->ortu_pendidikan, "text", "n", 500, 0);
	   $example->add_text_field("Pekerjaan", $this->ortu_pekerjaan, "text", "n", 50, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterOrtuKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->ortu_id;
		$this->ortu_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->tpkl_id;
		$this->tpkl_id			= $myFilter->process($before);
		$before 				= $this->ortu_nama;
		$this->ortu_nama		= $myFilter->process($before);
		$before 				= $this->ortu_kelamin;
		$this->ortu_kelamin		= $myFilter->process($before);
		$before 				= $this->ortu_tgl_lahir;
		$this->ortu_tgl_lahir	= $myFilter->process($before);
		$before 				= $this->ortu_pendidikan;
		$this->ortu_pendidikan	= $myFilter->process($before);
		$before 				= $this->ortu_pekerjaan;
		$this->ortu_pekerjaan	= $myFilter->process($before);
	}


	function getData()
	{
         $this->ortu_id			= $this->data['ortu_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->tpkl_id			= $this->data['tpkl_id'];   
         $this->ortu_nama			= $this->data['ortu_nama'];   
         $this->ortu_kelamin		= $this->data['ortu_kelamin'];   
         $this->ortu_tgl_lahir	= $this->data['ortu_tgl_lahir'];   
         $this->ortu_pendidikan	= $this->data['ortu_pendidikan'];   
         $this->ortu_pekerjaan	= $this->data['ortu_pekerjaan'];   
	}

	function existOrtuKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where ortu_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getOrtuKaryawan($txt_id,$db) 
    {
       if (! $this->existOrtuKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delOrtuKaryawan($txt_id,$db) 
	{
       if ($this->existOrtuKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where ortu_id='".safeString($txt_id)."'";
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

	
	function saveOrtuKaryawan($db) 
	{   
	  $this->filterOrtuKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existOrtuKaryawan($this->ortu_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 tpkl_id='".safeString($this->tpkl_id)."',
			 ortu_nama='".safeString($this->ortu_nama)."',
			 ortu_kelamin='".safeString($this->ortu_kelamin)."',
			 ortu_tgl_lahir='".safeString($this->ortu_tgl_lahir)."',
			 ortu_pendidikan='".safeString($this->ortu_pendidikan)."',
			 ortu_pekerjaan='".safeString($this->ortu_pekerjaan)."'
		        where ortu_id='".safeString($this->ortu_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,tpkl_id,ortu_nama,ortu_kelamin,ortu_tgl_lahir,ortu_pendidikan,ortu_pekerjaan) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->tpkl_id)."',
				'".safeString($this->ortu_nama)."',
				'".safeString($this->ortu_kelamin)."',
				'".safeString($this->ortu_tgl_lahir)."',
				'".safeString($this->ortu_pendidikan)."',
				'".safeString($this->ortu_pekerjaan)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->ortu_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>