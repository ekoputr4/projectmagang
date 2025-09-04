<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DPeriodeKaryawan
{

    var $det_id,$per_id,$kry_id,$div_id,$dep_id,$unit_id,$sub_id,$jab_id,$subjab_id,$grade_gol;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "d_periode_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Periode", $this->per_id, "number", "y", 0 , 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0 , 0, 1);
	   $example->add_num_field("Divisi", $this->div_id, "number", "y", 0 , 0, 1);
	   $example->add_num_field("Departemen", $this->dep_id, "number", "n", 0 , 0, 1);
	   $example->add_num_field("Unit Kerja", $this->unit_id, "number", "n", 0 , 0, 1);
	   $example->add_num_field("SubUnit Kerja", $this->sub_id, "number", "n", 0 , 0, 1);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "n", 0 , 0, 1);
	   $example->add_num_field("Sub Jabatan", $this->subjab_id, "number", "n", 0 , 0, 1);
	   $example->add_text_field("Grade Gaji", $this->grade_gol, "text", "n", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDPeriodeKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->det_id;
		$this->det_id		= $myFilter->process($before);
		$before 			= $this->per_id;
		$this->per_id		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->div_id;
		$this->div_id		= $myFilter->process($before);
		$before 			= $this->dep_id;
		$this->dep_id		= $myFilter->process($before);
		$before 			= $this->unit_id;
		$this->unit_id		= $myFilter->process($before);
		$before 			= $this->sub_id;
		$this->sub_id		= $myFilter->process($before);
		$before 			= $this->jab_id;
		$this->jab_id		= $myFilter->process($before);
		$before 			= $this->subjab_id;
		$this->subjab_id	= $myFilter->process($before);
		$before 			= $this->grade_gol;
		$this->grade_gol	= $myFilter->process($before);
	}


	function getData()
	{
         $this->det_id		= $this->data['det_id']; 
		 $this->per_id		= $this->data['per_id'];  
         $this->kry_id	 	= $this->data['kry_id'];   
         $this->div_id	 	= $this->data['div_id'];   
         $this->dep_id	 	= $this->data['dep_id'];   
         $this->unit_id	 	= $this->data['unit_id'];   
         $this->sub_id	 	= $this->data['sub_id'];   
         $this->jab_id	 	= $this->data['jab_id'];   
         $this->subjab_id 	= $this->data['subjab_id'];   
         $this->grade_gol 	= $this->data['grade_gol'];   
	}

	function existDPeriodeKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where det_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDPeriodeKaryawan($txt_id,$db) 
    {
       if (! $this->existDPeriodeKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDPeriodeKaryawan($txt_id,$db) 
	{
       if ($this->existDPeriodeKaryawan($txt_id,$db)) {
	   	
	     /*  $sqlstr = "select det_id from harilibur where det_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where det_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		/*   } else {
		      $this->error = "DPeriodeKaryawan masih digunakan";
			  return False;
		   }				*/		
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDPeriodeKaryawan($db) 
	{   
	  $this->filterDPeriodeKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDPeriodeKaryawan($this->det_id,$db)) {
  	         $sqlstr = "update $this->tablename set per_id='".$this->per_id."',
			 kry_id='".safeString($this->kry_id)."',
			 div_id='".safeString($this->div_id)."'
			 dep_id='".safeString($this->dep_id)."',
			 unit_id='".safeString($this->unit_id)."',
			 sub_id='".safeString($this->sub_id)."',
			 jab_id='".safeString($this->jab_id)."',
			 subjab_id='".safeString($this->subjab_id)."',
			 grade_gol='".safeString($this->grade_gol)."'
		        where det_id='".safeString($this->det_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(per_id,kry_id,div_id,dep_id,unit_id,sub_id,jab_id,subjab_id,grade_gol) 
		        values ('".safeString($this->per_id)."',
		        '".safeString($this->kry_id)."',
		        '".safeString($this->div_id)."',
		        '".safeString($this->dep_id)."',
		        '".safeString($this->unit_id)."',
		        '".safeString($this->sub_id)."',
		        '".safeString($this->jab_id)."',
		        '".safeString($this->subjab_id)."',
		        '".safeString($this->grade_gol)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->det_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>