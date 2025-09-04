<?
/*
  Write : Onix
  Last Modified : Nopember 14, 2008
*/

class Supplier
{

    var $spl_id,$spl_name,$spl_jenis,$spl_address,$spl_address2,$spl_address3,$spl_address4,$spl_email,$spl_website;
	var $spl_city,$spl_phone,$spl_phone2,$spl_phone3,$spl_phone4,$spl_fax,$spl_contact,$spl_ket;
	var $data,$error,$new;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "supplier";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama", $this->spl_name, "text", "y", 100, 3);
	   $example->add_text_field("Spesifikasi", $this->spl_jenis, "text", "y", 100, 3);
	   $example->add_text_field("Alamat", $this->spl_address, "text", "n", 100, 5);
	   $example->add_text_field("Alamat 2", $this->spl_address2, "text", "n", 100, 1);
	   $example->add_text_field("Alamat 3", $this->spl_address3, "text", "n", 100, 1);
	   $example->add_text_field("Alamat 4", $this->spl_address4, "text", "n", 100, 1);
	   $example->add_text_field("Kota", $this->spl_city, "text", "y", 40, 3);
	   $example->add_num_field("Telepon", $this->spl_phone, "number", "n", 20, 0, 6);
	   $example->add_num_field("Telepon 2", $this->spl_phone2, "number", "n", 20, 0, 1);
	   $example->add_num_field("Telepon 3", $this->spl_phone3, "number", "n", 20, 0, 1);
	   $example->add_num_field("Telepon 4", $this->spl_phone4, "number", "n", 20, 0, 1);
	   $example->add_num_field("Fax", $this->spl_fax, "number", "n", 0, 0, 6);
	   $example->add_text_field("Kontak Person", $this->spl_contact, "text", "n", 50, 3);
	   $example->add_text_field("Description", $this->spl_ket, "text", "n", 0, 0);
	   $example->add_link_field("Email", $this->spl_email, "email","n");
	   $example->add_link_field("Website", $this->spl_website, "url", "n");
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSupplier()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->spl_id;
		$this->spl_id		= $myFilter->process($before);
		$before 			= $this->spl_name;
		$this->spl_name		= $myFilter->process($before);
		$before 			= $this->spl_jenis;
		$this->spl_jenis	= $myFilter->process($before);
		$before 			= $this->spl_address;
		$this->spl_address	= $myFilter->process($before);
		$before 			= $this->spl_address2;
		$this->spl_address2	= $myFilter->process($before);
		$before 			= $this->spl_address3;
		$this->spl_address3	= $myFilter->process($before);
		$before 			= $this->spl_address4;
		$this->spl_address4	= $myFilter->process($before);
		$before 			= $this->spl_city;
		$this->spl_city		= $myFilter->process($before);
		$before 			= $this->spl_phone;
		$this->spl_phone	= $myFilter->process($before);
		$before 			= $this->spl_phone2;
		$this->spl_phone2	= $myFilter->process($before);
		$before 			= $this->spl_phone3;
		$this->spl_phone3	= $myFilter->process($before);
		$before 			= $this->spl_phone4;
		$this->spl_phone4	= $myFilter->process($before);
		$before 			= $this->spl_fax;
		$this->spl_fax		= $myFilter->process($before);
		$before 			= $this->spl_contact;
		$this->spl_contact	= $myFilter->process($before);
		$before 			= $this->spl_ket;
		$this->spl_ket		= $myFilter->process($before);
		$before 			= $this->spl_email;
		$this->spl_email	= $myFilter->process($before);
		$before 			= $this->spl_website;
		$this->spl_website	= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->spl_id	 		= $this->data['spl_id'];   
         $this->spl_name		= $this->data['spl_name'];   
         $this->spl_jenis		= $this->data['spl_jenis'];   
	     $this->spl_address		= $this->data['spl_address'];
	     $this->spl_address2	= $this->data['spl_address2'];
	     $this->spl_address3	= $this->data['spl_address3'];
	     $this->spl_address4	= $this->data['spl_address4'];
	     $this->spl_city		= $this->data['spl_city'];
	     $this->spl_phone 		= $this->data['spl_phone'];
	     $this->spl_phone2 		= $this->data['spl_phone2'];
	     $this->spl_phone3 		= $this->data['spl_phone3'];
	     $this->spl_phone4 		= $this->data['spl_phone4'];
	     $this->spl_fax			= $this->data['spl_fax'];	     
	     $this->spl_contact		= $this->data['spl_contact'];	     
	     $this->spl_ket			= $this->data['spl_ket'];	     
	     $this->spl_email		= $this->data['spl_email'];	     
	     $this->spl_website		= $this->data['spl_website'];	     
	}

	function existSupplier($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where spl_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getSupplier($txt_id,$db) 
    {
       if (! $this->existSupplier($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delSupplier($txt_id,$db) 
	{
       if ($this->existSupplier($txt_id,$db)) {
			$sqlstr = "select spl_id from master_beli where spl_id='".safeString($txt_id)."'";
			$result = mysql_query($sqlstr,$db);
			if (mysql_num_rows($result)==0) {
	    	   $sqlstr = "delete from $this->tablename where spl_id='".safeString($txt_id)."'";
	   		   if (!$result = mysql_query($sqlstr,$db))  {
		    	   $this->error = mysql_error();    
				}
							  
	   	       if (! $result) { 
    		      return False;
	    		} else { 
		    	  return True;
			    }  
			} else {
		       $this->error = "Data masih digunakan pada Procurement";
		       return False;
			}
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}


	function saveSupplier($db) 
	{   
	  $this->filterSupplier();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSupplier($this->spl_id,$db)) {
  	         $sqlstr = "update $this->tablename set spl_name='".safeString($this->spl_name)."',
			  spl_jenis='".safeString($this->spl_jenis)."',
			  spl_address='".safeString($this->spl_address)."',
			  spl_address2='".safeString($this->spl_address2)."',
			  spl_address3='".safeString($this->spl_address3)."',
			  spl_address4='".safeString($this->spl_address4)."',
			  spl_city='".safeString($this->spl_city)."',
			  spl_phone='".safeString($this->spl_phone)."',
			  spl_phone2='".safeString($this->spl_phone2)."',
			  spl_phone3='".safeString($this->spl_phone3)."',
			  spl_phone4='".safeString($this->spl_phone4)."',
			  spl_fax='".safeString($this->spl_fax)."',
			  spl_contact='".safeString($this->spl_contact)."',
			  spl_ket='".safeString($this->spl_ket)."',
			  spl_email='".safeString($this->spl_email)."',
			  spl_website='".safeString($this->spl_website)."'
		        where spl_id='".safeString($this->spl_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(spl_name,spl_jenis,spl_address,spl_address2,spl_address3,spl_address4,spl_city,spl_phone,spl_phone2,spl_phone3,spl_phone4,spl_fax,spl_contact,spl_ket,spl_email,spl_website) 
		        values ('".safeString($this->spl_name)."',
				'".safeString($this->spl_jenis)."',
				'".safeString($this->spl_address)."',
				'".safeString($this->spl_address2)."',
				'".safeString($this->spl_address3)."',
				'".safeString($this->spl_address4)."',
				'".safeString($this->spl_city)."',
				'".safeString($this->spl_phone)."',
				'".safeString($this->spl_phone2)."',
				'".safeString($this->spl_phone3)."',
				'".safeString($this->spl_phone4)."',
				'".safeString($this->spl_fax)."',
		        '".safeString($this->spl_contact)."',
		        '".safeString($this->spl_ket)."',
		        '".safeString($this->spl_email)."',
		        '".safeString($this->spl_website)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->spl_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 

}

?>