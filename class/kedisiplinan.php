<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Kedisiplinan
{

    var $dis_id,$dis_name,$dis_level;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "master_kedisiplinan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Tindakan", $this->dis_name, "text", "y", 30, 2);
	   $example->add_num_field("Level", $this->dis_level, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKedisiplinan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->dis_name;
		$this->dis_name		= $myFilter->process($before);
		$before 			= $this->dis_level;
		$this->dis_level	= $myFilter->process($before);
	}

	function getData()
	{
         $this->dis_id		= $this->data['dis_id'];   
         $this->dis_name 	= $this->data['dis_name'];   
         $this->dis_level 	= $this->data['dis_level'];   
	}

	function existKedisiplinan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where dis_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKedisiplinan($txt_id,$db) 
    {
       if (! $this->existKedisiplinan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKedisiplinan($txt_id,$db) 
	{
       if ($this->existKedisiplinan($txt_id,$db)) {
	       $sqlstr = "select dis_id from tindakan_karyawan where dis_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where dis_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Kedisiplinan masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveKedisiplinan($db) 
	{   
	  $this->filterKedisiplinan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKedisiplinan($this->dis_id,$db)) {
  	         $sqlstr = "update $this->tablename set dis_name='".safeString($this->dis_name)."',
			 dis_level='".safeString($this->dis_level)."'
		        where dis_id='".safeString($this->dis_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(dis_name,dis_level) 
		        values ('".safeString($this->dis_name)."',
				'".safeString($this->dis_level)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->dis_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>