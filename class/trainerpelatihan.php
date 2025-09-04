<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Trainerpelatihan
{

    var $trainer_id,$patner_id,$trainer_name,$trainer_bidang,$harga;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "patner_trainer";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama Trainer", $this->trainer_name, "text", "y", 100, 2);
	   $example->add_text_field("Bidang Training", $this->trainer_bidang, "text", "y", 1000, 2);
	   $example->add_text_field("Biaya", $this->harga, "number", "y", 50, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterTrainerpelatihan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->trainer_name;
		$this->trainer_name		= $myFilter->process($before);
		$before 				= $this->trainer_bidang;
		$this->trainer_bidang	= $myFilter->process($before);
		$before					= $this->harga;
		$this->harga			= $myFilter->process($before);
	}


	function getData()
	{
         $this->trainer_id		= $this->data['trainer_id']; 
		 $this->patner_id		= $this->data['patner_id'];  
         $this->trainer_name 	= $this->data['trainer_name']; 
		 $this->trainer_bidang	= $this->data['trainer_bidang'];  
		 $this->harga			= $this->data['harga'];
	}

	function existTrainerpelatihan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where trainer_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getTrainerpelatihan($txt_id,$db) 
    {
       if (! $this->existTrainerpelatihan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delTrainerpelatihan($txt_id,$db) 
	{
       if ($this->existTrainerpelatihan($txt_id,$db)) {
	     /*  $sqlstr = "select trainer_id from trainerpelatihan where trainer_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where trainer_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		/*   } else {
		      $this->error = "trainerpelatihan masih digunakan";
			  return False;
		   }				*/		
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveTrainerpelatihan($db) 
	{   
	  $this->filterTrainerpelatihan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existTrainerpelatihan($this->trainer_id,$db)) {
  	         $sqlstr = "update $this->tablename set trainer_name='".$this->trainer_name."',trainer_bidang='".safeString($this->trainer_bidang)."'
			 ,harga='".safeString($this->harga)."'
		      where trainer_id='".safeString($this->trainer_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(patner_id,trainer_name,trainer_bidang,harga) 
		        values ('".safeString($this->patner_id)."','".safeString($this->trainer_name)."',
						'".safeString($this->trainer_bidang)."','".safeString($this->harga)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->trainer_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>