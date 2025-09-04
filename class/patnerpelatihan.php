<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Patnerpelatihan
{

    var $patner_id,$patner_name,$patner_alm,$patner_kota,$patner_phone,$patner_kontak,$patner_email;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "patner_pelatihan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Patner Pelatihan", $this->patner_name, "text", "y", 150, 2);
	   $example->add_text_field("Alamat", $this->patner_alm, "text", "y", 200, 2);
	   $example->add_text_field("Kota", $this->patner_kota, "text", "y", 50, 2);
	   $example->add_text_field("Telpon", $this->patner_phone, "text", "y", 50, 2);
	   $example->add_text_field("Kontak Person", $this->patner_kontak, "text", "y", 50, 2);
	   $example->add_text_field("Email", $this->patner_email, "text", "n", 50, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPatnerpelatihan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->patner_name;
		$this->patner_name		= $myFilter->process($before);
		$before 				= $this->patner_alm;
		$this->patner_alm		= $myFilter->process($before);
		$before					= $this->patner_kota;
		$this->patner_kota		= $myFilter->process($before);
		$before 				= $this->patner_phone;
		$this->patner_phone		= $myFilter->process($before);
		$before 				= $this->patner_kontak;
		$this->patner_kontak	= $myFilter->process($before);
		$before 				= $this->patner_email;
		$this->patner_email		= $myFilter->process($before);
	}


	function getData()
	{
         $this->patner_id		= $this->data['patner_id']; 
		 $this->patner_name		= $this->data['patner_name'];  
         $this->patner_alm	 	= $this->data['patner_alm']; 
		 $this->patner_kota	 	= $this->data['patner_kota'];  
		 $this->patner_phone	= $this->data['patner_phone'];
		 $this->patner_kontak	= $this->data['patner_kontak'];
		 $this->patner_email	= $this->data['patner_email'];
	}

	function existPatnerpelatihan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where patner_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPatnerpelatihan($txt_id,$db) 
    {
       if (! $this->existPatnerpelatihan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delPatnerpelatihan($txt_id,$db) 
	{
       if ($this->existPatnerpelatihan($txt_id,$db)) {
	      $sqlstr = "select patner_id from patner_trainer where patner_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where patner_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		  } else {
		      $this->error = "Patner Pelatihan masih digunakan di Data Training";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function savePatnerpelatihan($db) 
	{   
	  $this->filterPatnerpelatihan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPatnerpelatihan($this->patner_id,$db)) {
  	         $sqlstr = "update $this->tablename set patner_name='".$this->patner_name."',patner_alm='".safeString($this->patner_alm)."'
			 ,patner_kota='".safeString($this->patner_kota)."',patner_phone='".safeString($this->patner_phone)."'
			 ,patner_kontak='".safeString($this->patner_kontak)."',patner_email='".safeString($this->patner_email)."'
		      where patner_id='".safeString($this->patner_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(patner_name,patner_alm,patner_kota,patner_phone,patner_kontak,patner_email) 
		        values ('".safeString($this->patner_name)."','".safeString($this->patner_alm)."','".safeString($this->patner_kota)."','".safeString($this->patner_phone)."'
						,'".safeString($this->patner_kontak)."','".safeString($this->patner_email)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->patner_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>