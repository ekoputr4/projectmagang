<?
/*
  Write : Onix
  Last Modified : Feb 12, 2009
*/

class DKaryawanGroup
{

    var $subgroup_id,$kry_id;
	var $old_subgroup_id;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "d_karyawan_group";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("SubGroup Kerja", $this->subgroup_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDKaryawanGroup()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->subgroup_id;
		$this->subgroup_id	= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
	}


	function getData()
	{
         $this->subgroup_id	= $this->data['subgroup_id'];   
         $this->kry_id 		= $this->data['kry_id'];   
	}

	function existDKaryawanGroup($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kry_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDKaryawanGroup($txt_id,$txt_id2,$db) 
    {
       if (! $this->existDKaryawanGroup($txt_id,$txt_id2,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDKaryawanGroup($txt_id,$db) 
	{
       if ($this->existDKaryawanGroup($txt_id,$db)) {
         $this->old_subgroup_id	= $this->data['subgroup_id'];   
		       $sqlstr = "delete from $this->tablename where kry_id='".safeString($txt_id)."'";
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

	
	function saveDKaryawanGroup($db) 
	{   
	  $this->filterDKaryawanGroup();   
	  if ($this->cekVariabel($db))  {
		  $this->delDKaryawanGroup($this->kry_id,$db);
          $sqlstr = "insert into $this->tablename(subgroup_id,kry_id) 
	        values ('".safeString($this->subgroup_id)."',
			'".safeString($this->kry_id)."')";
			
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->subgroup_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>