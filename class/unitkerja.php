<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class UnitKerja
{

    var $unit_id,$dep_id,$unit_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "unitkerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Departemen", $this->dep_id, "text", "y", 0, 0, 1);
	   $example->add_text_field("Unit Kerja", $this->unit_name, "text", "y", 30, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterUnitKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->dep_id;
		$this->dep_id		= $myFilter->process($before);
		$before 			= $this->unit_name;
		$this->unit_name	= $myFilter->process($before);
	}


	function getData()
	{
         $this->unit_id		= $this->data['unit_id'];   
         $this->dep_id		= $this->data['dep_id'];   
         $this->unit_name 	= $this->data['unit_name'];   
	}

	function existUnitKerja($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where unit_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getUnitKerja($txt_id,$db) 
    {
       if (! $this->existUnitKerja($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delUnitKerja($txt_id,$db) 
	{
       if ($this->existUnitKerja($txt_id,$db)) {
	       $sqlstr = "select unit_id from karyawan where unit_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select unit_id from subunitkerja where unit_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {
				   $sqlstr = "delete from $this->tablename where unit_id='".safeString($txt_id)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
			   } else {
				  $this->error = "UnitKerja masih digunakan pada data Sub unit kerja";
				  return False;
			   }						
		   } else {
		      $this->error = "UnitKerja masih digunakan pada data Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveUnitKerja($db) 
	{   
	  $this->filterUnitKerja();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existUnitKerja($this->unit_id,$db)) {
  	         $sqlstr = "update $this->tablename set unit_name='".safeString($this->unit_name)."',
			 dep_id='".safeString($this->dep_id)."'
		        where unit_id='".safeString($this->unit_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(dep_id,unit_name) 
		        values ('".safeString($this->dep_id)."',
				'".safeString($this->unit_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->unit_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>