<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
  status = Status Jaminan Dokumen
  0 = Pengajuan Jaminan
  1 = Approve
  2 = Tolak Jaminan
  3 = Pengajuan Kembali
  4 = Approve Kembali
  5 = Tolak Kembali
  
*/

class PenjaminanDokumen
{

    var $jamin_id,$kry_id,$dokumen_name,$dokumen_nmr,$nomor1,$nomor2,$tgl_jamin,$hrd_name,$jamin_name,$tgl_balik,$status;
	var $tgl_approve,$tgl_approve2,$status2;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "penjaminan_dokumen";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Nama Dokumen", $this->dokumen_name, "text", "y", 50, 1);
	   $example->add_text_field("Nomor Dokumen", $this->dokumen_nmr, "text", "y", 50, 1);
	   $example->add_text_field("Nomor Surat", $this->nomor1, "text", "y", 50, 1);
	   $example->add_date_field("Tanggal Penjaminan", $this->tgl_jamin, "date", "us", "y");
	   $example->add_text_field("Nama HRD", $this->hrd_name, "text", "y", 50, 1);
	   $example->add_text_field("Penerima Jaminan", $this->jamin_name, "text", "y", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabel2($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("ID", $this->jamin_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Status", $this->status, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Balik", $this->tgl_balik, "date", "us", "y");
	   $example->add_text_field("Nomor Surat", $this->nomor2, "text", "y", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPenjaminanDokumen()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->jamin_id;
		$this->jamin_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->dokumen_name;
		$this->dokumen_name		= $myFilter->process($before);
		$before 				= $this->dokumen_nmr;
		$this->dokumen_nmr		= $myFilter->process($before);
		$before 				= $this->nomor1;
		$this->nomor1			= $myFilter->process($before);
		$before 				= $this->nomor2;
		$this->nomor2			= $myFilter->process($before);
		$before 				= $this->tgl_jamin;
		$this->tgl_jamin		= $myFilter->process($before);
		$before 				= $this->jamin_name;
		$this->jamin_name		= $myFilter->process($before);
		$before 				= $this->tgl_balik;
		$this->tgl_balik		= $myFilter->process($before);
		$before 				= $this->status;
		$this->status			= $myFilter->process($before);
		$before 				= $this->status2;
		$this->status2			= $myFilter->process($before);
		$before 				= $this->tgl_approve;
		$this->tgl_approve		= $myFilter->process($before);
		$before 				= $this->tgl_approve2;
		$this->tgl_approve2		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->jamin_id		= $this->data['jamin_id'];   
         $this->kry_id 			= $this->data['kry_id'];   
         $this->dokumen_name 	= $this->data['dokumen_name'];   
         $this->dokumen_nmr 	= $this->data['dokumen_nmr'];   
         $this->nomor1		 	= $this->data['nomor1'];   
         $this->nomor2		 	= $this->data['nomor2'];   
         $this->tgl_jamin	 	= $this->data['tgl_jamin'];   
         $this->hrd_name	 	= $this->data['hrd_name'];   
         $this->jamin_name	 	= $this->data['jamin_name'];   
         $this->tgl_balik	 	= $this->data['tgl_balik'];   
         $this->status		 	= $this->data['status'];   
         $this->status2		 	= $this->data['status2'];   
         $this->tgl_approve	 	= $this->data['tgl_approve'];   
         $this->tgl_approve2 	= $this->data['tgl_approve2'];   
	}

	function existPenjaminanDokumen($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where jamin_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPenjaminanDokumen($txt_id,$db) 
    {
       if (! $this->existPenjaminanDokumen($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delPenjaminanDokumen($txt_id,$db) 
	{
       if ($this->existPenjaminanDokumen($txt_id,$db)) {
		   $this->status 	= $this->data[status];
		   if ($this->status==0) {
		       $sqlstr = "delete from $this->tablename where jamin_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Jaminan Dokumen telah dikembalikan atau diproses";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function savePengembalianDokumen($db) 
	{   
	  $this->filterPenjaminanDokumen();   
	  if ($this->cekVariabel2($db))  {
		  if ($this->existPenjaminanDokumen($this->jamin_id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			 tgl_balik='".safeString($this->tgl_balik)."',
			 nomor2='".safeString($this->nomor2)."',
			 status='3'
		        where jamin_id='".safeString($this->jamin_id)."'";		      
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		  } else {
		  	  $this->error = "Penjaminan tidak ditemukan";	
		  	  return False;
		  }
	  }
	}

	function saveBatalBalik($db) 
	{   
	  $this->filterPenjaminanDokumen();   
		  if ($this->existPenjaminanDokumen($this->jamin_id,$db)) {
	         $this->status		 	= $this->data['status'];   
			 if ($this->status==3) {		  
				 $sqlstr = "update $this->tablename set 
				 tgl_balik='0000-00-00',
				 nomor2='',
				 status='1'
					where jamin_id='".safeString($this->jamin_id)."'";		      
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    }
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
			 } else {
			  	  $this->error = "Penjaminan telah diproses";	
			  	  return False;
			 }		
		  } else {
		  	  $this->error = "Penjaminan tidak ditemukan";	
		  	  return False;
		  }
	}
	
	function saveApprove($db) {
	  if ($this->existPenjaminanDokumen($this->jamin_id,$db)) {
         $sqlstr = "update $this->tablename set
		 status='".safeString($this->status)."',
		 tgl_approve='".safeString(date("Y-m-d"))."'
	        where jamin_id='".safeString($this->jamin_id)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 			
		      return True;
		    }  
	  } else {
	  	return False;
		$this->error = "Penjaminan tidak ditemukan";
	  }		
	}

	function saveApprove2($db) {
	  if ($this->existPenjaminanDokumen($this->jamin_id,$db)) {
			 $sqlstr = "update $this->tablename set
			 status='".safeString($this->status)."',
			 tgl_approve2='".safeString(date("Y-m-d"))."'
				where jamin_id='".safeString($this->jamin_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 			
				  return True;
				}  
	  } else {
	  	return False;
		$this->error = "Penjaminan tidak ditemukan";
	  }		
	}
	
	function savePenjaminanDokumen($db) 
	{   
	  $this->filterPenjaminanDokumen();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPenjaminanDokumen($this->jamin_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 dokumen_name='".safeString($this->dokumen_name)."',
			 dokumen_nmr='".safeString($this->dokumen_nmr)."',
			 nomor1='".safeString($this->nomor1)."',
			 tgl_jamin='".safeString($this->tgl_jamin)."',
			 hrd_name='".safeString($this->hrd_name)."',
			 jamin_name='".safeString($this->jamin_name)."',
			 tgl_balik='".safeString($this->tgl_balik)."',
			 status='".safeString($this->status)."'
		        where jamin_id='".safeString($this->jamin_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_id,dokumen_name,dokumen_nmr,nomor1,tgl_jamin,hrd_name,jamin_name,tgl_balik,status) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->dokumen_name)."',
				'".safeString($this->dokumen_nmr)."',
				'".safeString($this->nomor1)."',
				'".safeString($this->tgl_jamin)."',
				'".safeString($this->hrd_name)."',
				'".safeString($this->jamin_name)."',
				'".safeString($this->tgl_balik)."',
				'".safeString($this->status)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->jamin_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>