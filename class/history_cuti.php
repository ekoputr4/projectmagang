<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class HCuti
{

    var $h_id,$jml_add,$kry_id,$date_add,$date_expired;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "history_cuti";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Jumlah Cuti", $this->jml_add, "number", "y", 2, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Expired", $this->date_expired, "date", "us", "y");
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHCuti()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->jml_add;
		$this->jml_add		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->date_expired;
		$this->date_expired	= $myFilter->process($before);
		$before 			= $this->h_id;
		$this->h_id			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->jml_add			= $this->data['jml_add'];   
         $this->kry_id			= $this->data['kry_id'];   
         $this->h_id 			= $this->data['h_id'];   
         $this->date_expired	= $this->data['date_expired'];   
         $this->date_add		= $this->data['date_add'];   
	}

	function existHCuti($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where h_id='".safeString($txt_id)."'  limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getHCuti($txt_id,$txt_id2,$db) 
    {
       if (! $this->existHCuti($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delHCuti($txt_id,$db) 
	{
       if ($this->existHCuti($txt_id,$txt_id2,$db)) {
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

	
	function saveHCuti($db) 
	{   
	  $this->filterHCuti();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(jml_add,kry_id,date_expired,date_add) 
	        values ('".safeString($this->jml_add)."',
			'".safeString($this->kry_id)."',
			'".safeString($this->date_expired)."',
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