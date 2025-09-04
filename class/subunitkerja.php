<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class SubUnitKerja
{

    var $sub_id,$unit_id,$sub_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "subunitkerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Unit Kerja", $this->unit_id, "text", "y", 0, 0, 1);
	   $example->add_text_field("Sub Unit Kerja", $this->sub_name, "text", "y", 30, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSubUnitKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->unit_id;
		$this->unit_id		= $myFilter->process($before);
		$before 			= $this->sub_name;
		$this->sub_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->sub_id		= $this->data['sub_id'];   
         $this->unit_id		= $this->data['unit_id'];   
         $this->sub_name 	= $this->data['sub_name'];   
	}

	function existSubUnitKerja($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where sub_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSubUnitKerja($txt_id,$db) 
    {
       if (! $this->existSubUnitKerja($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delSubUnitKerja($txt_id,$db) 
	{
       if ($this->existSubUnitKerja($txt_id,$db)) {
	       $sqlstr = "select sub_id from karyawan where sub_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "delete from $this->tablename where sub_id='".safeString($txt_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
				  
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		      $this->error = "Sub Unit masih digunakan pada data Karyawan";
			  return False;
		   }				
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveSubUnitKerja($db) 
	{   
	  $this->filterSubUnitKerja();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSubUnitKerja($this->sub_id,$db)) {
  	         $sqlstr = "update $this->tablename set sub_name='".safeString($this->sub_name)."',
			 unit_id='".safeString($this->unit_id)."'
		        where sub_id='".safeString($this->sub_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(unit_id,sub_name) 
		        values ('".safeString($this->unit_id)."',
				'".safeString($this->sub_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->sub_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>