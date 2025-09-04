<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class CutiOnline
{

    var $cut_id,$jumlah,$kry_id,$ket_id,$keterangan,$ket_approve,$status,$tgl_approve,$level_cuti,$tgl_cuti,$tgl_pengajuan,$group_id;
	var $status_approve;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "cuti_online";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Jumlah Cuti", $this->jumlah, "number", "y", 2, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Group User", $this->group_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Cuti", $this->ket_id, "number", "y", 2, 0, 1);
	   $example->add_num_field("Level Cuti", $this->level_cuti, "number", "y", 0, 0, 1);
	   $example->add_num_field("Status", $this->status, "number", "n", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->keterangan, "text", "y", 0, 1);
	   $example->add_text_field("Keterangan Approve", $this->ket_approve, "text", "n", 0, 1);
	   $example->add_date_field("Tanggal Cuti", $this->tgl_cuti, "date", "us", "y");
	   $example->add_date_field("Tanggal Pengajuan", $this->tgl_pengajuan, "date", "us", "y");
	   if ($example->validation()) {	       
	   	   if ($this->validHari()==true && ($this->validJmlCuti($db)==true) &&
		   	($this->validLibur($this->tgl_cuti,$db)==true) )
		       return True;
		   else
		   	   return False;	   
       } else {
	       $this->error = $example->create_msg();
		   $this->validHari();
		   $this->validLibur($this->tgl_cuti,$db);
		   $this->validJmlCuti($db);
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function validHari()
	{
		$skrg  = strtotime($this->tgl_pengajuan) ;
		$waktu = strtotime($this->tgl_cuti);
		$hasil = ($waktu - $skrg)/86400;
		if ($hasil>=3) 
			return True;
		else
			$this->error .= "Cuti harus diajukan 3 Hari sebelumnya\\n";
	} 

	function validLibur($txt_id,$db)
	{
		$sqlstr = "select tanggal from harilibur where tanggal='".safeString($txt_id)."'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0) 
			$this->error .= "Tanggal cuti merupakan hari libur\\n";
		else
			return True;	
	} 

	
	function validJmlCuti($db)
	{
	   $sisa = 0;
	   $sqlstr = "select * from ket_cuti where ket_id='$this->ket_id'"; 
	   $result2 = mysql_query($sqlstr,$db);
	   if (mysql_num_rows($result2)>0) {
		   $data2 = mysql_fetch_array($result2);
		   if ($data2[ket_potong]==1) {			   
				if ($this->kry_id>0) {
					$sqlstr = "select jml_cuti,cuti_expired from karyawan where kry_id=$this->kry_id and aktif=0 ";
					$result = mysql_query($sqlstr,$db);
					if (mysql_num_rows($result)>0) {
						$data = mysql_fetch_array($result);				
						if ($this->jumlah <= $data[jml_cuti] && $data[jml_cuti]>0) {
							  $skrg  = strtotime(date("Y-m-d")) ;
							  $waktu = strtotime($data[cuti_expired]);
							  $hasil = ($waktu - $skrg)/86400;
							  if ($hasil>=1) 
								  return True;
							  else
								  $this->error .= "Cuti anda telah expired";				
							return True;
						} else {	
							$this->error .= "Sisa Cuti anda tidak cukup";
						}
					} else {
						$this->error .= "Cuti anda telah habis";
						return False;
					}
				} else {		
					$this->error .= "Cuti anda telah habis";
					return False;
				}		
		    } else {
				return True;
			}
	   } else {
		  $this->error = "Keterangan Cuti tidak ditemukan";
		  return False;	   
	   }
	}
		
	function filterCutiOnline()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->jumlah;
		$this->jumlah		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->group_id;
		$this->group_id		= $myFilter->process($before);
		$before 			= $this->ket_id;
		$this->ket_id		= $myFilter->process($before);
		$before 			= $this->keterangan;
		$this->keterangan	= $myFilter->process($before);
		$before 			= $this->ket_approve;
		$this->ket_approve	= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
		$before 			= $this->tgl_approve;
		$this->tgl_approve	= $myFilter->process($before);
		$before 			= $this->level_cuti;
		$this->level_cuti	= $myFilter->process($before);
		$before 				= $this->tgl_cuti;
		$this->tgl_cuti			= $myFilter->process($before);
		$before 				= $this->tgl_pengajuan;
		$this->tgl_pengajuan	= $myFilter->process($before);
		$before 			= $this->cut_id;
		$this->cut_id		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->kry_id			= $this->data['kry_id'];   
         $this->cut_id 			= $this->data['cut_id'];   
         $this->ket_id 			= $this->data['ket_id'];   
         $this->group_id 		= $this->data['group_id'];   
         $this->keterangan		= $this->data['keterangan'];   
         $this->ket_approve		= $this->data['ket_approve'];   
         $this->status 			= $this->data['status'];   
         $this->tgl_approve		= $this->data['tgl_approve'];   
         $this->tgl_pengajuan	= $this->data['tgl_pengajuan'];   
         $this->tgl_cuti		= $this->data['tgl_cuti'];   
	}

	function existCutiOnline($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where cut_id='".safeString($txt_id)."'  limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCutiOnline($txt_id,$txt_id2,$db) 
    {
       if (! $this->existCutiOnline($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delCutiOnline($txt_id,$db) 
	{
       if ($this->existCutiOnline($txt_id,$txt_id2,$db)) {
		   $sqlstr = "delete from $this->tablename where cut_id='".safeString($txt_id)."'";
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


	function existData($db) 
	{
	   $sqlstr = "select * from $this->tablename where tgl_cuti='".safeString($this->tgl_cuti)."'  
	   and kry_id='".safeString($this->kry_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       return True;
	   }
	}
	
	function cekVariabelApprove($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Cuti", $this->cut_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 
	
	function approveCuti($db)
	{
	  $this->filterCutiOnline();   
	  if ($this->existCutiOnline($this->cut_id,$db) )  {
          $this->kry_id			= $this->data['kry_id'];   
          $this->cut_id 		= $this->data['cut_id'];   
          $this->ket_id 		= $this->data['ket_id'];   
          $this->keterangan		= $this->data['keterangan'];   
          $this->tgl_cuti		= $this->data['tgl_cuti'];   
		  $this->status 		= $this->data[status];
		  $this->level_cuti 	= $this->data[level_cuti];
		  
		  $selisih = $this->status_approve - $this->status;
		  if (($level_cuti < $this->status_approve) &&
		  		($selisih==1)) { 
			  $sqlstr = "update $this->tablename 
			  set status='".safeString($this->status_approve)."',
			  tgl_approve='".safeString(date("Y-m-d H:i:s"))."'
			  where cut_id='".safeString($this->cut_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 			
				  require_once("cuti_karyawan.php");
				  $cutikaryawan	= new CutiKaryawan;
				  if ($this->level_cuti==1 && $this->status_approve==3) {
					  $cutikaryawan->cuti_date		= $this->tgl_cuti;		
					  $cutikaryawan->kry_id			= $this->kry_id;
					  $cutikaryawan->ket_id			= $this->ket_id;
					  $cutikaryawan->cuti_ket		= $this->keterangan;
					  $cutikaryawan->saveCutiKaryawan($db);
				  } elseif ($this->level_cuti>1 && $this->status_approve==4) {
					  $cutikaryawan->cuti_date		= $this->tgl_cuti;		
					  $cutikaryawan->kry_id			= $this->kry_id;
					  $cutikaryawan->ket_id			= $this->ket_id;
					  $cutikaryawan->cuti_ket		= $this->keterangan;
					  $cutikaryawan->saveCutiKaryawan($db);				  	
				  }
				  
				  return True;
				}  			  
		  } else {
		  	 $this->error = "Status Cuti tidak sesuai";
			 return False;
		  }	  
	  	
	  } else {
	  	$this->error = "Data tidak ditemukan";
	  	return False;
	  }
	}
	
	function rejectCuti($db)
	{
	  $this->filterCutiOnline();   
	  if ($this->existCutiOnline($this->cut_id,$db) )  {
          $this->kry_id			= $this->data['kry_id'];   
          $this->cut_id 		= $this->data['cut_id'];   
          $this->ket_id 		= $this->data['ket_id'];   
          $this->keterangan		= $this->data['keterangan'];   
          $this->tgl_cuti		= $this->data['tgl_cuti'];   
		  $this->status 		= $this->data[status];
		  $this->level_cuti 	= $this->data[level_cuti];
		  
		  $selisih = $this->status_approve - $this->status;
		  if (($level_cuti < $this->status_approve) &&
		  		($selisih==1)) { 
			  $sqlstr = "update $this->tablename 
			  set status='1".safeString($this->status_approve)."',
			  ket_approve='".safeString($this->ket_approve)."',
			  tgl_approve='".safeString(date("Y-m-d H:i:s"))."'
			  where cut_id='".safeString($this->cut_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 			
				  return True;
				}  			  
		  } else {
		  	 $this->error = "Status Cuti tidak sesuai";
			 return False;
		  }	  
	  	
	  } else {
	  	$this->error = "Data tidak ditemukan";
	  	return False;
	  }
	}
	
	function saveCutiOnline($db) 
	{   
	  $this->filterCutiOnline();   
	  if ($this->cekVariabel($db))  {
	     if (!$this->existData($db)) {
          $sqlstr = "insert into $this->tablename(ket_id,group_id,kry_id,keterangan,status,level_cuti,tgl_cuti,tgl_pengajuan) 
	        values ('".safeString($this->ket_id)."',
			'".safeString($this->group_id)."',
			'".safeString($this->kry_id)."',
			'".safeString($this->keterangan)."',
			'".safeString($this->status)."',
			'".safeString($this->level_cuti)."',
			'".safeString($this->tgl_cuti)."',
			'".safeString(date("Y-m-d H:i:s"))."')";

           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 			  
			  $this->cut_id = mysql_insert_id();
			  if ($this->jumlah > 1) {
			  	 for ($x=1;$x<$this->jumlah;$x++) {
				 	$tgl	= strtotime($this->tgl_cuti);
				    $skrg   = mktime(0,0,0,date("m",$tgl),date("d",$tgl)+$x,date("Y",$tgl));						
					if ($this->validLibur(date("Y-m-d",$skrg),$db)) {
					  $sqlstr = "insert into $this->tablename(ket_id,group_id,kry_id,keterangan,status,level_cuti,tgl_cuti,tgl_pengajuan) 
						values ('".safeString($this->ket_id)."',
						'".safeString($this->group_id)."',
						'".safeString($this->kry_id)."',
						'".safeString($this->keterangan)."',
						'".safeString($this->status)."',
						'".safeString($this->level_cuti)."',
						'".safeString(date("Y-m-d",$skrg))."',
						'".safeString(date("Y-m-d H:i:s"))."')";
					  mysql_query($sqlstr,$db);						
					}
				 }
			  }
		      return True;
		    }  
		 } else {
		 	$this->error = "Data Cuti pada tanggal tersebut telah diajukan";
		 	return False;
		 }	
       }
	} 
}

?>