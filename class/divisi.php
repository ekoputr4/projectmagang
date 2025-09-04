<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class Divisi
{

    var $div_id,$div_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "divisi";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Divisi", $this->div_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDivisi()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->div_name;
		$this->div_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->div_id		= $this->data['div_id'];   
         $this->div_name 	= $this->data['div_name'];   
	}

	function existDivisi($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where div_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDivisi($txt_id,$db) 
    {
       if (! $this->existDivisi($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDivisi($txt_id,$db) 
	{
       if ($this->existDivisi($txt_id,$db)) {
	       $sqlstr = "select div_id from karyawan where div_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "select div_id from departemen where div_id='".safeString($txt_id)."'";
			   $result = mysql_query($sqlstr,$db);
			   if (mysql_num_rows($result)==0) {
				   $sqlstr = "delete from $this->tablename where div_id='".safeString($txt_id)."'";
				   if (!$result = mysql_query($sqlstr,$db))  {
					   $this->error = mysql_error();    
					}
				  
				   if (! $result) { 
					  return False;
					} else { 
					  return True;
					}  
			   } else {
				  $this->error = "Divisi masih digunakan pada data departemen";
				  return False;
			   }						
		   } else {
		      $this->error = "Divisi masih digunakan pada data Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDivisi($db) 
	{   
	  $this->filterDivisi();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDivisi($this->div_id,$db)) {
  	         $sqlstr = "update $this->tablename set div_name='".safeString($this->div_name)."'
		        where div_id='".safeString($this->div_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(div_name) 
		        values ('".safeString($this->div_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->div_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>