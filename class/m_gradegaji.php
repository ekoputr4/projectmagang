<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class MGradeGaji
{

    var $grade_gol,$old_grade_gol,$jab_id,$user_id;
	var $data,$error;
	var $good_fields = array();
	var $gj_id = array();
	var $value = array();
    var $tablename = "m_gradegaji";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Golongan", $this->grade_gol, "text", "y", 50, 1);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMGradeGaji()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->grade_gol;
		$this->grade_gol	= $myFilter->process($before);
		$before 			= $this->jab_id;
		$this->jab_id		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->grade_gol		= $this->data['grade_gol'];   
         $this->old_grade_gol	= $this->data['grade_gol'];   
         $this->jab_id 			= $this->data['jab_id'];   
		 
		 $sqlstr 	= "select * from d_gradegaji where grade_gol='".$this->grade_gol."'order by gj_id";
		 $result2	= mysql_query($sqlstr,$db);
		 $i = 0;
		 while ($data2 = mysql_fetch_array($result2)) {
		 	$i++;
			$this->gj_id[$i]	= $data2[gj_id];
			$this->value[$i]	= $data2[value];
		 }
	}

	function existMGradeGaji($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where grade_gol='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMGradeGaji($txt_id,$db) 
    {
       if (! $this->existMGradeGaji($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delMGradeGaji($txt_id,$db) 
	{
       if ($this->existMGradeGaji($txt_id,$db)) {
/*	       $sqlstr = "select grade_gol from karyawan where grade_gol='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select grade_gol from departemen where grade_gol='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {*/
				   $sqlstr = "delete from $this->tablename where grade_gol='".safeString($txt_id)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
/*			   } else {
				  $this->error = "MGradeGaji masih digunakan pada data departemen";
				  return False;
			   }						
		   } else {
		      $this->error = "MGradeGaji masih digunakan pada data Karyawan";
			  return False;
		   }	*/					
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMGradeGaji($db) 
	{   
	  $new = 0;
	  $this->filterMGradeGaji();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMGradeGaji($this->old_grade_gol,$db)) {
  	         $sqlstr = "update $this->tablename set jab_id='".safeString($this->jab_id)."',
			 grade_gol='".safeString($this->grade_gol)."'
		        where grade_gol='".safeString($this->old_grade_gol)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(grade_gol,jab_id) 
		        values ('".safeString($this->grade_gol)."',
				'".safeString($this->jab_id)."')";
			  $new = 1;	
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 

			  // Simpan	Detail Gaji
			  require_once("d_gradegaji.php");
			  require_once("h_gradegaji.php");
			  $dgradegaji = new DGradeGaji;
			  $hgradegaji = new HGradeGaji;			  
			  
			  $sqlstr 	= "select * from tipe_gaji order by gj_id";
			  $result2	= mysql_query($sqlstr,$db);
			  $i = 0;
			  while ($data=mysql_fetch_array($result2)) {
				 $i++;			  			
				 
				 if ($new==1) {	     
				     
					 $dgradegaji->grade_gol	= $this->grade_gol;
					 $dgradegaji->gj_id		= $data[gj_id];
					 $dgradegaji->value		= $this->value[$i];
					 if ($dgradegaji->saveDGradeGaji($db)) {					 
						$hgradegaji->grade_gol	= $dgradegaji->grade_gol;
						$hgradegaji->gj_id		= $dgradegaji->gj_id;
						$hgradegaji->value		= $dgradegaji->value;
						$hgradegaji->user_id	= $this->user_id;
						$hgradegaji->saveHGradeGaji($db);
					 } else {
					 	echo $dgradegaji->error;
					 }
				 } else {
					 if ($this->gj_id[$i]==$data[gj_id]) {
						 $dgradegaji->grade_gol	= $this->grade_gol;
						 $dgradegaji->gj_id		= $data[gj_id];
						 $dgradegaji->value		= $this->value[$i];
						 if ($dgradegaji->saveDGradeGaji($db)) {					 
							$hgradegaji->grade_gol	= $dgradegaji->grade_gol;
							$hgradegaji->gj_id		= $dgradegaji->gj_id;
							$hgradegaji->value		= $dgradegaji->value;
							$hgradegaji->user_id	= $this->user_id;
							$hgradegaji->saveHGradeGaji($db);
						 }
					 }
				 }
			  }
			  
		      return True;
		    }  
       }
	} 
}

?>