<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DNilaiJabatan
{

    var $dnil_id,$niljab_id,$nilai_kode,$dnil_name,$dnil_ket,$dnil_bobot,$dnil_sub,$dnil_parent;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "d_nilaijabatan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kompetensi", $this->dnil_name, "text", "y", 50, 1);
	   $example->add_num_field("Kode Penilaian", $this->niljab_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Kode Nilai", $this->nilai_kode, "text", "y", 2, 1);
	   if ($this->dnil_sub==0) {
		   $example->add_text_field("Keterangan", $this->dnil_ket, "text", "y", 0, 1);
		   $example->add_num_field("Bobot", $this->dnil_bobot, "number", "y", 2, 0, 1);
	   } else {	   
		   $example->add_text_field("Keterangan", $this->dnil_ket, "text", "n", 0, 0);
		   $example->add_num_field("Bobot", $this->dnil_bobot, "number", "n", 2, 0, 1);
	   }	   
	   $example->add_num_field("Memiliki Sub", $this->dnil_sub, "number", "n", 1, 0, 1);
	   $example->add_num_field("Parent", $this->dnil_parent, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDNilaiJabatan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->dnil_id;
		$this->dnil_id			= $myFilter->process($before);
		$before 				= $this->niljab_id;
		$this->niljab_id		= $myFilter->process($before);
		$before 				= $this->nilai_kode;
		$this->nilai_kode		= $myFilter->process($before);
		$before 				= $this->dnil_name;
		$this->dnil_name		= $myFilter->process($before);
		$before 				= $this->dnil_ket;
		$this->dnil_ket			= $myFilter->process($before);
		$before 				= $this->dnil_bobot;
		$this->dnil_bobot		= $myFilter->process($before);
		$before 				= $this->dnil_sub;
		$this->dnil_sub			= $myFilter->process($before);
		$before 				= $this->dnil_parent;
		$this->dnil_parent		= $myFilter->process($before);
	}


	function getData()
	{
         $this->dnil_id			= $this->data['dnil_id'];   
         $this->niljab_id		= $this->data['niljab_id'];   
         $this->nilai_kode 		= $this->data['nilai_kode'];   
         $this->dnil_name 		= $this->data['dnil_name'];   
         $this->dnil_ket		= $this->data['dnil_ket'];   
         $this->dnil_bobot		= $this->data['dnil_bobot'];   
         $this->dnil_sub		= $this->data['dnil_sub'];   
         $this->dnil_parent		= $this->data['dnil_parent'];   
	}

	function existDNilaiJabatan($txt_id,$db) 
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


    function getDNilaiJabatan($txt_id,$db) 
    {
       if (! $this->existDNilaiJabatan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDNilaiJabatan($txt_id,$db) 
	{
       if ($this->existDNilaiJabatan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where dnil_id='".safeString($txt_id)."'";
   	       if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    
			}
		  
           if (! $result) { 
	          return False;
		    } else { 
		       $sqlstr = "delete from $this->tablename where dnil_parent='".safeString($txt_id)."'";
			   mysql_query($sqlstr,$db);			
	    	  return True;
		    }  
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function cekJml($db)
	{
		$sqlstr = "SELECT sum( dnil_name ) AS total FROM $this->tablename 
			where dnil_id<>'".safeString($this->old_dnil_id)."'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0) {
			$data = mysql_fetch_array($result);
			return $data[total];
		} else {
			return 0;
		}
		mysql_free_result($result);
	}
	
	function saveDNilaiJabatan($db) 
	{   
	  $this->filterDNilaiJabatan();   
	  if ($this->cekVariabel($db))  {	  
		  if ($this->existDNilaiJabatan($this->dnil_id,$db)) {
  	         $sqlstr = "update $this->tablename set niljab_id='".safeString($this->niljab_id)."',
			 nilai_kode='".safeString($this->nilai_kode)."',
			 dnil_name='".safeString($this->dnil_name)."',
			 dnil_ket='".safeString($this->dnil_ket)."',
			 dnil_bobot='".safeString($this->dnil_bobot)."',
			 dnil_sub='".safeString($this->dnil_sub)."',
			 dnil_parent='".safeString($this->dnil_parent)."'
		        where dnil_id='".safeString($this->dnil_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(niljab_id,nilai_kode,dnil_name,dnil_ket,dnil_bobot,dnil_sub,dnil_parent) 
		        values ('".safeString($this->niljab_id)."',
				'".safeString($this->nilai_kode)."',
				'".safeString($this->dnil_name)."',
				'".safeString($this->dnil_ket)."',
				'".safeString($this->dnil_bobot)."',
				'".safeString($this->dnil_sub)."',
				'".safeString($this->dnil_parent)."')";
		    }
			
//		   if ($this->cekJml($db)+$this->dnil_name <=100) {				   	      
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    }
			   if (! $result) { 
				  return False;
				} else { 
				  $this->dnil_id	= mysql_insert_id();
				  return True;
				}  
/*		   } else {
		   	  $this->error	= "Total Bobot melebihi 100";
		   	  return False;
		   }	*/
       }
	} 
}

?>