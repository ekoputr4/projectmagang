<?
/*
  Write : Onix
  Last Modified : Mar 7, 2009
*/

class CalonKaryawan
{

    var $cln_id,$cln_name,$cln_tmpt_lahir,$cln_tgl_lahir,$cln_kelamin;
	var $cln_alamat,$cln_tlpn,$cln_hp,$agm_id,$wrg_id,$sk_id,$nkh_id,$tgl_masuk;
	var $jab_id,$subjab_id;
	var $jab_name,$subjab_name,$nkh_name,$agm_name,$sk_name,$wrg_name;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "calonkaryawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama", $this->cln_name, "text", "y", 50, 2);
	   $example->add_text_field("Tempat Lahir", $this->cln_tmpt_lahir, "text", "n", 30, 0);
	   $example->add_date_field("Tanggal Lahir", $this->cln_tgl_lahir, "date", "us", "y");
	   $example->add_num_field("Jenis Kelamin", $this->cln_kelamin, "number", "y", 1, 0, 0);
	   $example->add_text_field("Alamat", $this->cln_alamat, "text", "y", 100, 0);
	   $example->add_num_field("Telepon", $this->cln_tlpn, "number", "n", 0, 0, 6);
	   $example->add_num_field("Handphone", $this->cln_hp, "number", "n", 0, 0, 8);
	   $example->add_num_field("Agama", $this->agm_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Suku", $this->sk_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Kewarganegaraan", $this->wrg_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Status Perkawinan", $this->nkh_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Masuk", $this->tgl_masuk, "date", "us", "y");
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

	function filterCalonKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->cln_id;
		$this->cln_id			= $myFilter->process($before);
		$before 				= $this->cln_name;
		$this->cln_name			= $myFilter->process($before);
		$before 				= $this->cln_tmpt_lahir;
		$this->cln_tmpt_lahir	= $myFilter->process($before);
		$before 				= $this->cln_tgl_lahir;
		$this->cln_tgl_lahir	= $myFilter->process($before);
		$before 				= $this->cln_kelamin;
		$this->cln_kelamin		= $myFilter->process($before);
		$before 				= $this->cln_alamat;
		$this->cln_alamat		= $myFilter->process($before);
		$before 				= $this->cln_tlpn;
		$this->cln_tlpn			= $myFilter->process($before);
		$before 				= $this->cln_hp;
		$this->cln_hp			= $myFilter->process($before);
		$before 				= $this->agm_id;
		$this->agm_id			= $myFilter->process($before);
		$before 				= $this->sk_id;
		$this->sk_id			= $myFilter->process($before);
		$before 				= $this->wrg_id;
		$this->wrg_id			= $myFilter->process($before);
		$before 				= $this->nkh_id;
		$this->nkh_id			= $myFilter->process($before);
		$before 				= $this->tgl_masuk;
		$this->tgl_masuk		= $myFilter->process($before);
		$before 				= $this->jab_id;
		$this->jab_id			= $myFilter->process($before);
		$before 				= $this->subjab_id;
		$this->subjab_id		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->cln_id			= $this->data['cln_id'];   
         $this->cln_name 		= $this->data['cln_name'];   
         $this->cln_tmpt_lahir	= $this->data['cln_tmpt_lahir'];   
         $this->cln_tgl_lahir	= $this->data['cln_tgl_lahir'];   
         $this->cln_kelamin		= $this->data['cln_kelamin'];   
         $this->cln_alamat		= $this->data['cln_alamat'];   
         $this->cln_tlpn		= $this->data['cln_tlpn'];   
         $this->cln_hp			= $this->data['cln_hp'];   
         $this->agm_id			= $this->data['agm_id'];   
         $this->wrg_id			= $this->data['wrg_id'];   
         $this->sk_id			= $this->data['sk_id'];   
         $this->nkh_id			= $this->data['nkh_id'];   
         $this->tgl_masuk		= $this->data['tgl_masuk'];   
         $this->jab_id			= $this->data['jab_id'];   
         $this->subjab_id		= $this->data['subjab_id'];   
		 
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

	function existCalonKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where cln_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCalonKaryawan($txt_id,$db) 
    {
       if (! $this->existCalonKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delCalonKaryawan($txt_id,$db) 
	{
       if ($this->existCalonKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where cln_id='".safeString($txt_id)."'";
   	       if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    
			}
			  
           if (! $result) { 
	          return False;
		    } else { 
			  $sqlstr 	= "select * from calonkaryawan_file where cln_id='".safeString($txt_id)."'";
			  $result2	= mysql_query($sqlstr,$db);
			  if (mysql_num_rows($result2)>0) {
			  	while ($data2=mysql_fetch_array($result2)) {
				  if (file_exists("calonfile/".$data2[cf_file]) && ($data2[cf_file]!="")) 
					 unlink("calonfile/".$data2[cf_file]);				    	
				}
			  }
			  mysql_free_result($result2);
			  $sqlstr 	= "delete from calonkaryawan_file where cln_id='".safeString($txt_id)."'";
			  $result2	= mysql_query($sqlstr,$db);
	    	  return True;
		    }  
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveCalonKaryawan($db) 
	{   
   	  $this->new = 0;
	  $this->filterCalonKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existCalonKaryawan($this->cln_id,$db)) {
  	         $sqlstr = "update $this->tablename set  cln_name='".safeString($this->cln_name)."',
			 cln_tmpt_lahir='".safeString($this->cln_tmpt_lahir)."',
			 cln_tgl_lahir='".safeString($this->cln_tgl_lahir)."',
			 cln_kelamin='".safeString($this->cln_kelamin)."',
			 cln_alamat='".safeString($this->cln_alamat)."',
			 cln_tlpn='".safeString($this->cln_tlpn)."',
			 cln_hp='".safeString($this->cln_hp)."',
			 agm_id='".safeString($this->agm_id)."',
			 wrg_id='".safeString($this->wrg_id)."',
			 sk_id='".safeString($this->sk_id)."',
			 nkh_id='".safeString($this->nkh_id)."',
			 tgl_masuk='".safeString($this->tgl_masuk)."',
			 jab_id='".safeString($this->jab_id)."',
			 subjab_id='".safeString($this->subjab_id)."'
		        where cln_id='".safeString($this->cln_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(cln_name,cln_tmpt_lahir,
			  cln_tgl_lahir,cln_kelamin,cln_alamat,cln_tlpn,cln_hp,agm_id,wrg_id,sk_id,nkh_id,tgl_masuk,
			  jab_id,subjab_id) 
		        values ('".safeString($this->cln_name)."',
				'".safeString($this->cln_tmpt_lahir)."',
				'".safeString($this->cln_tgl_lahir)."',
				'".safeString($this->cln_kelamin)."',
				'".safeString($this->cln_alamat)."',
				'".safeString($this->cln_tlpn)."',
				'".safeString($this->cln_hp)."',
				'".safeString($this->agm_id)."',
				'".safeString($this->wrg_id)."',
				'".safeString($this->sk_id)."',
				'".safeString($this->nkh_id)."',
				'".safeString($this->tgl_masuk)."',
				'".safeString($this->jab_id)."',
				'".safeString($this->subjab_id)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->cln_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>