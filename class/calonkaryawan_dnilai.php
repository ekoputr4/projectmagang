<?
/*
  Write : Onix
  Last Modified : Mar 13, 2009
*/

class CalonKaryawanDNilai
{

    var $dnil_id,$kl_name,$cln_id,$cln_nilai,$cln_sub,$cln_parent;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "calonkaryawan_dnilai";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kualifikasi", $this->kl_name, "text", "y", 50, 2);
	   $example->add_num_field("Calon Karyawan", $this->cln_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Nilai", $this->cln_nilai, "number", "n", 0, 0, 1);
	   $example->add_num_field("Sub", $this->cln_sub, "number", "n", 0, 0, 1);
	   $example->add_num_field("Parent", $this->cln_parent, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterCalonKaryawanDNilai()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 					= $this->dnil_id;
		$this->dnil_id				= $myFilter->process($before);
		$before 					= $this->kl_name;
		$this->kl_name				= $myFilter->process($before);
		$before 					= $this->cln_id;
		$this->cln_id				= $myFilter->process($before);
		$before 					= $this->cln_nilai;
		$this->cln_nilai			= $myFilter->process($before);
		$before 					= $this->cln_sub;
		$this->cln_sub				= $myFilter->process($before);
		$before 					= $this->cln_parent;
		$this->cln_parent			= $myFilter->process($before);
	}


	function getData()
	{
         $this->dnil_id				= $this->data['dnil_id'];   
         $this->kl_name 			= $this->data['kl_name'];   
         $this->cln_id				= $this->data['cln_id'];   
         $this->cln_nilai	 		= $this->data['cln_nilai'];   
         $this->cln_sub			 	= $this->data['cln_sub'];   
         $this->cln_parent		 	= $this->data['cln_parent'];   
	}

	function existCalonKaryawanDNilai($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where dnil_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCalonKaryawanDNilai($txt_id,$db) 
    {
       if (! $this->existCalonKaryawanDNilai($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delCalonKaryawanDNilai($txt_id,$db) 
	{
       if ($this->existCalonKaryawanDNilai($txt_id,$db)) {
/*	       $sqlstr = "select dnil_id from karyawan where dnil_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where dnil_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "CalonKaryawanDNilai masih digunakan pada Karyawan";
			  return False;
		   }			*/			
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveCalonKaryawanDNilai($db) 
	{   
	  $this->filterCalonKaryawanDNilai();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existCalonKaryawanDNilai($this->dnil_id,$db)) {
  	         $sqlstr = "update $this->tablename set kl_name='".safeString($this->kl_name)."',
			 cln_id='".safeString($this->cln_id)."',
			 cln_nilai='".safeString($this->cln_nilai)."',
			 cln_sub='".safeString($this->cln_sub)."',
			 cln_parent='".safeString($this->cln_parent)."'
		        where dnil_id='".safeString($this->dnil_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(dnil_id,kl_name,cln_id,cln_nilai,cln_sub,cln_parent) 
		        values ('".safeString($this->dnil_id)."',
				'".safeString($this->kl_name)."',
				'".safeString($this->cln_id)."',
				'".safeString($this->cln_nilai)."',
				'".safeString($this->cln_sub)."',
				'".safeString($this->cln_parent)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
			  	$this->dnil_id	= mysql_insert_id();
		      return True;
		    }  
       }
	} 
}

?>