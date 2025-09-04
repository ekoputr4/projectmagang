<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class PelKaryawan
{

    var $pel_id,$kry_id,$pel_pembuat,$pel_name,$pel_thn,$pel_tmpt,$pel_stfkt,$pel_ket;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "pelatihan_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Pelatihan", $this->pel_name, "text", "y", 50, 1);
	   $example->add_text_field("Penyelenggara", $this->pel_pembuat, "text", "y", 30, 1);
	   $example->add_num_field("Tahun", $this->pel_thn, "number", "y", 1, 0, 0);
	   $example->add_text_field("Tempat", $this->pel_tmpt, "text", "y", 30, 0);
	   $example->add_num_field("Sertifikat", $this->pel_stfkt, "number", "n", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->pel_ket, "text", "n", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPelKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->pel_id;
		$this->pel_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->pel_pembuat;
		$this->pel_pembuat		= $myFilter->process($before);
		$before 				= $this->pel_name;
		$this->pel_name			= $myFilter->process($before);
		$before 				= $this->pel_thn;
		$this->pel_thn			= $myFilter->process($before);
		$before 				= $this->pel_tmpt;
		$this->pel_tmpt			= $myFilter->process($before);
		$before 				= $this->pel_stfkt;
		$this->pel_stfkt		= $myFilter->process($before);
		$before 				= $this->pel_ket;
		$this->pel_ket			= $myFilter->process($before);
	}


	function getData()
	{
         $this->pel_id			= $this->data['pel_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->pel_pembuat		= $this->data['pel_pembuat'];   
         $this->pel_name		= $this->data['pel_name'];   
         $this->pel_thn			= $this->data['pel_thn'];   
         $this->pel_tmpt		= $this->data['pel_tmpt'];   
         $this->pel_stfkt		= $this->data['pel_stfkt'];   
         $this->pel_ket			= $this->data['pel_ket'];   
	}

	function existPelKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where pel_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPelKaryawan($txt_id,$db) 
    {
       if (! $this->existPelKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delPelKaryawan($txt_id,$db) 
	{
       if ($this->existPelKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where pel_id='".safeString($txt_id)."'";
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

	
	function savePelKaryawan($db) 
	{   
	  $this->filterPelKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPelKaryawan($this->pel_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 pel_pembuat='".safeString($this->pel_pembuat)."',
			 pel_name='".safeString($this->pel_name)."',
			 pel_thn='".safeString($this->pel_thn)."',
			 pel_tmpt='".safeString($this->pel_tmpt)."',
			 pel_stfkt='".safeString($this->pel_stfkt)."',
			 pel_ket='".safeString($this->pel_ket)."'
		        where pel_id='".safeString($this->pel_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,pel_pembuat,pel_name,pel_thn,pel_tmpt,pel_stfkt,pel_ket) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->pel_pembuat)."',
				'".safeString($this->pel_name)."',
				'".safeString($this->pel_thn)."',
				'".safeString($this->pel_tmpt)."',
				'".safeString($this->pel_stfkt)."',
				'".safeString($this->pel_ket)."')";
		    }
			//echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->pel_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>