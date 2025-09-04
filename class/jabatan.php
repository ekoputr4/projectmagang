<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Jabatan
{

    var $jab_id,$jab_name,$jab_ket;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "jabatan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Jabatan", $this->jab_name, "text", "y", 30, 2);
	   $example->add_text_field("Keterangan", $this->jab_ket, "text", "n", 250, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterJabatan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->jab_name;
		$this->jab_name		= $myFilter->process($before);
		$before 			= $this->jab_ket;
		$this->jab_ket		= $myFilter->process($before);
	}


	function getData()
	{
         $this->jab_id		= $this->data['jab_id'];   
         $this->jab_name 	= $this->data['jab_name'];   
         $this->jab_ket 	= $this->data['jab_ket'];   
	}

	function existJabatan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where jab_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getJabatan($txt_id,$db) 
    {
       if (! $this->existJabatan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delJabatan($txt_id,$db) 
	{
       if ($this->existJabatan($txt_id,$db)) {
	       $sqlstr = "select jab_id from karyawan where jab_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where jab_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Jabatan masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveJabatan($db) 
	{   
	  $this->filterJabatan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existJabatan($this->jab_id,$db)) {
  	         $sqlstr = "update $this->tablename set jab_name='".safeString($this->jab_name)."',
			 jab_ket='".safeString($this->jab_ket)."'
		        where jab_id='".safeString($this->jab_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(jab_name,jab_ket) 
		        values ('".safeString($this->jab_name)."',
		        '".safeString($this->jab_ket)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->jab_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>