<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MasterPelatihan
{

    var $pel_id,$pel_name,$patner_id,$pel_date,$pel_date2,$patner_name;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "master_pelatihan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Pelatihan", $this->pel_name, "text", "y", 100, 2);
	   $example->add_num_field("Trainer", $this->patner_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Awal", $this->pel_date, "date", "us", "y");
	   $example->add_date_field("Tanggal Akhir", $this->pel_date2, "date", "us", "y");
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterPelatihan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->pel_name;
		$this->pel_name		= $myFilter->process($before);
		$before 			= $this->patner_id;
		$this->patner_id	= $myFilter->process($before);
		$before 			= $this->pel_date;
		$this->pel_date		= $myFilter->process($before);
		$before 			= $this->pel_date2;
		$this->pel_date2	= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->pel_id		= $this->data['pel_id'];   
         $this->pel_name 	= $this->data['pel_name'];   
         $this->patner_id 	= $this->data['patner_id'];   
         $this->pel_date 	= $this->data['pel_date'];   
         $this->pel_date2 	= $this->data['pel_date2'];   
		 require_once("patnerpelatihan.php");
		 $patnerpelatihan = new Patnerpelatihan;
		 $patnerpelatihan->getPatnerpelatihan($this->patner_id,$db);
		 $this->patner_name	=	$patnerpelatihan->patner_name;
	}

	function existMasterPelatihan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where pel_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasterPelatihan($txt_id,$db) 
    {
       if (! $this->existMasterPelatihan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delMasterPelatihan($txt_id,$db) 
	{
       if ($this->existMasterPelatihan($txt_id,$db)) {
	       $sqlstr = "select pel_id from karyawan where pel_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where pel_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "MasterPelatihan masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMasterPelatihan($db) 
	{   
	  $this->filterMasterPelatihan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterPelatihan($this->pel_id,$db)) {
  	         $sqlstr = "update $this->tablename set pel_name='".safeString($this->pel_name)."',
			 patner_id='".safeString($this->patner_id)."',
			 pel_date='".safeString($this->pel_date)."',
			 pel_date2='".safeString($this->pel_date2)."'
		        where pel_id='".safeString($this->pel_id)."'";
	       } else {
		   	  $this->new	= 1;
  	          $sqlstr = "insert into $this->tablename(pel_name,patner_id,pel_date,pel_date2) 
		        values ('".safeString($this->pel_name)."',
				'".safeString($this->patner_id)."',
				'".safeString($this->pel_date)."',
				'".safeString($this->pel_date2)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->pel_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>