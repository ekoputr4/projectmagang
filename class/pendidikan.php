<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Pendidikan
{

    var $pend_id,$pend_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "pendidikan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Pendidikan", $this->pend_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPendidikan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->pend_name;
		$this->pend_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->pend_id		= $this->data['pend_id'];   
         $this->pend_name 	= $this->data['pend_name'];   
	}

	function existPendidikan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where pend_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPendidikan($txt_id,$db) 
    {
       if (! $this->existPendidikan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delPendidikan($txt_id,$db) 
	{
       if ($this->existPendidikan($txt_id,$db)) {
	       $sqlstr = "select pend_id from pendidikan_karyawan where pend_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where pend_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Pendidikan masih digunakan pada data karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function savePendidikan($db) 
	{   
	  $this->filterPendidikan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPendidikan($this->pend_id,$db)) {
  	         $sqlstr = "update $this->tablename set pend_name='".safeString($this->pend_name)."'
		        where pend_id='".safeString($this->pend_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(pend_name) 
		        values ('".safeString($this->pend_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->pend_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>