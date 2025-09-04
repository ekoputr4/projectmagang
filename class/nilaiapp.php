<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class NilaiApp
{

    var $nil_id,$old_nil_id,$nil_value,$nil_name,$nil_ket;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "nilaiapp";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Kode NIlai", $this->nil_id, "text", "y", 2, 1);
	   $example->add_num_field("Bobot Nilai", $this->nil_value, "number", "y", 2, 0, 1);
	   $example->add_text_field("Nama", $this->nil_name, "text", "y", 30, 1);
	   $example->add_text_field("Keterangan", $this->nil_ket, "text", "y", 50, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterNilaiApp()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->old_nil_id;
		$this->old_nil_id		= $myFilter->process($before);
		$before 				= $this->nil_id;
		$this->nil_id			= $myFilter->process($before);
		$before 				= $this->nil_value;
		$this->nil_value		= $myFilter->process($before);
		$before 				= $this->nil_name;
		$this->nil_name			= $myFilter->process($before);
		$before 				= $this->nil_ket;
		$this->nil_ket			= $myFilter->process($before);
	}


	function getData()
	{
         $this->old_nil_id		= $this->data['nil_id'];   
         $this->nil_id			= $this->data['nil_id'];   
         $this->nil_value 		= $this->data['nil_value'];   
         $this->nil_name 		= $this->data['nil_name'];   
         $this->nil_ket 		= $this->data['nil_ket'];   
	}

	function existNilaiApp($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where nil_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getNilaiApp($txt_id,$db) 
    {
       if (! $this->existNilaiApp($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delNilaiApp($txt_id,$db) 
	{
       if ($this->existNilaiApp($txt_id,$db)) {
/*	       $sqlstr = "select nil_id from karyawan where nil_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where nil_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "Nilai Appraisal masih digunakan pada Jenis";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveNilaiApp($db) 
	{   
	  $this->filterNilaiApp();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existNilaiApp($this->old_nil_id,$db)) {
  	         $sqlstr = "update $this->tablename set nil_id='".safeString($this->nil_id)."',
			 nil_value='".safeString($this->nil_value)."',
			 nil_name='".safeString($this->nil_name)."',
			 nil_ket='".safeString($this->nil_ket)."'
		        where nil_id='".safeString($this->old_nil_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(nil_id,nil_value,nil_name,nil_ket) 
		        values ('".safeString($this->nil_id)."',
				'".safeString($this->nil_value)."',
				'".safeString($this->nil_name)."',
				'".safeString($this->nil_ket)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
       }
	} 
}

?>