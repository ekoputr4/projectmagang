<?
/*
  Write : Onix
  Last Modified : Mar 3, 2009
*/

class PromosiKaryawan
{

    var $promo_id,$kry_id,$masa_id,$promo_habis,$promo_sk;
	var $div_id,$dep_id,$unit_id,$sub_id,$jab_id,$subjab_id,$approve;
	var $tgl_sk,$tgl_approve,$user_create,$user_approve,$promo_ket,$tgl_buat,$grade_gol;
	var $masa_name,$div_name,$dep_name,$unit_name,$sub_name,$jab_name,$subjab_name;	
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "promosi_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 0);
	   $example->add_num_field("Jenis Masa Kerja", $this->masa_id, "number", "y", 0, 1);
	   $example->add_date_field("Promo Habis", $this->promo_habis,  "date", "us", "y");
	   $example->add_date_field("Tanggal SK", $this->tgl_sk,  "date", "us", "y");
	   $example->add_text_field("Surat Keputusan", $this->promo_sk, "text", "y", 50, 1);
	   $example->add_num_field("Divisi", $this->div_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Departemen", $this->dep_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Unit Kerja", $this->unit_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("SubUnit Kerja", $this->sub_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Jabatan", $this->sub_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Sub Jabatan", $this->subjab_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Grade Gaji", $this->grade_gol, "text", "y", 50, 1);
//	   $example->add_num_field("Approve", $this->approve, "number", "y", 0, 0, 1);
	   $example->add_num_field("User", $this->user_create, "number", "y", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->promo_ket, "text", "n", 0, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPromosiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->promo_id;
		$this->promo_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->masa_id;
		$this->masa_id			= $myFilter->process($before);
		$before 				= $this->promo_habis;
		$this->promo_habis		= $myFilter->process($before);
		$before 				= $this->promo_sk;
		$this->promo_sk			= $myFilter->process($before);
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
		$before 				= $this->grade_gol;
		$this->grade_gol		= $myFilter->process($before);
		$before 				= $this->approve;
		$this->approve			= $myFilter->process($before);
		$before 				= $this->tgl_approve;
		$this->tgl_approve		= $myFilter->process($before);
		$before 				= $this->user_create;
		$this->user_create		= $myFilter->process($before);
		$before 				= $this->user_approve;
		$this->user_approve		= $myFilter->process($before);
		$before 				= $this->promo_ket;
		$this->promo_ket		= $myFilter->process($before);
		$before 				= $this->tgl_buat;
		$this->tgl_buat			= $myFilter->process($before);
		$before 				= $this->tgl_sk;
		$this->tgl_sk			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->promo_id		= $this->data['promo_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->masa_id			= $this->data['masa_id'];   
         $this->promo_habis		= $this->data['promo_habis'];   
         $this->promo_sk		= $this->data['promo_sk'];   
         $this->tgl_sk			= $this->data['tgl_sk'];   
         $this->div_id			= $this->data['div_id'];   
         $this->dep_id			= $this->data['dep_id'];   
         $this->unit_id			= $this->data['unit_id'];   
         $this->sub_id			= $this->data['sub_id'];   
         $this->jab_id			= $this->data['jab_id'];   
         $this->subjab_id		= $this->data['subjab_id'];   
         $this->approve			= $this->data['approve'];   
         $this->tgl_approve		= $this->data['tgl_approve'];   
         $this->user_create		= $this->data['user_create'];   
         $this->user_approve	= $this->data['user_approve'];   
         $this->promo_ket		= $this->data['promo_ket'];   
         $this->tgl_buat		= $this->data['tgl_buat'];   
         $this->grade_gol		= $this->data['grade_gol'];   

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
		 
		 require_once("jabatan.php");
		 $jabatan	= new Jabatan;
		 $jabatan->getJabatan($this->jab_id,$db);
		 $this->jab_name	= $jabatan->jab_name;

		 require_once("subjabatan.php");
		 $subjabatan	= new SubJabatan; 
		 $subjabatan->getSubJabatan($this->subjab_id,$db);
		 $this->subjab_name	= $subjabatan->sub_name;

	}

	function existPromosiKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where promo_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPromosiKaryawan($txt_id,$db) 
    {
       if (! $this->existPromosiKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delPromosiKaryawan($txt_id,$db) 
	{
       if ($this->existPromosiKaryawan($txt_id,$db)) {
           $this->approve			= $this->data['approve'];   
		   if ($this->approve==0) {
			   $sqlstr = "delete from $this->tablename where promo_id='".safeString($txt_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
				  
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
			} else {
		        $this->error = "Promosi telah diproses oleh Direksi";
				return False;
			}
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveApprove($db) {
	  if ($this->existPromosiKaryawan($this->promo_id,$db)) {
         $sqlstr = "update $this->tablename set
		 approve='".safeString($this->approve)."',
		 tgl_approve='".safeString(date("Y-m-d"))."',
		 user_approve='".safeString($this->user_approve)."',
		 promo_ket='".safeString($this->promo_ket)."'
	        where promo_id='".safeString($this->promo_id)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 			
		      return True;
		    }  
	  } else {
	  	return False;
		$this->error = "Promosi karyawan tidak ditemukan";
	  }		
	}
	
	function savePromosiKaryawan($db) 
	{   
	  $this->filterPromosiKaryawan();   
	  $this->new	= 0;
	  if ($this->cekVariabel($db))  {
		  if ($this->existPromosiKaryawan($this->promo_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 masa_id='".safeString($this->masa_id)."',
			 promo_habis='".safeString($this->promo_habis)."',
			 promo_sk='".safeString($this->promo_sk)."',
			 tgl_sk='".safeString($this->tgl_sk)."',
			 div_id='".safeString($this->div_id)."',
			 dep_id='".safeString($this->dep_id)."',
			 unit_id='".safeString($this->unit_id)."',
			 sub_id='".safeString($this->sub_id)."',
			 jab_id='".safeString($this->jab_id)."',
			 subjab_id='".safeString($this->subjab_id)."',
			 grade_gol='".safeString($this->grade_gol)."',
			 approve='".safeString($this->approve)."',
			 user_create='".safeString($this->user_create)."',
			 promo_ket='".safeString($this->promo_ket)."'
		        where promo_id='".safeString($this->promo_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_id,masa_id,promo_habis,promo_sk,tgl_sk,div_id,dep_id,
			  unit_id,sub_id,jab_id,subjab_id,grade_gol,user_create,promo_ket,tgl_buat) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->masa_id)."',
				'".safeString($this->promo_habis)."',
				'".safeString($this->promo_sk)."',
				'".safeString($this->tgl_sk)."',
				'".safeString($this->div_id)."',
				'".safeString($this->dep_id)."',
				'".safeString($this->unit_id)."',
				'".safeString($this->sub_id)."',
				'".safeString($this->jab_id)."',
				'".safeString($this->subjab_id)."',
				'".safeString($this->grade_gol)."',
				'".safeString($this->user_create)."',
				'".safeString($this->promo_ket)."',
				'".safeString(date("Y-m-d"))."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->promo_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>