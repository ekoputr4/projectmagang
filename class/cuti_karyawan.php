<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class CutiKaryawan
{

    var $cuti_id,$kry_id,$cuti_date,$ket_id,$cuti_ket,$cuti_lock;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "cuti_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Cuti", $this->cuti_date, "text", "y", 3, 1);
	   $example->add_num_field("Cuti", $this->ket_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->cuti_ket, "text", "n", 0, 0);
	   if ($example->validation()) {	       
	   	   if ($this->cekSisaCuti($db))	
		       return True;
		   else 
		   	   return False;	   
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekSisaCuti($db)
	{
	   $sqlstr = "select * from ket_cuti where ket_id='$this->ket_id'"; 
	   $result2 = mysql_query($sqlstr,$db);
	   if (mysql_num_rows($result2)>0) {
		   $data2 = mysql_fetch_array($result2);
		   if ($data2[ket_potong]==1) {			   
			   $sqlstr = "select jml_cuti,cuti_expired from karyawan where kry_id=$this->kry_id ";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)>0) {
				  $data = mysql_fetch_array($result);
				  if ($data[jml_cuti]>0) {
					  $skrg  = strtotime(date("Y-m-d")) ;
					  $waktu = strtotime($data[cuti_expired]);
					  $hasil = ($waktu - $skrg)/86400;
					  if ($hasil>=1) 
						  return True;
					  else
						  $this->error .= "Cuti anda telah expired";
				  } else {
					  $this->error = "Sisa Cuti telah habis";
					  return False;
				  }	
			   } else {
				  $this->error = "Data tidak ditemukan";
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
	
	function filterCutiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->cuti_date;
		$this->cuti_date	= $myFilter->process($before);
		$before 			= $this->ket_id;
		$this->ket_id		= $myFilter->process($before);
		$before 			= $this->cuti_ket;
		$this->cuti_ket		= $myFilter->process($before);
		$before 			= $this->cuti_lock;
		$this->cuti_lock	= $myFilter->process($before);
	}


	function getData()
	{
         $this->cuti_id		= $this->data['cuti_id'];   
         $this->kry_id 		= $this->data['kry_id'];   
         $this->cuti_date 	= $this->data['cuti_date'];   
         $this->ket_id 		= $this->data['ket_id'];   
         $this->cuti_ket	= $this->data['cuti_ket'];   
         $this->cuti_lock	= $this->data['cuti_lock'];   
	}

	function existCutiKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where cuti_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCutiKaryawan($txt_id,$db) 
    {
       if (! $this->existCutiKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delCutiKaryawan($txt_id,$db) 
	{
       if ($this->existCutiKaryawan($txt_id,$db)) {
           $this->cuti_lock		= $this->data['cuti_lock'];   	   	   
	       $this->ket_id 		= $this->data['ket_id'];   
           $this->kry_id 		= $this->data['kry_id'];   
		   if ($this->cuti_lock==0) { 
		       $sqlstr = "delete from $this->tablename where cuti_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}

	           if (! $result) { 
		          return False;
			    } else { 

				  $sqlstr = "select ket_potong from ket_cuti where ket_id='$this->ket_id'"; 
				  $result2 = mysql_query($sqlstr,$db);
				  if (mysql_num_rows($result2)>0) {
					  $data2 = mysql_fetch_array($result2);
					  if ($data2[ket_potong]==1) {		
						  $sqlstr 	= "select jml_cuti from karyawan where kry_id=$this->kry_id";
						  $result3	= mysql_query($sqlstr,$db);
						  $data3 	= mysql_fetch_array($result3);				  				  
						  $jml		= intval($data3[jml_cuti]) + 1;				  
						  $sqlstr	= "update karyawan set jml_cuti=$jml where kry_id=$this->kry_id";
						  mysql_query($sqlstr,$db);
			  		  }
				  }
					
		    	  return True;
			    }  
		   } else {
		      $this->error = "Cuti Karyawan sudah dihitung dalam gaji";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function lockCuti($db)
	{
	  $this->filterCutiKaryawan();   
	  if ($this->existCutiKaryawan($this->cuti_id,$db)) {
         $sqlstr = "update $this->tablename set 
		 cuti_lock='".safeString($this->cuti_lock)."'
	        where cuti_id='".safeString($this->cuti_id)."'";

           if (!$result = mysql_query($sqlstr,$db))  
		       $this->error = mysql_error();    
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  		 		 	
	  } else {
	  	$this->error = "Data Cuti tidak ditemukan";
	  	return False;
	  }			
	}
	
	function saveCutiKaryawan($db) 
	{   
	  $this->filterCutiKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existCutiKaryawan($this->cuti_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 cuti_date='".safeString($this->cuti_date)."', 
			 ket_id='".safeString($this->ket_id)."',
			 cuti_ket='".safeString($this->cuti_ket)."'
		        where cuti_id='".safeString($this->cuti_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_id,cuti_date,ket_id,cuti_ket) 
		        values ('".safeString($this->kry_id)."',
		        '".safeString($this->cuti_date)."',
		        '".safeString($this->ket_id)."',
		        '".safeString($this->cuti_ket)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1) {
	 			  $this->cuti_id = mysql_insert_id(); 
				  
				  $sqlstr = "select ket_potong from ket_cuti where ket_id='$this->ket_id'";
				  $result3 = mysql_query($sqlstr,$db);				  
				  if (mysql_num_rows($result3)>0) {
				  	  $data3 = mysql_fetch_array($result3);
					  if ($data3[ket_potong]==1) {					  
						  $sqlstr 	= "select jml_cuti from karyawan where kry_id=$this->kry_id";
						  $result2	= mysql_query($sqlstr,$db);
						  $data 	= mysql_fetch_array($result2);				  				  
						  $jml		= intval($data[jml_cuti]) - 1;				  
						  $sqlstr	= "update karyawan set jml_cuti=$jml where kry_id=$this->kry_id";
						  mysql_query($sqlstr,$db);
					  }
				  }	  
			  }	  
		      return True;
		    }  
       }
	} 
}

?>