<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Agama
{

    var $agm_id,$agm_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "agama";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Agama", $this->agm_name, "text", "y", 30, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterAgama()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->agm_name;
		$this->agm_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->agm_id		= $this->data['agm_id'];   
         $this->agm_name 	= $this->data['agm_name'];   
	}

	function existAgama($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where agm_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getAgama($txt_id,$db) 
    {
       if (! $this->existAgama($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delAgama($txt_id,$db) 
	{
       if ($this->existAgama($txt_id,$db)) {
	       $sqlstr = "select agm_id from karyawan where agm_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where agm_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Agama masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveAgama($db) 
	{   
	  $this->filterAgama();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existAgama($this->agm_id,$db)) {
  	         $sqlstr = "update $this->tablename set agm_name='".safeString($this->agm_name)."'
		        where agm_id='".safeString($this->agm_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(agm_name) 
		        values ('".safeString($this->agm_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->agm_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>