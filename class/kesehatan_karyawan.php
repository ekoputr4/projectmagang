<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class KesehatanKaryawan
{

    var $kes_kry_id,$kry_id,$kes_sakit,$kes_tingkat,$kes_tahun,$kes_rs;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "kesehatan_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Jenis Sakit", $this->kes_sakit, "text", "y", 50, 1);
	   $example->add_num_field("Tingkat", $this->kes_tingkat, "number", "y", 0, 0, 1);
	   $example->add_num_field("Tahun", $this->kes_tahun, "number", "y", 1, 0, 0);
	   $example->add_num_field("Rawat Rumah Sakit", $this->kes_rs, "number", "n", 1, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKesehatanKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->kes_kry_id;
		$this->kes_kry_id		= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->kes_sakit;
		$this->kes_sakit		= $myFilter->process($before);
		$before 				= $this->kes_tingkat;
		$this->kes_tingkat		= $myFilter->process($before);
		$before 				= $this->kes_tahun;
		$this->kes_tahun		= $myFilter->process($before);
		$before 				= $this->kes_rs;
		$this->kes_rs		= $myFilter->process($before);
	}


	function getData()
	{
         $this->kes_kry_id		= $this->data['kes_kry_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->kes_sakit		= $this->data['kes_sakit'];   
         $this->kes_tingkat		= $this->data['kes_tingkat'];   
         $this->kes_tahun		= $this->data['kes_tahun'];   
         $this->kes_rs			= $this->data['kes_rs'];   
	}

	function existKesehatanKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kes_kry_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKesehatanKaryawan($txt_id,$db) 
    {
       if (! $this->existKesehatanKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKesehatanKaryawan($txt_id,$db) 
	{
       if ($this->existKesehatanKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where kes_kry_id='".safeString($txt_id)."'";
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

	
	function saveKesehatanKaryawan($db) 
	{   
	  $this->filterKesehatanKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKesehatanKaryawan($this->kes_kry_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 kes_sakit='".safeString($this->kes_sakit)."',
			 kes_tingkat='".safeString($this->kes_tingkat)."',
			 kes_tahun='".safeString($this->kes_tahun)."',
			 kes_rs='".safeString($this->kes_rs)."'
		        where kes_kry_id='".safeString($this->kes_kry_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,kes_sakit,kes_tingkat,kes_tahun,kes_rs) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->kes_sakit)."',
				'".safeString($this->kes_tingkat)."',
				'".safeString($this->kes_tahun)."',
				'".safeString($this->kes_rs)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->kes_kry_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>