<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class KetCuti
{

    var $ket_id,$ket_name,$ket_kode,$ket_bayar,$ket_potong,$show_ol;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "ket_cuti";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Keterangan", $this->ket_name, "text", "y", 30, 2);
	   $example->add_text_field("Kode", $this->ket_kode, "text", "y", 3, 1);
	   $example->add_num_field("Di Bayar", $this->ket_bayar, "number", "n", 1, 0, 0);
	   $example->add_num_field("Potong Cuti Tahun", $this->ket_potong, "number", "n", 1, 0, 0);
	   $example->add_num_field("Akses Cuti Online", $this->show_ol, "number", "n", 1, 0, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterKetCuti()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->ket_name;
		$this->ket_name		= $myFilter->process($before);
		$before 			= $this->ket_kode;
		$this->ket_kode		= $myFilter->process($before);
		$before 			= $this->ket_bayar;
		$this->ket_bayar	= $myFilter->process($before);
		$before 			= $this->ket_potong;
		$this->ket_potong	= $myFilter->process($before);
		$before 			= $this->show_ol;
		$this->show_ol		= $myFilter->process($before);
	}


	function getData()
	{
         $this->ket_id		= $this->data['ket_id'];   
         $this->ket_name 	= $this->data['ket_name'];   
         $this->ket_kode 	= $this->data['ket_kode'];   
         $this->ket_bayar 	= $this->data['ket_bayar'];   
         $this->ket_potong	= $this->data['ket_potong'];   
         $this->show_ol		= $this->data['show_ol'];   
	}

	function existKetCuti($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where ket_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getKetCuti($txt_id,$db) 
    {
       if (! $this->existKetCuti($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delKetCuti($txt_id,$db) 
	{
       if ($this->existKetCuti($txt_id,$db)) {
	       $sqlstr = "select ket_id from cuti_karyawan where ket_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where ket_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Jenis Cuti masih digunakan pada Cuti Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveKetCuti($db) 
	{   
	  $this->filterKetCuti();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existKetCuti($this->ket_id,$db)) {
  	         $sqlstr = "update $this->tablename set ket_name='".safeString($this->ket_name)."',
			 ket_kode='".safeString($this->ket_kode)."',
			 ket_bayar='".safeString($this->ket_bayar)."',
			 ket_potong='".safeString($this->ket_potong)."',
			 show_ol='".safeString($this->show_ol)."'
		        where ket_id='".safeString($this->ket_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(ket_name,ket_kode,ket_bayar,ket_potong,show_ol) 
		        values ('".safeString($this->ket_name)."',
		        '".safeString($this->ket_kode)."',
		        '".safeString($this->ket_bayar)."',
		        '".safeString($this->ket_potong)."',
		        '".safeString($this->show_ol)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->ket_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>