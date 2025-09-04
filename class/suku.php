<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Suku
{

    var $sk_id,$sk_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "suku";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Suku", $this->sk_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSuku()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->sk_name;
		$this->sk_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->sk_id		= $this->data['sk_id'];   
         $this->sk_name 	= $this->data['sk_name'];   
	}

	function existSuku($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where sk_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSuku($txt_id,$db) 
    {
       if (! $this->existSuku($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delSuku($txt_id,$db) 
	{
       if ($this->existSuku($txt_id,$db)) {
	       $sqlstr = "select sk_id from karyawan where sk_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where sk_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Suku masih digunakan pada data karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveSuku($db) 
	{   
	  $this->filterSuku();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSuku($this->sk_id,$db)) {
  	         $sqlstr = "update $this->tablename set sk_name='".safeString($this->sk_name)."'
		        where sk_id='".safeString($this->sk_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(sk_name) 
		        values ('".safeString($this->sk_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->sk_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>