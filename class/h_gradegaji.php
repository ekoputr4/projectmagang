<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class HGradeGaji
{

    var $grade_gol,$gj_id,$value,$last_update,$user_id;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "h_gradegaji";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Golongan", $this->grade_gol, "text", "y", 50, 1);
	   $example->add_num_field("Tipe Gaji", $this->gj_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Nilai", $this->value, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHGradeGaji()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->grade_gol;
		$this->grade_gol	= $myFilter->process($before);
		$before 			= $this->gj_id;
		$this->gj_id		= $myFilter->process($before);
		$before 			= $this->value;
		$this->value	= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->grade_gol	= $this->data['grade_gol'];   
         $this->gj_id		= $this->data['gj_id'];   
         $this->value 		= $this->data['value'];   
	}

	function existHGradeGaji($txt_id,$txt_id2,$db) 
	{
	   $sqlstr = "select * from $this->tablename where grade_gol='".safeString($txt_id)."' and
	     gj_id='".safeString($txt_id2)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHGradeGaji($txt_id,$txt_id2,$db) 
    {
       if (! $this->existHGradeGaji($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delHGradeGaji($txt_id,$txt_id2,$db) 
	{
       if ($this->existHGradeGaji($txt_id,$txt_id2,$db)) {
/*	       $sqlstr = "select grade_gol from karyawan where grade_gol='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select grade_gol from departemen where grade_gol='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {*/
				   $sqlstr = "delete from $this->tablename where grade_gol='".safeString($txt_id)."'
				    and gj_id='".safeString($txt_id2)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
/*			   } else {
				  $this->error = "HGradeGaji masih digunakan pada data departemen";
				  return False;
			   }						
		   } else {
		      $this->error = "HGradeGaji masih digunakan pada data Karyawan";
			  return False;
		   }	*/					
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveHGradeGaji($db) 
	{   
	  $this->filterHGradeGaji();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(grade_gol,gj_id,value,user_id,last_update) 
	        values ('".safeString($this->grade_gol)."',
			'".safeString($this->gj_id)."',
			'".safeString($this->value)."',
			'".safeString($this->user_id)."',
			'".safeString(date("Y-m-d"))."')";

//			echo $sqlstr;
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