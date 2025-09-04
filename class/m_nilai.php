<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MNilai
{

    var $nilai_kode,$old_nilai_kode,$nilai_bobot,$nilai_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "m_nilai";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kode Nilai", $this->nilai_kode, "text", "y", 2, 1);
	   $example->add_text_field("Nama", $this->nilai_name, "text", "y", 50, 1);
	   $example->add_num_field("Bobot", $this->nilai_bobot, "number", "y", 2, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMNilai()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->old_nilai_kode;
		$this->old_nilai_kode	= $myFilter->process($before);
		$before 				= $this->nilai_kode;
		$this->nilai_kode		= $myFilter->process($before);
		$before 				= $this->nilai_bobot;
		$this->nilai_bobot		= $myFilter->process($before);
		$before 				= $this->nilai_name;
		$this->nilai_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->old_nilai_kode		= $this->data['nilai_kode'];   
         $this->nilai_kode			= $this->data['nilai_kode'];   
         $this->nilai_bobot 		= $this->data['nilai_bobot'];   
         $this->nilai_name 			= $this->data['nilai_name'];   
	}

	function existMNilai($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where nilai_kode='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMNilai($txt_id,$db) 
    {
       if (! $this->existMNilai($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delMNilai($txt_id,$db) 
	{
       if ($this->existMNilai($txt_id,$db)) {
/*	       $sqlstr = "select nilai_kode from karyawan where nilai_kode='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where nilai_kode='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "Nilai Appraisal masih digunakan pada Jenis";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function cekJml($db)
	{
		$sqlstr = "SELECT sum( nilai_bobot ) AS total FROM $this->tablename 
			where nilai_kode<>'".safeString($this->old_nilai_kode)."'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0) {
			$data = mysql_fetch_array($result);
			return $data[total];
		} else {
			return 0;
		}
		mysql_free_result($result);
	}
	
	function saveMNilai($db) 
	{   
	  $this->filterMNilai();   
	  if ($this->cekVariabel($db))  {	  
		  if ($this->existMNilai($this->old_nilai_kode,$db)) {
  	         $sqlstr = "update $this->tablename set nilai_kode='".safeString($this->nilai_kode)."',
			 nilai_bobot='".safeString($this->nilai_bobot)."',
			 nilai_name='".safeString($this->nilai_name)."'
		        where nilai_kode='".safeString($this->old_nilai_kode)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(nilai_kode,nilai_bobot,nilai_name) 
		        values ('".safeString($this->nilai_kode)."',
				'".safeString($this->nilai_bobot)."',
				'".safeString($this->nilai_name)."')";
		    }
			
		   if ($this->cekJml($db)+$this->nilai_bobot <=100) {				   	      
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		   	  $this->error	= "Total Bobot melebihi 100";
		   	  return False;
		   }	
       }
	} 
}

?>