
<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MNilaiJabatan
{

    var $niljab_id,$jab_id,$sub_id;
	var $new;
	var $jab_name,$sub_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "m_nilaijabatan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Sub Jabatan", $this->sub_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMNilaiJabatan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->niljab_id;
		$this->niljab_id		= $myFilter->process($before);
		$before 				= $this->jab_id;
		$this->jab_id			= $myFilter->process($before);
		$before 				= $this->sub_id;
		$this->sub_id			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->niljab_id		= $this->data['niljab_id'];   
         $this->jab_id 			= $this->data['jab_id'];   
         $this->sub_id 			= $this->data['sub_id'];   
		 require_once("jabatan.php");
		 $jabatan = new Jabatan;
		 $jabatan->getJabatan($this->jab_id,$db);
		 $this->jab_name		= $jabatan->jab_name;
		 require_once("subjabatan.php");
		 $subjabatan = new SubJabatan;
		 $subjabatan->getSubJabatan($this->sub_id,$db);
		 $this->sub_name		= $subjabatan->sub_name;
	}

	function existMNilaiJabatan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where niljab_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

	function existMNilaiJabatan2($txt_id,$txt_id2,$db) 
	{
	   $sqlstr = "select * from $this->tablename where jab_id='".safeString($txt_id)."' and 
	   	sub_id='".safeString($txt_id2)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getMNilaiJabatan($txt_id,$db) 
    {
       if (! $this->existMNilaiJabatan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

    function getMNilaiJabatan2($txt_id,$txt_id2,$db) 
    {
       if (! $this->existMNilaiJabatan2($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delMNilaiJabatan($txt_id,$db) 
	{
       if ($this->existMNilaiJabatan($txt_id,$db)) {
/*	       $sqlstr = "select niljab_id from karyawan where niljab_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where niljab_id='".safeString($txt_id)."'";
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

	function saveMNilaiJabatan($db) 
	{   
	  $this->new = 0;
	  $this->filterMNilaiJabatan();   
	  if ($this->cekVariabel($db))  {	  
		  if ($this->existMNilaiJabatan($this->niljab_id,$db)) {
  	         $sqlstr = "update $this->tablename set jab_id='".safeString($this->jab_id)."',
			 sub_id='".safeString($this->sub_id)."'
		        where niljab_id='".safeString($this->niljab_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(jab_id,sub_id) 
		        values ('".safeString($this->jab_id)."',
				'".safeString($this->sub_id)."')";
			  $this->new = 1;	
		    }
			
		   if (!$result = mysql_query($sqlstr,$db))  {
			   $this->error = mysql_error();    }
		   if (! $result) { 
			  return False;
			} else { 
 			  $this->niljab_id = mysql_insert_id(); 				
			  return True;
			}  
       }
	} 
}

?>