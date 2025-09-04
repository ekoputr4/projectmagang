<?
/*
  Write : Onix
  Last Modified : Nopember 23, 2008
*/

class MasterGudang
{

    var $id_trm,$id_beli,$no_urut,$tgl_trm,$user_gdg,$user_check,$jns_sj,$sj,$status,$kendaraan,$nopol;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "master_gudang";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	   $this->filterMasterGudang();   
	   
  	   $example = new Validate_fields;
	   $example->add_num_field("OP Number", $this->id_beli, "number", "y", 0, 0, 1);
	   $example->add_date_field("Date Recieve", $this->tgl_trm, "date", "us", "y");
	   $example->add_num_field("User Recieve", $this->user_gdg, "number", "y", 0, 0, 1);
	   $example->add_text_field("User Check", $this->user_check, "text", "n", 0, 0);
	   $example->add_num_field("Jenis SJ", $this->jns_sj, "number", "y", 0, 0, 1);
	   $example->add_text_field("SJ/Invoice", $this->sj, "text", "y", 25, 3);
	   $example->add_text_field("Status", $this->status, "text", "y", 1, 1);
	   $example->add_text_field("Kendaraan", $this->kendaraan, "text", "n", 0, 0);
	   $example->add_text_field("Nopol", $this->nopol, "text", "n", 0, 0);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterGudang()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 1, 1); // more info on constructor in readme

		$before 			= $this->id_trm;
		$this->id_trm		= $myFilter->process($before);
		$before 			= $this->id_beli;
		$this->id_beli		= $myFilter->process($before);
		$before 			= $this->no_urut;
		$this->no_urut		= $myFilter->process($before);
		$before 			= $this->tgl_trm;
		$this->tgl_trm  	= $myFilter->process($before);
		$before 			= $this->user_gdg;
		$this->user_gdg		= $myFilter->process($before);
		$before 			= $this->user_check;
		$this->user_check	= $myFilter->process($before);
		$before 			= $this->jns_sj;
		$this->jns_sj		= $myFilter->process($before);
		$before 			= $this->sj;
		$this->sj			= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
		$before 			= $this->kendaraan;
		$this->kendaraan	= $myFilter->process($before);
		$before 			= $this->nopol;
		$this->nopol		= $myFilter->process($before);
	}

	function getData($db)
	{
         $this->id_trm	 		= $this->data['id_trm'];   
         $this->id_beli			= $this->data['id_beli'];   
         $this->no_urut			= $this->data['no_urut'];   
	     $this->tgl_trm			= $this->data['tgl_trm'];
	     $this->user_gdg		= $this->data['user_gdg'];
	     $this->user_check		= $this->data['user_check'];
	     $this->jns_sj			= $this->data['jns_sj'];	     
	     $this->sj				= $this->data['sj'];	     
	     $this->status			= $this->data['status'];	     
	     $this->kendaraan		= $this->data['kendaraan'];	     
	     $this->nopol			= $this->data['nopol'];	     
	}

	function existMasterGudang($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where id_trm='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getMasterGudang($txt_id,$db) 
    {
       if (! $this->existMasterGudang($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delMasterGudang($txt_id,$db) 
	{
       if ($this->existMasterGudang($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where id_trm='".safeString($txt_id)."'";
   		   if (!$result = mysql_query($sqlstr,$db))  {
	    	   $this->error = mysql_error();    
			}
							  
   	       if (! $result) { 
    	      return False;
	    	} else { 
		      return True;
		    }  
	   } else {
	       $this->error = "Data is not exist";
	       return False;
	   }
	}

	function updateStatus($db)
	{
	  if ($this->existMasterGudang($this->id_trm,$db)) {
	  	 $this->status = $this->status + 1;
         $sqlstr = "update $this->tablename set status='".safeString($this->status)."'
	        where id_trm='".safeString($this->id_trm)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }

           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
	  }
	}

	function saveMasterGudang($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterGudang($this->id_trm,$db)) {
  	         $sqlstr = "update $this->tablename set id_beli='".safeString($this->id_beli)."',
			  tgl_trm='".safeString($this->tgl_trm)."',
			  user_gdg='".safeString($this->user_gdg)."',
			  user_check='".safeString($this->user_check)."',
			  jns_sj='".safeString($this->jns_sj)."',
			  sj='".safeString($this->sj)."',
			  status='".safeString($this->status)."',
			  kendaraan='".safeString($this->kendaraan)."',
			  nopol='".safeString($this->nopol)."'
		        where id_trm='".safeString($this->id_trm)."'";
	       } else {
		   	  
			  $sqlstr = "select id_beli from $this->tablename where id_beli=".safeString($this->id_beli);
			  $result = mysql_query($sqlstr);
			  if (mysql_num_rows($result)>0)
		   		 $this->no_urut	= mysql_num_rows($result)+1;		   			  
			  else
		   		 $this->no_urut	= 1;	
			  mysql_free_result($result);	 	   
		   
  	          $sqlstr = "insert into $this->tablename(id_beli,no_urut,tgl_trm,user_gdg,user_check,jns_sj,sj,status,kendaraan,nopol) 
		        values ('".safeString($this->id_beli)."',
				'".safeString($this->no_urut)."',
				'".safeString($this->tgl_trm)."',
				'".safeString($this->user_gdg)."',
				'".safeString($this->user_check)."',
				'".safeString($this->jns_sj)."',
				'".safeString($this->sj)."',
		        '".safeString($this->status)."',
		        '".safeString($this->kendaraan)."',
		        '".safeString($this->nopol)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->id_trm = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 


}

?>