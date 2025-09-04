<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class PendKaryawan
{

    var $pend_kry_id,$kry_id,$pend_id,$pend_kry_name,$thn_dari,$thn_sampai,$jrsn_id,$pend_kota,$sertifikat,$keterangan;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "pendidikan_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Tingkat Pendidikan", $this->pend_id, "number", "y", 1, 0, 0);
	   $example->add_text_field("Nama Sekolah", $this->pend_kry_name, "text", "y", 30, 1);
	   $example->add_num_field("Tahun Dari", $this->thn_dari, "number", "y", 1, 0, 0);
	   $example->add_num_field("Tahun Sampai", $this->thn_sampai, "number", "y", 1, 0, 0);
	   $example->add_num_field("Jurusan", $this->jrsn_id, "number", "n", 1, 0, 0);
	   $example->add_text_field("Kota", $this->pend_kota, "text", "y", 100, 0);
	   $example->add_num_field("Sertifikat", $this->sertifikat, "number", "n", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->keterangan, "text", "n", 30, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPendKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->pend_kry_id;
		$this->pend_kry_id		= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->pend_id;
		$this->pend_id			= $myFilter->process($before);
		$before 				= $this->pend_kry_name;
		$this->pend_kry_name	= $myFilter->process($before);
		$before 				= $this->thn_dari;
		$this->thn_dari			= $myFilter->process($before);
		$before 				= $this->thn_sampai;
		$this->thn_sampai		= $myFilter->process($before);
		$before 				= $this->jrsn_id;
		$this->jrsn_id			= $myFilter->process($before);
		$before 				= $this->pend_kota;
		$this->pend_kota		= $myFilter->process($before);
		$before 				= $this->sertifikat;
		$this->sertifikat		= $myFilter->process($before);
		$before 				= $this->keterangan;
		$this->keterangan		= $myFilter->process($before);
	}


	function getData()
	{
         $this->pend_kry_id		= $this->data['pend_kry_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->pend_id			= $this->data['pend_id'];   
         $this->pend_kry_name	= $this->data['pend_kry_name'];   
         $this->thn_dari		= $this->data['thn_dari'];   
         $this->thn_sampai		= $this->data['thn_sampai'];   
         $this->jrsn_id			= $this->data['jrsn_id'];   
         $this->pend_kota		= $this->data['pend_kota'];   
         $this->sertifikat		= $this->data['sertifikat'];   
         $this->keterangan		= $this->data['keterangan'];   
	}

	function existPendKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where pend_kry_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPendKaryawan($txt_id,$db) 
    {
       if (! $this->existPendKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delPendKaryawan($txt_id,$db) 
	{
       if ($this->existPendKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where pend_kry_id='".safeString($txt_id)."'";
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

	
	function savePendKaryawan($db) 
	{   
	  $this->filterPendKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPendKaryawan($this->pend_kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 pend_id='".safeString($this->pend_id)."',
			 pend_kry_name='".safeString($this->pend_kry_name)."',
			 thn_dari='".safeString($this->thn_dari)."',
			 thn_sampai='".safeString($this->thn_sampai)."',
			 jrsn_id='".safeString($this->jrsn_id)."',
			 pend_kota='".safeString($this->pend_kota)."',
			 sertifikat='".safeString($this->sertifikat)."',
			 keterangan='".safeString($this->keterangan)."'
		        where pend_kry_id='".safeString($this->pend_kry_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,pend_id,pend_kry_name,thn_dari,thn_sampai,jrsn_id,pend_kota,sertifikat,keterangan) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->pend_id)."',
				'".safeString($this->pend_kry_name)."',
				'".safeString($this->thn_dari)."',
				'".safeString($this->thn_sampai)."',
				'".safeString($this->jrsn_id)."',
				'".safeString($this->pend_kota)."',
				'".safeString($this->sertifikat)."',
				'".safeString($this->keterangan)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->pend_kry_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>