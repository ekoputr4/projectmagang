<?
/*
  Write : Onix
  Last Modified : Mar 13, 2009
*/

class CalonKaryawanHNilai
{

    var $cln_id,$cln_pewawancara,$cln_undang,$cln_komentar,$cln_last_update;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "calonkaryawan_hnilai";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Calon Karyawan", $this->cln_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Pewawancara", $this->cln_pewawancara, "text", "y", 50, 2);
	   $example->add_num_field("DiUndang Kembali?", $this->cln_undang, "number", "n", 0, 0, 1);
	   $example->add_text_field("Komentar", $this->cln_komentar, "text", "n", 0, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterCalonKaryawanHNilai()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 					= $this->cln_id;
		$this->cln_id				= $myFilter->process($before);
		$before 					= $this->cln_pewawancara;
		$this->cln_pewawancara		= $myFilter->process($before);
		$before 					= $this->cln_undang;
		$this->cln_undang			= $myFilter->process($before);
		$before 					= $this->cln_komentar;
		$this->cln_komentar			= $myFilter->process($before);
	}


	function getData()
	{
         $this->cln_id				= $this->data['cln_id'];   
         $this->cln_pewawancara 	= $this->data['cln_pewawancara'];   
         $this->cln_undang			= $this->data['cln_undang'];   
         $this->cln_komentar	 	= $this->data['cln_komentar'];   
         $this->cln_last_update	 	= $this->data['cln_last_update'];   
	}

	function existCalonKaryawanHNilai($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where cln_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCalonKaryawanHNilai($txt_id,$db) 
    {
       if (! $this->existCalonKaryawanHNilai($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delCalonKaryawanHNilai($txt_id,$db) 
	{
       if ($this->existCalonKaryawanHNilai($txt_id,$db)) {
/*	       $sqlstr = "select cln_id from karyawan where cln_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where cln_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "CalonKaryawanHNilai masih digunakan pada Karyawan";
			  return False;
		   }			*/			
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveCalonKaryawanHNilai($db) 
	{   
	  $this->filterCalonKaryawanHNilai();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existCalonKaryawanHNilai($this->cln_id,$db)) {
  	         $sqlstr = "update $this->tablename set cln_pewawancara='".safeString($this->cln_pewawancara)."',
			 cln_undang='".safeString($this->cln_undang)."',
			 cln_komentar='".safeString($this->cln_komentar)."',
			 cln_last_update='".safeString(date("Y-m-d H:i:s"))."'
		        where cln_id='".safeString($this->cln_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(cln_id,cln_pewawancara,cln_undang,cln_komentar,cln_last_update) 
		        values ('".safeString($this->cln_id)."',
				'".safeString($this->cln_pewawancara)."',
				'".safeString($this->cln_undang)."',
				'".safeString($this->cln_komentar)."',
				'".safeString(date("Y-m-d H:i:s"))."')";
		    }
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