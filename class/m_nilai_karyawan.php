<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MNilaiKaryawan
{

    var $nilkar_id,$kry_id,$jab_id,$sub_id,$periode_awal,$periode_akhir,$last_update;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "m_nilai_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("SubJabatan", $this->sub_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Periode Awal", $this->periode_awal, "date", "us", "y");
	   $example->add_date_field("Periode Akhir", $this->periode_akhir, "date", "us", "y");
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMNilaiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->nilkar_id;
		$this->nilkar_id	= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->jab_id;
		$this->jab_id		= $myFilter->process($before);
		$before 			= $this->sub_id;
		$this->sub_id		= $myFilter->process($before);
		$before 			= $this->periode_awal;
		$this->periode_awal	= $myFilter->process($before);
		$before 			= $this->periode_akhir;
		$this->periode_akhir	= $myFilter->process($before);
		$before 			= $this->last_update;
		$this->last_update	= $myFilter->process($before);
	}


	function getData()
	{
         $this->nilkar_id		= $this->data['nilkar_id'];   
         $this->kry_id 			= $this->data['kry_id'];   
         $this->jab_id 			= $this->data['jab_id'];   
         $this->sub_id 			= $this->data['sub_id'];   
         $this->periode_awal	= $this->data['periode_awal'];   
         $this->periode_akhir 	= $this->data['periode_akhir'];   
         $this->last_update 	= $this->data['last_update'];   
	}

	function existMNilaiKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where nilkar_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMNilaiKaryawan($txt_id,$db) 
    {
       if (! $this->existMNilaiKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delMNilaiKaryawan($txt_id,$db) 
	{
       if ($this->existMNilaiKaryawan($txt_id,$db)) {
/*	       $sqlstr = "select nilkar_id from karyawan where nilkar_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where nilkar_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "MNilaiKaryawan masih digunakan pada Karyawan";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMNilaiKaryawan($db) 
	{   
	  $this->filterMNilaiKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMNilaiKaryawan($this->nilkar_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 jab_id='".safeString($this->jab_id)."',
			 sub_id='".safeString($this->sub_id)."',
			 periode_awal='".safeString($this->periode_awal)."',
			 periode_akhir='".safeString($this->periode_akhir)."',
			 last_update='".safeString(date("Y-m-d H:i:s"))."'
		        where nilkar_id='".safeString($this->nilkar_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_id,jab_id,sub_id,periode_awal,periode_akhir,last_update) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->jab_id)."',
				'".safeString($this->sub_id)."',
				'".safeString($this->periode_awal)."',
				'".safeString($this->periode_akhir)."',
				'".safeString(date("Y-m-d H:i:s"))."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->nilkar_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>