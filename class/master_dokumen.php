<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MasterDokumen
{

    var $mt_id,$mt_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "master_dokumen";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Group Dokumen", $this->mt_name, "text", "y", 50, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterDokumen()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->mt_name;
		$this->mt_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->mt_id		= $this->data['mt_id'];   
         $this->mt_name 	= $this->data['mt_name'];   
	}

	function existMasterDokumen($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where mt_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasterDokumen($txt_id,$db) 
    {
       if (! $this->existMasterDokumen($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delMasterDokumen($txt_id,$db) 
	{
       if ($this->existMasterDokumen($txt_id,$db)) {
	       $sqlstr = "select mt_id from detail_dokumen where mt_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where mt_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Group Dokumen masih digunakan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMasterDokumen($db) 
	{   
	  $this->filterMasterDokumen();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterDokumen($this->mt_id,$db)) {
  	         $sqlstr = "update $this->tablename set mt_name='".safeString($this->mt_name)."'
		        where mt_id='".safeString($this->mt_id)."'";
	       } else {
		      $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(mt_name) 
		        values ('".safeString($this->mt_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->mt_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>