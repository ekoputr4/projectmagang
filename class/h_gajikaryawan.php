<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class HGajiKaryawan
{

    var $h_id,$grade_gol,$kry_id,$last_update,$user_id;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "h_gajikaryawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Grade Gaji", $this->grade_gol, "text", "y", 20, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("User", $this->user_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHGajiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->grade_gol;
		$this->grade_gol	= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->user_id;
		$this->user_id		= $myFilter->process($before);
		$before 			= $this->h_id;
		$this->h_id			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->grade_gol	= $this->data['grade_gol'];   
         $this->kry_id		= $this->data['kry_id'];   
         $this->h_id 		= $this->data['h_id'];   
         $this->user_id		= $this->data['user_id'];   
         $this->last_update	= $this->data['last_update'];   
	}

	function existHGajiKaryawan($txt_id,$txt_id2,$db) 
	{
	   $sqlstr = "select * from $this->tablename where grade_gol='".safeString($txt_id)."' and
	     kry_id='".safeString($txt_id2)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHGajiKaryawan($txt_id,$txt_id2,$db) 
    {
       if (! $this->existHGajiKaryawan($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delHGajiKaryawan($txt_id,$db) 
	{
       if ($this->existHGajiKaryawan($txt_id,$txt_id2,$db)) {
		   $sqlstr = "delete from $this->tablename where h_id='".safeString($txt_id)."'";
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

	
	function saveHGajiKaryawan($db) 
	{   
	  $this->filterHGajiKaryawan();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(grade_gol,kry_id,user_id,last_update) 
	        values ('".safeString($this->grade_gol)."',
			'".safeString($this->kry_id)."',
			'".safeString($this->user_id)."',
			'".safeString(date("Y-m-d H:i:s"))."')";

           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  $this->h_id = mysql_insert_id();
		      return True;
		    }  
       }
	} 
}

?>