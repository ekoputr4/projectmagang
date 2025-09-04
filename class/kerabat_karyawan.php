<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class KerabatKaryawan
{

    var $krb_id,$kry_id,$krb_hub,$krb_name,$krb_kerja,$krb_alamat,$krb_telepon;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "kerabat_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Hubungan", $this->krb_hub, "text", "y", 30, 1);
	   $example->add_text_field("Nama Kerabat", $this->krb_name, "text", "y", 30, 1);
	   $example->add_text_field("Pekerjaan", $this->krb_kerja, "text", "n", 50, 0);
	   $example->add_text_field("Alamat", $this->krb_alamat, "text", "n", 50, 0);
	   $example->add_num_field("Telepon", $this->krb_telepon, "number", "n", 20, 0, 6);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKerabatKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->krb_id;
		$this->krb_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->krb_hub;
		$this->krb_hub			= $myFilter->process($before);
		$before 				= $this->krb_name;
		$this->krb_name			= $myFilter->process($before);
		$before 				= $this->krb_kerja;
		$this->krb_kerja		= $myFilter->process($before);
		$before 				= $this->krb_alamat;
		$this->krb_alamat		= $myFilter->process($before);
		$before 				= $this->krb_telepon;
		$this->krb_telepon		= $myFilter->process($before);
	}


	function getData()
	{
         $this->krb_id			= $this->data['krb_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->krb_hub			= $this->data['krb_hub'];   
         $this->krb_name		= $this->data['krb_name'];   
         $this->krb_kerja		= $this->data['krb_kerja'];   
         $this->krb_alamat		= $this->data['krb_alamat'];   
         $this->krb_telepon		= $this->data['krb_telepon'];   
	}

	function existKerabatKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where krb_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKerabatKaryawan($txt_id,$db) 
    {
       if (! $this->existKerabatKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKerabatKaryawan($txt_id,$db) 
	{
       if ($this->existKerabatKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where krb_id='".safeString($txt_id)."'";
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

	
	function saveKerabatKaryawan($db) 
	{   
	  $this->filterKerabatKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKerabatKaryawan($this->krb_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 krb_hub='".safeString($this->krb_hub)."',
			 krb_name='".safeString($this->krb_name)."',
			 krb_kerja='".safeString($this->krb_kerja)."',
			 krb_alamat='".safeString($this->krb_alamat)."',
			 krb_telepon='".safeString($this->krb_telepon)."'
		        where krb_id='".safeString($this->krb_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,krb_hub,krb_name,krb_kerja,krb_alamat,krb_telepon) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->krb_hub)."',
				'".safeString($this->krb_name)."',
				'".safeString($this->krb_kerja)."',
				'".safeString($this->krb_alamat)."',
				'".safeString($this->krb_telepon)."')";
		    }
			echo $sqlstr;
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->krb_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>