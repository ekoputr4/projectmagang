<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class Umr
{

    var $umr_id,$tgl_awal,$tgl_akhir,$value,$active;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "umr";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_date_field("Tanggal Awal", $this->tgl_awal, "date", "us", "y");
	   $example->add_date_field("Tanggal AKhir", $this->tgl_akhir, "date", "us", "y");
	   $example->add_num_field("UMR", $this->value, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       	   	
	   	   //if (!$this->cekExist($db)){
	       	   return True;
		   /*} else {
		   	   $this->error = "UMR pada tanggal tersebut telah ada dalam database";
	       	   return False;
		   }*/		
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekExist($db)
	{
		$sqlstr = " select * from $this->tablename 
			where active=0 value='".safeString($this->value)."' and tgl_akhir='".safeString($this->tgl_akhir)."'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0)
		   return True;
		else
		   return False;   		
	}

	function filterUmr()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->tgl_awal;
		$this->tgl_awal		= $myFilter->process($before);
		$before 			= $this->tgl_akhir;
		$this->tgl_akhir	= $myFilter->process($before);
		$before 			= $this->value;
		$this->value		= $myFilter->process($before);
	}


	function getData()
	{
         $this->tgl_awal	= $this->data['tgl_awal']; 
		 $this->value		= $this->data['value'];  
         $this->tgl_akhir	= $this->data['tgl_akhir'];   
	}

	function existUmr($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where umr_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getUmr($txt_id,$db) 
    {
       if (! $this->existUmr($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delUmr($txt_id,$db) 
	{

       if ($this->existUmr($txt_id,$db)) {
		   $this->value		= $this->data['value'];  	   
		   $sqlstr = "select umr from tb_gajikaryawan where umr='".safeString($this->value)."'";
		   $result2 = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result2)==0) {	
			   $sqlstr = "update $this->tablename set active=1 where umr_id=".safeString($txt_id);
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
					  
				if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
			  $this->error = "Umr digunakan pada data Penggajian";
			  return False;
		   }								
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function delOtherUmr($txt_id,$db) 
	{
       if ($this->existUmr($txt_id,$db)) {
		   $sqlstr = "update $this->tablename set active=1 where umr_id<>'".safeString($txt_id)."'";
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

	
	function saveUmr($db) 
	{   
	//   var $tgl_awal,$tgl_akhir,$value,$active;
	  $this->filterUmr();   
	  if ($this->cekVariabel($db))  {
          $sqlstr = "insert into $this->tablename(tgl_awal,tgl_akhir,value) 
	        values ('".safeString($this->tgl_awal)."',
	        '".safeString($this->tgl_akhir)."',
	        '".safeString($this->value)."')";
			
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  $this->umr_id	= mysql_insert_id(); 	
			  $this->delOtherUmr($this->umr_id,$db);
		      return True;
		    }  
       }
	} 
}

?>