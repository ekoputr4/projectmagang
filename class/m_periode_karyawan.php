<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MPeriodeKaryawan
{

    var $per_id,$tgl_awal,$tgl_akhir;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "m_periode_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_date_field("Tanggal Awal", $this->tgl_awal, "date", "us", "y");
	   $example->add_date_field("Tanggal AKhir", $this->tgl_akhir, "date", "us", "y");
	   if ($example->validation()) {	       	   	
	   	   if (!$this->cekExist($db)){
	       	   return True;
		   } else {
		   	   $this->error = "Periode Karyawan telah ada dalam database";
	       	   return False;
		   }		
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekExist($db)
	{
		$sqlstr = " select * from $this->tablename 
			where tgl_awal='".safeString($this->tgl_awal)."' and tgl_akhir='".safeString($this->tgl_akhir)."'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0)
		   return True;
		else
		   return False;   		
	}

	function filterMPeriodeKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->per_id;
		$this->per_id		= $myFilter->process($before);
		$before 			= $this->tgl_awal;
		$this->tgl_awal		= $myFilter->process($before);
		$before 			= $this->tgl_akhir;
		$this->tgl_akhir	= $myFilter->process($before);
	}


	function getData()
	{
         $this->per_id			= $this->data['per_id']; 
		 $this->tgl_awal		= $this->data['tgl_awal'];  
         $this->tgl_akhir	 	= $this->data['tgl_akhir'];   
	}

	function existMPeriodeKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where per_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMPeriodeKaryawan($txt_id,$db) 
    {
       if (! $this->existMPeriodeKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delMPeriodeKaryawan($txt_id,$db) 
	{
       if ($this->existMPeriodeKaryawan($txt_id,$db)) {
		 $this->tgl_awal		= $this->data['tgl_awal'];  
         $this->tgl_akhir	 	= $this->data['tgl_akhir'];   
	     $sqlstr = "select kry_id from tb_absentogaji where periode_awal='".safeString($this->tgl_awal)."'
		 	and periode_akhir='".safeString($this->tgl_akhir)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where per_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
				  $sqlstr = "delete from d_periode_karyawan where per_id='".safeString($txt_id)."'";
				  $result2 = mysql_query($sqlstr,$db);
		    	  return True;
			    }  
		   } else {
		      $this->error = "PeriodeKaryawan telah digunakan pada perhitungan absen";
			  return False;
		   }				
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}


	function saveReload($txt_id,$db)
	{
	  $this->filterMPeriodeKaryawan();   
	  if ($this->existMPeriodeKaryawan($txt_id,$db)) {
		 $this->tgl_awal		= $this->data['tgl_awal'];  

		  // Simpan Detail
	      require_once("d_periode_karyawan.php");
		  $d_periode_karyawan	= new DPeriodeKaryawan;

		 $sqlstr = "select kry_id,div_id,dep_id,unit_id,sub_id,jab_id,subjab_id,grade_gol from karyawan 
		   where aktif=0 and  
			kry_id not in (select kry_id from d_periode_karyawan where per_id='$txt_id')
			order by kry_id";		  
		  $result2 =  mysql_query($sqlstr,$db);
		  while ($data2=mysql_fetch_array($result2)){
		     $d_periode_karyawan->det_id 	= 0;
			 $d_periode_karyawan->per_id 	= $txt_id;
			 $d_periode_karyawan->kry_id 	= $data2[kry_id];
			 $d_periode_karyawan->div_id 	= $data2[div_id];
			 $d_periode_karyawan->dep_id 	= $data2[dep_id];
			 $d_periode_karyawan->unit_id	= $data2[unit_id];
			 $d_periode_karyawan->sub_id	= $data2[sub_id];
			 $d_periode_karyawan->jab_id	= $data2[jab_id];
			 $d_periode_karyawan->subjab_id	= $data2[subjab_id];

			 $sqlstr3 = "select grade_gol from promosi_karyawan where kry_id=$data2[kry_id] 
			 and tgl_sk <= '$this->tgl_awal' order by tgl_sk desc limit 0,1 ";
			 $result3 = mysql_query($sqlstr3,$db);
			 if (mysql_num_rows($result3)>0) {
				 $data3	  = mysql_fetch_array($result3);
				 $d_periode_karyawan->grade_gol	= $data3[grade_gol];
			 } else {
				 $d_periode_karyawan->grade_gol	= $data2[grade_gol];
			 }
			 $d_periode_karyawan->saveDPeriodeKaryawan($db);
		  }
	      return True;
	  } else {
		 $this->error = "Data tidak ditemukan";
		 return False;
	  }
	}
	
	function saveMPeriodeKaryawan($db) 
	{   
	  $this->filterMPeriodeKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMPeriodeKaryawan($this->per_id,$db)) {
  	         $sqlstr = "update $this->tablename set tgl_awal='".$this->tgl_awal."',tgl_akhir='".safeString($this->tgl_akhir)."'
		        where per_id='".safeString($this->per_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(tgl_awal,tgl_akhir) 
		        values ('".safeString($this->tgl_awal)."',
		        '".safeString($this->tgl_akhir)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->per_id = mysql_insert_id(); 
			  // Simpan Detail
		      require_once("d_periode_karyawan.php");
			  $d_periode_karyawan	= new DPeriodeKaryawan;
				
			  $sqlstr = "select kry_id,div_id,dep_id,unit_id,sub_id,jab_id,subjab_id,grade_gol from karyawan 
			   where aktif=0 order by kry_id ";
			  $result2 =  mysql_query($sqlstr,$db);
			  while ($data2=mysql_fetch_array($result2)){
			     $d_periode_karyawan->det_id 	= 0;
				 $d_periode_karyawan->per_id 	= $this->per_id;
				 $d_periode_karyawan->kry_id 	= $data2[kry_id];
				 $d_periode_karyawan->div_id 	= $data2[div_id];
				 $d_periode_karyawan->dep_id 	= $data2[dep_id];
				 $d_periode_karyawan->unit_id	= $data2[unit_id];
				 $d_periode_karyawan->sub_id	= $data2[sub_id];
				 $d_periode_karyawan->jab_id	= $data2[jab_id];
				 $d_periode_karyawan->subjab_id	= $data2[subjab_id];

				 $sqlstr3 = "select grade_gol from promosi_karyawan where kry_id=$data2[kry_id] 
				 and tgl_sk <= '$this->tgl_awal' order by tgl_sk desc, promo_id desc limit 0,1 ";
				 $result3 = mysql_query($sqlstr3,$db);
				 if (mysql_num_rows($result3)>0) {
					 $data3	  = mysql_fetch_array($result3);
					 $d_periode_karyawan->grade_gol	= $data3[grade_gol];
				 } else {
					 $d_periode_karyawan->grade_gol	= $data2[grade_gol];
				 }
				 $d_periode_karyawan->saveDPeriodeKaryawan($db);
			  }
		      return True;
		    }  
       }
	} 
}

?>