<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DNilaiKaryawan
{

    var $dnil_id,$nilkar_id,$nilai_kode,$niljab_id,$dnil_name,$dnil_name2,$dnil_ket,$dnil_nilai;
	var	$dnil_bobot,$dnil_ket2,$last_update;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "d_nilai_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Nilai ID", $this->nilkar_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Kode Nilai", $this->nilai_kode, "text", "y", 2, 1);
	   $example->add_num_field("Kode Jabatan", $this->niljab_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Penilaian", $this->dnil_name, "text", "y", 50, 1);
	   $example->add_text_field("Penilaian 2", $this->dnil_name2, "text", "n", 50, 1);
	   $example->add_text_field("Detail Penilaian", $this->dnil_ket, "text", "n", 0, 1);
	   $example->add_num_field("Nilai", $this->dnil_nilai, "number", "y", 0, 0, 1);
	   $example->add_num_field("Bobot", $this->dnil_bobot, "number", "y", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->dnil_ket2, "text", "n", 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDNilaiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->dnil_id;
		$this->dnil_id		= $myFilter->process($before);
		$before 			= $this->nilkar_id;
		$this->nilkar_id	= $myFilter->process($before);
		$before 			= $this->nilai_kode;
		$this->nilai_kode	= $myFilter->process($before);
		$before 			= $this->niljab_id;
		$this->niljab_id	= $myFilter->process($before);
		$before 			= $this->dnil_name;
		$this->dnil_name	= $myFilter->process($before);
		$before 			= $this->dnil_name2;
		$this->dnil_name2	= $myFilter->process($before);
		$before 			= $this->dnil_ket;
		$this->dnil_ket		= $myFilter->process($before);
		$before 			= $this->dnil_nilai;
		$this->dnil_nilai	= $myFilter->process($before);
		$before 			= $this->dnil_bobot;
		$this->dnil_bobot	= $myFilter->process($before);
		$before 			= $this->dnil_ket2;
		$this->dnil_ket2	= $myFilter->process($before);
		$before 			= $this->last_update;
		$this->last_update	= $myFilter->process($before);
	}


	function getData()
	{
         $this->dnil_id				= $this->data['dnil_id'];   
         $this->nilkar_id 			= $this->data['nilkar_id'];   
         $this->nilai_kode 			= $this->data['nilai_kode'];   
         $this->niljab_id 			= $this->data['niljab_id'];   
         $this->dnil_name			= $this->data['dnil_name'];   
         $this->dnil_name2			= $this->data['dnil_name2'];   
         $this->dnil_ket 			= $this->data['dnil_ket'];   
         $this->dnil_nilai			= $this->data['dnil_nilai'];   
         $this->dnil_bobot 			= $this->data['dnil_bobot'];   
         $this->dnil_ket2 			= $this->data['dnil_ket2'];   
         $this->last_update 		= $this->data['last_update'];   
	}

	function existDNilaiKaryawan($txt_id,$db) 
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


    function getDNilaiKaryawan($txt_id,$db) 
    {
       if (! $this->existDNilaiKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDNilaiKaryawan($txt_id,$db) 
	{
       if ($this->existDNilaiKaryawan($txt_id,$db)) {
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
		      $this->error = "DNilaiKaryawan masih digunakan pada Karyawan";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDNilaiKaryawan($db) 
	{   
	  $this->filterDNilaiKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDNilaiKaryawan($this->dnil_id,$db)) {
  	         $sqlstr = "update $this->tablename set nilkar_id='".safeString($this->nilkar_id)."',
			 nilai_kode='".safeString($this->nilai_kode)."',
			 niljab_id='".safeString($this->niljab_id)."',
			 dnil_name='".safeString($this->dnil_name)."',
			 dnil_name2='".safeString($this->dnil_name2)."',
			 dnil_ket='".safeString($this->dnil_ket)."',
			 dnil_nilai='".safeString($this->dnil_nilai)."',
			 dnil_bobot='".safeString($this->dnil_bobot)."',
			 dnil_ket2='".safeString($this->dnil_ket2)."'
		        where dnil_id='".safeString($this->dnil_id)."'";
	       } else {
		   	  $this->new = 1;
 	          $sqlstr = "insert into $this->tablename(nilkar_id,nilai_kode,niljab_id,dnil_name,dnil_name2,
				  dnil_ket,dnil_nilai,dnil_bobot,dnil_ket2) 
		        values ('".safeString($this->nilkar_id)."',
				'".safeString($this->nilai_kode)."',
				'".safeString($this->niljab_id)."',
				'".safeString($this->dnil_name)."',
				'".safeString($this->dnil_name2)."',
				'".safeString($this->dnil_ket)."',
				'".safeString($this->dnil_nilai)."',
				'".safeString($this->dnil_bobot)."',
				'".safeString($this->dnil_ket2)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->dnil_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>