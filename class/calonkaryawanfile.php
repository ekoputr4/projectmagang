<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class CKFile
{

    var $cf_id,$cln_id,$cf_file;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "calonkaryawan_file";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Calon Karyawan", $this->cln_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("File", $this->cf_file, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterCKFile()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->cf_id;
		$this->cf_id		= $myFilter->process($before);
		$before 			= $this->cln_id;
		$this->cln_id		= $myFilter->process($before);
		$before 			= $this->cf_file;
		$this->cf_file		= $myFilter->process($before);
	}


	function getData()
	{
         $this->cf_id		= $this->data['cf_id'];   
         $this->cln_id		= $this->data['cln_id'];   
         $this->cf_file 	= $this->data['cf_file'];   
	}

	function existCKFile($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where cf_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getCKFile($txt_id,$db) 
    {
       if (! $this->existCKFile($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delCKFile($txt_id,$db) 
	{
       if ($this->existCKFile($txt_id,$db)) {
           $this->cf_file 	= $this->data['cf_file'];   
	       $sqlstr = "delete from $this->tablename where cf_id='".safeString($txt_id)."'";
   	       if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    
			}
			  
           if (! $result) { 
	          return False;
		    } else { 
			  if (file_exists("calonfile/".$this->cf_file) && ($this->cf_file!="")) {
				 unlink("calonfile/".$this->cf_file);
			  }	 				
	    	  return True;
		    }  
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveCKFile($db) 
	{   
	  $this->new = 0;
	  $this->filterCKFile();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existCKFile($this->cf_id,$db)) {
  	         $sqlstr = "update $this->tablename set cf_file='".safeString($this->cf_file)."',
			 cln_id='".safeString($this->cln_id)."'
		        where cf_id='".safeString($this->cf_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(cf_file,cln_id) 
		        values ('".safeString($this->cf_file)."',
				'".safeString($this->cln_id)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->cf_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>