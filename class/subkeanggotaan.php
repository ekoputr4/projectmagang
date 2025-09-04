<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class SubKeanggotaan
{

    var $subang_id,$ang_id,$kry_id,$subang_iuran,$subang_nomor,$subang_keterangan,$tgl_aktif,$tgl_deaktif;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "subkeanggotaan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Keanggotaan", $this->ang_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Iuran", $this->subang_iuran, "number", "y", 0, 0, 1);
	   $example->add_text_field("Nomor", $this->subang_nomor, "text", "n", 30, 1);
	   $example->add_text_field("Keterangan", $this->subang_keterangan, "text", "n", 50, 1);
	   $example->add_date_field("Tanggal Mulai", $this->tgl_aktif, "date", "us", "y");
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSubKeanggotaan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 					= $this->subang_id;
		$this->subang_id			= $myFilter->process($before);
		$before 					= $this->ang_id;
		$this->ang_id				= $myFilter->process($before);
		$before 					= $this->kry_id;
		$this->kry_id				= $myFilter->process($before);
		$before 					= $this->subang_iuran;
		$this->subang_iuran			= $myFilter->process($before);
		$before 					= $this->subang_nomor;
		$this->subang_nomor			= $myFilter->process($before);
		$before 					= $this->subang_keterangan;
		$this->subang_keterangan	= $myFilter->process($before);
		$before 					= $this->tgl_aktif;
		$this->tgl_aktif			= $myFilter->process($before);
	}


	function getData()
	{
         $this->subang_id			= $this->data['subang_id'];   
         $this->ang_id 				= $this->data['ang_id'];   
         $this->kry_id 				= $this->data['kry_id'];   
         $this->subang_iuran		= $this->data['subang_iuran'];   
         $this->subang_nomor		= $this->data['subang_nomor'];   
         $this->subang_keterangan	= $this->data['subang_keterangan'];   
         $this->tgl_aktif			= $this->data['tgl_aktif'];   
         $this->tgl_deaktif			= $this->data['tgl_deaktif'];   
	}

	function existSubKeanggotaan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where subang_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSubKeanggotaan($txt_id,$db) 
    {
       if (! $this->existSubKeanggotaan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delSubKeanggotaan($txt_id,$db) 
	{
       if ($this->existSubKeanggotaan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where subang_id='".safeString($txt_id)."'";
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

	
	function saveSubKeanggotaan($db) 
	{   
   	  $this->new = 0;
	  $this->filterSubKeanggotaan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSubKeanggotaan($this->subang_id,$db)) {
  	         $sqlstr = "update $this->tablename set ang_id='".safeString($this->ang_id)."',
			 kry_id='".safeString($this->kry_id)."',
			 subang_iuran='".safeString($this->subang_iuran)."',
			 subang_nomor='".safeString($this->subang_nomor)."',
			 subang_keterangan='".safeString($this->subang_keterangan)."',
			 tgl_aktif='".safeString($this->tgl_aktif)."'
		        where subang_id='".safeString($this->subang_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(ang_id,kry_id,subang_iuran,subang_nomor,subang_keterangan,tgl_aktif) 
		        values ('".safeString($this->ang_id)."',
		        '".safeString($this->kry_id)."',
		        '".safeString($this->subang_iuran)."',
		        '".safeString($this->subang_nomor)."',
		        '".safeString($this->subang_keterangan)."',
		        '".safeString($this->tgl_aktif)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else {
			  if ($this->new == 1) 
	 			  $this->subang_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>