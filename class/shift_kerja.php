<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class ShiftKerja
{

    var $shift_id,$shift_name,$shift_code,$shift_in,$shift_out,$shift_lembur;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "shift_kerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Shift Kerja", $this->shift_name, "text", "y", 30, 2);
	   $example->add_text_field("Kode Shift", $this->shift_code, "text", "y", 5, 1);
	   $example->add_time_field("Jam Masuk", $this->shift_in, "time", "y");
	   $example->add_time_field("Jam Keluar", $this->shift_out, "time", "y");
	   $example->add_time_field("Jam Hitung Lembur", $this->shift_lembur, "time", "n");
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterShiftKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->shift_id;
		$this->shift_id		= $myFilter->process($before);
		$before 			= $this->shift_name;
		$this->shift_name	= $myFilter->process($before);
		$before 			= $this->shift_code;
		$this->shift_code	= $myFilter->process($before);
		$before 			= $this->shift_in;
		$this->shift_in		= $myFilter->process($before);
		$before 			= $this->shift_out;
		$this->shift_out	= $myFilter->process($before);
		$before 			= $this->shift_lembur;
		$this->shift_lembur	= $myFilter->process($before);
	}


	function getData()
	{
         $this->shift_id		= $this->data['shift_id'];   
         $this->shift_name 		= $this->data['shift_name'];   
         $this->shift_code 		= $this->data['shift_code'];   
         $this->shift_in 		= $this->data['shift_in'];   
         $this->shift_out 		= $this->data['shift_out'];   
         $this->shift_lembur	= $this->data['shift_lembur'];   
	}

	function existShiftKerja($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where shift_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getShiftKerja($txt_id,$db) 
    {
       if (! $this->existShiftKerja($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delShiftKerja($txt_id,$db) 
	{
       if ($this->existShiftKerja($txt_id,$db)) {
/*	       $sqlstr = "select shift_id from karyawan where shift_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where shift_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "ShiftKerja masih digunakan pada Jenis";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveShiftKerja($db) 
	{   
	  $this->filterShiftKerja();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existShiftKerja($this->shift_id,$db)) {
  	         $sqlstr = "update $this->tablename set shift_name='".safeString($this->shift_name)."',
			 shift_code='".safeString($this->shift_code)."',
			 shift_in='".safeString($this->shift_in)."',
			 shift_out='".safeString($this->shift_out)."',
			 shift_lembur='".safeString($this->shift_lembur)."'
		        where shift_id='".safeString($this->shift_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(shift_name,shift_code,shift_in,shift_out,shift_lembur) 
		        values ('".safeString($this->shift_name)."',
				'".safeString($this->shift_code)."',
				'".safeString($this->shift_in)."',
				'".safeString($this->shift_out)."',
				'".safeString($this->shift_lembur)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->shift_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>