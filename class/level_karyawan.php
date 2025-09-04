<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class LevelKaryawan
{

    var $lvl_id,$lvl_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "level_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("LevelKaryawan", $this->lvl_name, "text", "y", 20, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterLevelKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->lvl_name;
		$this->lvl_name		= $myFilter->process($before);
	}


	function getData()
	{
         $this->lvl_id		= $this->data['lvl_id'];   
         $this->lvl_name 	= $this->data['lvl_name'];   
	}

	function existLevelKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where lvl_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getLevelKaryawan($txt_id,$db) 
    {
       if (! $this->existLevelKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delLevelKaryawan($txt_id,$db) 
	{
       if ($this->existLevelKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where lvl_id='".safeString($txt_id)."'";
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

	
	function saveLevelKaryawan($db) 
	{   
	  $this->filterLevelKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existLevelKaryawan($this->lvl_id,$db)) {
  	         $sqlstr = "update $this->tablename set lvl_name='".safeString($this->lvl_name)."'
		        where lvl_id='".safeString($this->lvl_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(lvl_name) 
		        values ('".safeString($this->lvl_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->lvl_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>