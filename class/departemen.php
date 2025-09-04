<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class Departemen
{

    var $dep_id,$div_id,$dep_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "departemen";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Division", $this->div_id, "text", "y", 0, 0, 1);
	   $example->add_text_field("Departemen", $this->dep_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDepartemen()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->div_id;
		$this->div_id		= $myFilter->process($before);
		$before 			= $this->dep_name;
		$this->dep_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->dep_id		= $this->data['dep_id'];   
         $this->div_id		= $this->data['div_id'];   
         $this->dep_name 	= $this->data['dep_name'];   
	}

	function existDepartemen($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where dep_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDepartemen($txt_id,$db) 
    {
       if (! $this->existDepartemen($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDepartemen($txt_id,$db) 
	{
       if ($this->existDepartemen($txt_id,$db)) {
	       $sqlstr = "select dep_id from karyawan where dep_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select dep_id from unit_kerja where dep_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {
				   $sqlstr = "delete from $this->tablename where dep_id='".safeString($txt_id)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
			   } else {
				  $this->error = "Departemen masih digunakan pada data unit kerja";
				  return False;
			   }						
		   } else {
		      $this->error = "Departemen masih digunakan pada data Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDepartemen($db) 
	{   
	  $this->filterDepartemen();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDepartemen($this->dep_id,$db)) {
  	         $sqlstr = "update $this->tablename set dep_name='".safeString($this->dep_name)."',
			 div_id='".safeString($this->div_id)."'
		        where dep_id='".safeString($this->dep_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(div_id,dep_name) 
		        values ('".safeString($this->div_id)."',
				'".safeString($this->dep_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->dep_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>