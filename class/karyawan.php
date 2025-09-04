<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class Karyawan
{

    var $kry_id,$kry_nik,$kry_kode_absen,$kry_name,$kry_panggilan,$kry_tmpt_lahir,$kry_tgl_lahir,$kry_kelamin;
	var $kry_alamat,$kry_alamat_asal,$kry_tlpn,$kry_hp,$agm_id,$wrg_id,$sk_id,$nkh_id,$no_ktp,$tgl_masuk,$aktif,$foto;
	var $jml_cuti,$cuti_expired;
	var $div_id,$dep_id,$unit_id,$sub_id,$jab_id,$subjab_id,$gol_darah,$tg_bdn,$bb_bdn,$ukrn_bj,$ukrn_cln,$ukrn_spt,$grade_gol;
	var $div_name,$dep_name,$unit_name,$sub_name,$jab_name,$subjab_name,$nkh_name,$agm_name,$sk_name,$wrg_name;
	var $vehicle,$medicle,$transfer,$no_rekening;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("NIK", $this->kry_nik, "text", "n", 20, 10);
	   $example->add_text_field("Kode Absensi", $this->kry_kode_absen, "text", "n", 20, 4);
	   $example->add_text_field("Nama", $this->kry_name, "text", "y", 50, 2);
	   $example->add_text_field("Panggilan", $this->kry_panggilan, "text", "n", 20, 0);
	   $example->add_text_field("Tempat Lahir", $this->kry_tmpt_lahir, "text", "n", 30, 0);
	   $example->add_date_field("Tanggal Lahir", $this->kry_tgl_lahir, "date", "us", "y");
	   $example->add_num_field("Jenis Kelamin", $this->kry_kelamin, "number", "y", 1, 0, 0);
	   $example->add_text_field("Alamat", $this->kry_alamat, "text", "y", 100, 0);
	   $example->add_text_field("Alamat Asal", $this->kry_alamat_asal, "text", "n", 100, 0);
	   $example->add_num_field("Telepon", $this->kry_tlpn, "number", "n", 0, 0, 6);
	   $example->add_num_field("Handphone", $this->kry_hp, "number", "n", 0, 0, 8);
	   $example->add_num_field("Agama", $this->agm_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Suku", $this->sk_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Kewarganegaraan", $this->wrg_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Status Perkawinan", $this->nkh_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("No KTP", $this->no_ktp, "text", "y", 50, 1);
	   $example->add_date_field("Tanggal Masuk", $this->tgl_masuk, "date", "us", "y");
	   $example->add_num_field("Divisi", $this->div_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Departemen", $this->dep_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Unit Kerja", $this->unit_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Sub Unit Kerja", $this->sub_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Golongan Darah", $this->gol_darah, "text", "n", 5, 1);
	   $example->add_num_field("Tinggi Badan", $this->tg_bdn, "number", "n", 3, 0, 1);
	   $example->add_num_field("Berat Badan", $this->bb_bdn, "number", "n", 3, 0, 1);
	   $example->add_text_field("Ukuran Baju", $this->ukrn_bj, "text", "n", 5, 1);
	   $example->add_text_field("Ukuran Celana", $this->ukrn_cln, "text", "n", 5, 1);
	   $example->add_text_field("Ukuran Sepatu", $this->ukrn_spt, "text", "n", 5, 1);
	   $example->add_num_field("Transfer", $this->transfer, "number", "n", 0, 0, 1);
	   $example->add_text_field("Nomor Rekening", $this->no_rekening, "text", "n", 30, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabelJab($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("ID Karyawan", $this->kry_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Sub Jabatan", $this->subjab_id, "number", "y", 1, 0, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabelGaji($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("ID Karyawan", $this->kry_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Grade Gaji", $this->grade_gol, "text", "y", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabelCuti($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("ID Karyawan", $this->kry_id, "number", "y", 1, 0, 0);
	   $example->add_num_field("Jumlah Cuti", $this->jml_cuti, "number", "y", 2, 0, 1);
	   $example->add_date_field("Masa Cuti Berakhir", $this->cuti_expired, "date", "us", "y");
	   if ($example->validation()) {	
	   	   if ($this->validHari()==true)	       
		       return True;
		   else 	   
		       return False;
       } else {
	       $this->error = $example->create_msg();
		   $this->validHari();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function validHari()
	{
		$skrg  = strtotime(date("Y-m-d")) ;
		$waktu = strtotime($this->cuti_expired);
		$hasil = ($waktu - $skrg)/86400;
		if ($hasil>=1) 
			return True;
		else
			$this->error .= "Masa aktif cuti harus lebih besar dari hari ini";
	} 

	function cekFoto($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Foto", $this->foto, "text", "y", 64, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
	}

	function cekVehicle($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Kendaraan", $this->vehicle, "text", "y", 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
	}

	function cekMedical($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Riwayat Kesehatan", $this->medicle, "text", "y", 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
	}


	function filterKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->kry_nik;
		$this->kry_nik			= $myFilter->process($before);
		$before 				= $this->kry_kode_absen;
		$this->kry_kode_absen	= $myFilter->process($before);
		$before 				= $this->kry_name;
		$this->kry_name			= $myFilter->process($before);
		$before 				= $this->kry_panggilan;
		$this->kry_panggilan	= $myFilter->process($before);
		$before 				= $this->kry_tmpt_lahir;
		$this->kry_tmpt_lahir	= $myFilter->process($before);
		$before 				= $this->kry_tgl_lahir;
		$this->kry_tgl_lahir	= $myFilter->process($before);
		$before 				= $this->kry_kelamin;
		$this->kry_kelamin		= $myFilter->process($before);
		$before 				= $this->kry_alamat;
		$this->kry_alamat		= $myFilter->process($before);
		$before 				= $this->kry_alamat_asal;
		$this->kry_alamat_asal	= $myFilter->process($before);
		$before 				= $this->kry_tlpn;
		$this->kry_tlpn			= $myFilter->process($before);
		$before 				= $this->kry_hp;
		$this->kry_hp			= $myFilter->process($before);
		$before 				= $this->agm_id;
		$this->agm_id			= $myFilter->process($before);
		$before 				= $this->sk_id;
		$this->sk_id			= $myFilter->process($before);
		$before 				= $this->wrg_id;
		$this->wrg_id			= $myFilter->process($before);
		$before 				= $this->nkh_id;
		$this->nkh_id			= $myFilter->process($before);
		$before 				= $this->no_ktp;
		$this->no_ktp			= $myFilter->process($before);
		$before 				= $this->tgl_masuk;
		$this->tgl_masuk		= $myFilter->process($before);
		$before 				= $this->div_id;
		$this->div_id			= $myFilter->process($before);
		$before 				= $this->dep_id;
		$this->dep_id			= $myFilter->process($before);
		$before 				= $this->unit_id;
		$this->unit_id			= $myFilter->process($before);
		$before 				= $this->sub_id;
		$this->sub_id			= $myFilter->process($before);
		$before 				= $this->jab_id;
		$this->jab_id			= $myFilter->process($before);
		$before 				= $this->subjab_id;
		$this->subjab_id		= $myFilter->process($before);
		$before 				= $this->gol_darah;
		$this->gol_darah		= $myFilter->process($before);
		$before 				= $this->tg_bdn;
		$this->tg_bdn			= $myFilter->process($before);
		$before 				= $this->bb_bdn;
		$this->bb_bdn			= $myFilter->process($before);
		$before 				= $this->ukrn_bj;
		$this->ukrn_bj			= $myFilter->process($before);
		$before 				= $this->ukrn_cln;
		$this->ukrn_cln			= $myFilter->process($before);
		$before 				= $this->ukrn_spt;
		$this->ukrn_spt			= $myFilter->process($before);
		$before 				= $this->jml_cuti;
		$this->jml_cuti			= $myFilter->process($before);
		$before 				= $this->cuti_expired;
		$this->cuti_expired		= $myFilter->process($before);
		$before 				= $this->transfer;
		$this->transfer			= $myFilter->process($before);
		$before 				= $this->no_rekening;
		$this->no_rekening		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->kry_id			= $this->data['kry_id'];   
         $this->kry_nik 		= $this->data['kry_nik'];   
         $this->kry_kode_absen	= $this->data['kry_kode_absen'];   
         $this->kry_name 		= $this->data['kry_name'];   
         $this->kry_panggilan	= $this->data['kry_panggilan'];   
         $this->kry_tmpt_lahir	= $this->data['kry_tmpt_lahir'];   
         $this->kry_tgl_lahir	= $this->data['kry_tgl_lahir'];   
         $this->kry_kelamin		= $this->data['kry_kelamin'];   
         $this->kry_alamat		= $this->data['kry_alamat'];   
         $this->kry_alamat_asal	= $this->data['kry_alamat_asal'];   
         $this->kry_tlpn		= $this->data['kry_tlpn'];   
         $this->kry_hp			= $this->data['kry_hp'];   
         $this->agm_id			= $this->data['agm_id'];   
         $this->wrg_id			= $this->data['wrg_id'];   
         $this->sk_id			= $this->data['sk_id'];   
         $this->nkh_id			= $this->data['nkh_id'];   
         $this->no_ktp			= $this->data['no_ktp'];   
         $this->tgl_masuk		= $this->data['tgl_masuk'];   
         $this->foto			= $this->data['foto'];   
         $this->div_id			= $this->data['div_id'];   
         $this->dep_id			= $this->data['dep_id'];   
         $this->unit_id			= $this->data['unit_id'];   
         $this->sub_id			= $this->data['sub_id'];   
         $this->jab_id			= $this->data['jab_id'];   
         $this->subjab_id		= $this->data['subjab_id'];   
         $this->gol_darah		= $this->data['gol_darah'];   
         $this->tg_bdn			= $this->data['tg_bdn'];   
         $this->bb_bdn			= $this->data['bb_bdn'];   
         $this->ukrn_bj			= $this->data['ukrn_bj'];   
         $this->ukrn_cln		= $this->data['ukrn_cln'];   
         $this->ukrn_spt		= $this->data['ukrn_spt'];   
         $this->grade_gol		= $this->data['grade_gol'];   
         $this->jml_cuti		= $this->data['jml_cuti'];   
         $this->cuti_expired	= $this->data['cuti_expired'];   
         $this->vehicle			= $this->data['vehicle'];   
         $this->medicle			= $this->data['medicle'];   
         $this->transfer		= $this->data['transfer'];   
         $this->no_rekening		= $this->data['no_rekening'];   
		 
		 require_once("divisi.php");
		 $divisi	= new Divisi;
		 $divisi->getDivisi($this->div_id,$db);
		 $this->div_name	= $divisi->div_name;

		 require_once("departemen.php");
		 $departemen	= new Departemen;
		 $departemen->getDepartemen($this->dep_id,$db);
		 $this->dep_name	= $departemen->dep_name;

		 require_once("unitkerja.php");
		 $unitkerja	= new UnitKerja;
		 $unitkerja->getUnitKerja($this->unit_id,$db);
		 $this->unit_name	= $unitkerja->unit_name;

		 require_once("subunitkerja.php");
		 $subunitkerja	= new SubUnitKerja;
		 $subunitkerja->getSubUnitKerja($this->sub_id,$db);
		 $this->sub_name	= $subunitkerja->sub_name;

		 require_once("status_nikah.php");
		 $statusnikah	= new StatusNikah;
		 $statusnikah->getStatusNikah($this->nkh_id,$db);
		 $this->nkh_name	= $statusnikah->nkh_name;

		 require_once("agama.php");
		 $agama	= new Agama;
		 $agama->getAgama($this->agm_id,$db);
		 $this->agm_name	= $agama->agm_name;

		 require_once("suku.php");
		 $suku	= new Suku;
		 $suku->getSuku($this->sk_id,$db);
		 $this->sk_name		= $suku->sk_name;

		 require_once("warga.php");
		 $warga	= new Warga;
		 $warga->getWarga($this->wrg_id,$db);
		 $this->wrg_name	= $warga->wrg_name;

		 require_once("jabatan.php");
		 $jabatan	= new Jabatan;
		 $jabatan->getJabatan($this->jab_id,$db);
		 $this->jab_name	= $jabatan->jab_name;

		 require_once("subjabatan.php");
		 $subjabatan	= new SubJabatan;
		 $subjabatan->getSubJabatan($this->subjab_id,$db);
		 $this->subjab_name	= $subjabatan->sub_name;
	}

	function existKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kry_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKaryawan($txt_id,$db) 
    {
       if (! $this->existKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delKaryawan($txt_id,$db) 
	{
       if ($this->existKaryawan($txt_id,$db)) {
           $this->foto			= $this->data['foto'];   
	       $sqlstr = "select kry_id from absensi where kry_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select kry_id from demosi_karyawan where kry_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {
				   $sqlstr = "select kry_id from promosi_karyawan where kry_id='".safeString($txt_id)."'";
				   $result = mysql_query($sqlstr,$db);
				   if (mysql_num_rows($result)==0) {
					   $sqlstr = "delete from $this->tablename where kry_id='".safeString($txt_id)."'";
					   if (!$result = mysql_query($sqlstr,$db))  {
						   $this->error = mysql_error();    
						}
					  
					   if (! $result) { 
						  return False;
						} else { 
						  if (file_exists("foto/".$this->foto) && ($this->foto!="")) {
							 unlink("foto/".$this->foto);
						  }	 				
						  return True;
						}  
				   } else {
					  $this->error = "Karyawan memiliki data Promosi";
					  return False;
				   }						
			   } else {
				  $this->error = "Karyawan memiliki data Demosi";
				  return False;
			   }						
		   } else {
		      $this->error = "Karyawan masih digunakan pada Absensi";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function autoNIK($db) 
	{
       $sqlstr = "select tgl_masuk from $this->tablename where year(tgl_masuk)='".date("Y")."' 
	   and month(tgl_masuk)='".date("m")."'";
	   $result = mysql_query($sqlstr,$db);
	   $jml = mysql_num_rows($result);
	   return date("Y").".".date("m").".".sprintf("%03s",$jml+1);
	}

	function setDeactive($db) 
	{
	  $this->filterKaryawan();   
	  if ($this->existKaryawan($this->kry_id,$db)) {
         $sqlstr = "update $this->tablename set aktif='1'
	        where kry_id='".safeString($this->kry_id)."'";
		   if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    }
		   if (! $result) { 
			  return False;
			} else { 
			  return True;
			}  	  
	  } else {
	  	$this->error = "Karyawan tidak ditemukan";
	  	return False;
	  }
	}

	function saveFoto($db) 
	{   
	  $this->filterKaryawan();   
	  if ($this->cekFoto($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set foto='".safeString($this->foto)."'
		        where kry_id='".safeString($this->kry_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		      $this->error = "Karyawan tidak ditemukan"; 
			  return False;
		   }		
       }
	} 

	function saveVehicle($db) 
	{   
	  $this->filterKaryawan();   
	  if ($this->cekVehicle($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set vehicle='".safeString($this->vehicle)."'
		        where kry_id='".safeString($this->kry_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		      $this->error = "Karyawan tidak ditemukan"; 
			  return False;
		   }		
       }
	} 

	function saveMedical($db) 
	{   
	  $this->filterKaryawan();   
	  if ($this->cekMedical($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set medicle='".safeString($this->medicle)."'
		        where kry_id='".safeString($this->kry_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		      $this->error = "Karyawan tidak ditemukan"; 
			  return False;
		   }		
       }
	} 

	function saveJabatan($db)
	{
	  $this->filterKaryawan();   
	  if ($this->cekVariabelJab($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
	         $sqlstr = "update $this->tablename set jab_id='".safeString($this->jab_id)."',
			 subjab_id='".safeString($this->subjab_id)."'
		        where kry_id='".safeString($this->kry_id)."'";

			if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    }
			if (! $result) { 
			  return False;
			} else { 
			  return True;
			}  		  
		  } else {
		  	$this->error	= "Data tidak ditemukan";
		  	return False;
		  }		  	
	  }
	}

	function saveGradeGaji($db)
	{
	  $this->filterKaryawan();   
	  if ($this->cekVariabelGaji($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
	         $sqlstr = "update $this->tablename set 
			 grade_gol='".safeString($this->grade_gol)."'
		        where kry_id='".safeString($this->kry_id)."'";

			if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    }
			if (! $result) { 
			  return False;
			} else { 
			  return True;
			}  		  
		  } else {
		  	$this->error	= "Data tidak ditemukan";
		  	return False;
		  }		  	
	  }
	}

	function saveCuti($db)
	{
	  $this->filterKaryawan();   
	  if ($this->cekVariabelCuti($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
	         $sqlstr = "update $this->tablename set 
			 jml_cuti='".safeString($this->jml_cuti)."',
			 cuti_expired='".safeString($this->cuti_expired)."'
		        where kry_id='".safeString($this->kry_id)."'";

		/*	echo $sqlstr;
			return True;*/
			if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    }
			if (! $result) { 
			  return False;
			} else { 
			  return True;
			}  		  
		  } else {
		  	$this->error	= "Data tidak ditemukan";
		  	return False;
		  }		  	
	  }
	}
	
	function saveKaryawan($db) 
	{   
	  $this->new = 0;
	  $this->filterKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKaryawan($this->kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_nik='".safeString($this->kry_nik)."',
			 kry_kode_absen='".safeString($this->kry_kode_absen)."',
			 kry_name='".safeString($this->kry_name)."',
			 kry_panggilan='".safeString($this->kry_panggilan)."',
			 kry_tmpt_lahir='".safeString($this->kry_tmpt_lahir)."',
			 kry_tgl_lahir='".safeString($this->kry_tgl_lahir)."',
			 kry_kelamin='".safeString($this->kry_kelamin)."',
			 kry_alamat='".safeString($this->kry_alamat)."',
			 kry_alamat_asal='".safeString($this->kry_alamat_asal)."',
			 kry_tlpn='".safeString($this->kry_tlpn)."',
			 kry_hp='".safeString($this->kry_hp)."',
			 agm_id='".safeString($this->agm_id)."',
			 wrg_id='".safeString($this->wrg_id)."',
			 sk_id='".safeString($this->sk_id)."',
			 nkh_id='".safeString($this->nkh_id)."',
			 no_ktp='".safeString($this->no_ktp)."',
			 tgl_masuk='".safeString($this->tgl_masuk)."',
			 div_id='".safeString($this->div_id)."',
			 dep_id='".safeString($this->dep_id)."',
			 unit_id='".safeString($this->unit_id)."',
			 sub_id='".safeString($this->sub_id)."',
			 gol_darah='".safeString($this->gol_darah)."',
			 tg_bdn='".safeString($this->tg_bdn)."',
			 bb_bdn='".safeString($this->bb_bdn)."',
			 ukrn_bj='".safeString($this->ukrn_bj)."',
			 ukrn_cln='".safeString($this->ukrn_cln)."',
			 ukrn_spt='".safeString($this->ukrn_spt)."',
			 transfer='".safeString($this->transfer)."',
			 no_rekening='".safeString($this->no_rekening)."'
		        where kry_id='".safeString($this->kry_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_nik,kry_kode_absen,kry_name,kry_panggilan,kry_tmpt_lahir,
			  kry_tgl_lahir,kry_kelamin,kry_alamat,kry_alamat_asal,kry_tlpn,kry_hp,agm_id,wrg_id,sk_id,nkh_id,no_ktp,tgl_masuk,
			  div_id,dep_id,unit_id,sub_id,gol_darah,tg_bdn,bb_bdn,ukrn_bj,ukrn_cln,ukrn_spt,transfer,no_rekening) 
		        values ('".safeString($this->kry_nik)."',
				'".safeString($this->kry_kode_absen)."',
				'".safeString($this->kry_name)."',
				'".safeString($this->kry_panggilan)."',
				'".safeString($this->kry_tmpt_lahir)."',
				'".safeString($this->kry_tgl_lahir)."',
				'".safeString($this->kry_kelamin)."',
				'".safeString($this->kry_alamat)."',
				'".safeString($this->kry_alamat_asal)."',
				'".safeString($this->kry_tlpn)."',
				'".safeString($this->kry_hp)."',
				'".safeString($this->agm_id)."',
				'".safeString($this->wrg_id)."',
				'".safeString($this->sk_id)."',
				'".safeString($this->nkh_id)."',
				'".safeString($this->no_ktp)."',
				'".safeString($this->tgl_masuk)."',
				'".safeString($this->div_id)."',
				'".safeString($this->dep_id)."',
				'".safeString($this->unit_id)."',
				'".safeString($this->sub_id)."',
				'".safeString($this->gol_darah)."',
				'".safeString($this->tg_bdn)."',
				'".safeString($this->bb_bdn)."',
				'".safeString($this->ukrn_bj)."',
				'".safeString($this->ukrn_cln)."',
				'".safeString($this->ukrn_spt)."',
				'".safeString($this->transfer)."',
				'".safeString($this->no_rekening)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new == 1)
	 			  $this->kry_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>