<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class HSubKeanggotaan
{

    var $h_id,$subang_id,$tgl_aktif,$subang_iuran,$last_update,$user_id;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "h_subkeanggotaan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Keanggotaan", $this->subang_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Aktif", $this->tgl_aktif, "date", "us", "y");
	   $example->add_num_field("Iuran", $this->subang_iuran, "number", "y", 0, 0, 1);
	   $example->add_num_field("User", $this->user_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHSubKeanggotaan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->subang_id;
		$this->subang_id	= $myFilter->process($before);
		$before 			= $this->tgl_aktif;
		$this->tgl_aktif	= $myFilter->process($before);
		$before 			= $this->subang_iuran;
		$this->subang_iuran	= $myFilter->process($before);
		$before 			= $this->user_id;
		$this->user_id		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->subang_id		= $this->data['subang_id'];   
         $this->tgl_aktif		= $this->data['tgl_aktif'];   
         $this->subang_iuran 	= $this->data['subang_iuran'];   
         $this->user_id		 	= $this->data['user_id'];   
	}

	function existHSubKeanggotaan($txt_id,$txt_id2,$db) 
	{
	   $sqlstr = "select * from $this->tablename where subang_id='".safeString($txt_id)."' and
	     tgl_aktif='".safeString($txt_id2)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHSubKeanggotaan($txt_id,$txt_id2,$db) 
    {
       if (! $this->existHSubKeanggotaan($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delHSubKeanggotaan($txt_id,$txt_id2,$db) 
	{
       if ($this->existHSubKeanggotaan($txt_id,$txt_id2,$db)) {
/*	       $sqlstr = "select subang_id from karyawan where subang_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select subang_id from departemen where subang_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {*/
				   $sqlstr = "delete from $this->tablename where subang_id='".safeString($txt_id)."'
				    and tgl_aktif='".safeString($txt_id2)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
/*			   } else {
				  $this->error = "HSubKeanggotaan masih digunakan pada data departemen";
				  return False;
			   }						
		   } else {
		      $this->error = "HSubKeanggotaan masih digunakan pada data Karyawan";
			  return False;
		   }	*/					
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveHSubKeanggotaan($db) 
	{   
//    var $h_id,$subang_id,$tgl_aktif,$subang_iuran,$last_update,$user_id;
	  $this->filterHSubKeanggotaan();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(subang_id,tgl_aktif,subang_iuran,user_id,last_update) 
	        values ('".safeString($this->subang_id)."',
			'".safeString($this->tgl_aktif)."',
			'".safeString($this->subang_iuran)."',
			'".safeString($this->user_id)."',
			'".safeString(date("Y-m-d H:i:s"))."')";

           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
       }
	} 
}

?>