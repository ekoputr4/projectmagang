<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class PengalamanKaryawan
{

    var $peng_id,$kry_id,$peng_name,$peng_jab,$peng_from,$peng_end,$peng_reason,$peng_salary;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "pengalaman_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Perusahaan", $this->peng_name, "text", "y", 50, 1);
	   $example->add_text_field("Jabatan", $this->peng_jab, "text", "y", 30, 1);
	   $example->add_text_field("Dari", $this->peng_from, "text", "y", 20, 1);
	   $example->add_text_field("Sampai", $this->peng_end, "text", "y", 20, 1);
	   $example->add_text_field("Alasan Keluar", $this->peng_reason, "text", "y", 50, 1);
	   $example->add_num_field("Gaji", $this->peng_salary, "number", "y", 20, 0, 5);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterPengalamanKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->peng_id;
		$this->peng_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->peng_name;
		$this->peng_name		= $myFilter->process($before);
		$before 				= $this->peng_jab;
		$this->peng_jab			= $myFilter->process($before);
		$before 				= $this->peng_from;
		$this->peng_from		= $myFilter->process($before);
		$before 				= $this->peng_end;
		$this->peng_end			= $myFilter->process($before);
		$before 				= $this->peng_reason;
		$this->peng_reason		= $myFilter->process($before);
		$before 				= $this->peng_salary;
		$this->peng_salary		= $myFilter->process($before);
	}


	function getData()
	{
         $this->peng_id			= $this->data['peng_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->peng_name		= $this->data['peng_name'];   
         $this->peng_jab		= $this->data['peng_jab'];   
         $this->peng_from		= $this->data['peng_from'];   
         $this->peng_end		= $this->data['peng_end'];   
         $this->peng_reason		= $this->data['peng_reason'];   
         $this->peng_salary		= $this->data['peng_salary'];   
	}

	function existPengalamanKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where peng_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getPengalamanKaryawan($txt_id,$db) 
    {
       if (! $this->existPengalamanKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delPengalamanKaryawan($txt_id,$db) 
	{
       if ($this->existPengalamanKaryawan($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where peng_id='".safeString($txt_id)."'";
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

	
	function savePengalamanKaryawan($db) 
	{   
	  $this->filterPengalamanKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existPengalamanKaryawan($this->peng_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 peng_name='".safeString($this->peng_name)."',
			 peng_jab='".safeString($this->peng_jab)."',
			 peng_from='".safeString($this->peng_from)."',
			 peng_end='".safeString($this->peng_end)."',
			 peng_reason='".safeString($this->peng_reason)."',
			 peng_salary='".safeString($this->peng_salary)."'
		        where peng_id='".safeString($this->peng_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(kry_id,peng_name,peng_jab,peng_from,peng_end,peng_reason,peng_salary) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->peng_name)."',
				'".safeString($this->peng_jab)."',
				'".safeString($this->peng_from)."',
				'".safeString($this->peng_end)."',
				'".safeString($this->peng_reason)."',
				'".safeString($this->peng_salary)."')";
		    }
			//break;
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->peng_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>