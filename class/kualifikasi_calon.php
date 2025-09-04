<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class KualifikasiCalon
{

    var $kl_id,$kl_name,$kl_parent,$kl_sub;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "calonkaryawan_kualifikasi";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kualifikasi", $this->kl_name, "text", "y", 50, 2);
	   $example->add_num_field("Parent", $this->kl_parent, "number", "n", 0, 0, 1);
	   $example->add_num_field("Sub", $this->kl_sub, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKualifikasiCalon()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->kl_name;
		$this->kl_name		= $myFilter->process($before);
		$before 			= $this->kl_parent;
		$this->kl_parent	= $myFilter->process($before);
		$before 			= $this->kl_sub;
		$this->kl_sub		= $myFilter->process($before);
	}


	function getData()
	{
         $this->kl_id		= $this->data['kl_id'];   
         $this->kl_name 	= $this->data['kl_name'];   
         $this->kl_parent	= $this->data['kl_parent'];   
         $this->kl_sub	 	= $this->data['kl_sub'];   
	}

	function existKualifikasiCalon($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where kl_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKualifikasiCalon($txt_id,$db) 
    {
       if (! $this->existKualifikasiCalon($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKualifikasiCalon($txt_id,$db) 
	{
       if ($this->existKualifikasiCalon($txt_id,$db)) {
/*	       $sqlstr = "select kl_id from karyawan where kl_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where kl_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "KualifikasiCalon masih digunakan pada Karyawan";
			  return False;
		   }			*/			
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveKualifikasiCalon($db) 
	{   
	  $this->filterKualifikasiCalon();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKualifikasiCalon($this->kl_id,$db)) {
  	         $sqlstr = "update $this->tablename set kl_name='".safeString($this->kl_name)."',
			 kl_parent='".safeString($this->kl_parent)."',
			 kl_sub='".safeString($this->kl_sub)."'
		        where kl_id='".safeString($this->kl_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kl_name,kl_parent,kl_sub) 
		        values ('".safeString($this->kl_name)."',
				'".safeString($this->kl_parent)."',
				'".safeString($this->kl_sub)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->kl_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>