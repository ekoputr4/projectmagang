<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Keanggotaan
{

    var $ang_id,$ang_name,$ang_potong;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "keanggotaan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Keanggotaan", $this->ang_name, "text", "y", 30, 2);
	   $example->add_num_field("Potong Gaji", $this->ang_potong, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKeanggotaan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->ang_name;
		$this->ang_name		= $myFilter->process($before);
		$before 			= $this->ang_potong;
		$this->ang_potong	= $myFilter->process($before);
	}


	function getData()
	{
         $this->ang_id		= $this->data['ang_id'];   
         $this->ang_name 	= $this->data['ang_name'];   
         $this->ang_potong	= $this->data['ang_potong'];   
	}

	function existKeanggotaan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where ang_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKeanggotaan($txt_id,$db) 
    {
       if (! $this->existKeanggotaan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKeanggotaan($txt_id,$db) 
	{
       if ($this->existKeanggotaan($txt_id,$db)) {
	       $sqlstr = "select ang_id from subkeanggotaan where ang_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where ang_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Keanggotaan masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveKeanggotaan($db) 
	{   
	  $this->filterKeanggotaan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKeanggotaan($this->ang_id,$db)) {
  	         $sqlstr = "update $this->tablename set ang_name='".safeString($this->ang_name)."',
			 ang_potong='".safeString($this->ang_potong)."'
		        where ang_id='".safeString($this->ang_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(ang_name,ang_potong) 
		        values ('".safeString($this->ang_name)."',
				'".safeString($this->ang_potong)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)	
	 			  $this->ang_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>