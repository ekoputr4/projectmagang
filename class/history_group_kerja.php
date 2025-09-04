<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class HistoryGroupKerja
{

    var $kry_id,$subgroup_old,$subgroup_new,$tgl_mutasi;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "history_group_kerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "text", "y", 0, 0, 1);
	   $example->add_num_field("Group Lama", $this->subgroup_old, "text", "y", 0, 0, 1);
	   $example->add_num_field("Group Baru", $this->subgroup_new, "text", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterHistoryGroupKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->subgroup_old;
		$this->subgroup_old	= $myFilter->process($before);
		$before 			= $this->subgroup_new;
		$this->subgroup_new	= $myFilter->process($before);
	}


	function delHistoryGroupKerja($txt_id,$db) 
	{
       if ($this->existHistoryGroupKerja($txt_id,$db)) {
/*	       $sqlstr = "select kry_id from unit_kerja where kry_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where kry_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "HistoryGroupKerja masih digunakan pada data unit kerja";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveHistoryGroupKerja($db) 
	{   
	  $this->filterHistoryGroupKerja();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(kry_id,subgroup_old,subgroup_new,tgl_mutasi) 
	        values ('".safeString($this->kry_id)."',
			'".safeString($this->subgroup_old)."',
			'".safeString($this->subgroup_new)."',
			'".safeString(date("Y-m-d H:i:s"))."')";

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