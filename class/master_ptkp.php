<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MasterPTKP
{

    var $mt_id,$nkh_id,$pribadi,$istri,$anak,$nkh_name;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "master_ptkp";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Status Nikah", $this->nkh_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Nilai PTKP Pribadi", $this->pribadi, "number", "y", 0, 0, 1);
	   $example->add_num_field("Nilai PTKP Istri", $this->istri, "number", "n", 0, 0, 1);
	   $example->add_num_field("Nilai PTKP Anak", $this->anak, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterPTKP()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->nkh_id;
		$this->nkh_id		= $myFilter->process($before);
		$before 			= $this->pribadi;
		$this->pribadi		= $myFilter->process($before);
		$before 			= $this->istri;
		$this->istri		= $myFilter->process($before);
		$before 			= $this->anak;
		$this->anak			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->mt_id		= $this->data['mt_id'];   
         $this->nkh_id 		= $this->data['nkh_id'];   
         $this->pribadi		= $this->data['pribadi'];   
         $this->istri 		= $this->data['istri'];   
         $this->anak 		= $this->data['anak'];   
		 
		 require_once("status_nikah.php");
		 $statusnikah		= new StatusNikah;
		 $statusnikah->getStatusNikah($this->nkh_id,$db);
		 $this->nkh_name	= $statusnikah->nkh_name;
	}

	function existMasterPTKP($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where mt_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasterPTKP($txt_id,$db) 
    {
       if (! $this->existMasterPTKP($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delMasterPTKP($txt_id,$db) 
	{
       if ($this->existMasterPTKP($txt_id,$db)) {
/*	       $sqlstr = "select mt_id from karyawan where mt_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where mt_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "MasterPTKP masih digunakan pada Karyawan";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMasterPTKP($db) 
	{   
	  $this->filterMasterPTKP();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterPTKP($this->mt_id,$db)) {
  	         $sqlstr = "update $this->tablename set nkh_id='".safeString($this->nkh_id)."',
			 pribadi='".safeString($this->pribadi)."',
			 istri='".safeString($this->istri)."',
			 anak='".safeString($this->anak)."'
		        where mt_id='".safeString($this->mt_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(nkh_id,pribadi,istri,anak) 
		        values ('".safeString($this->nkh_id)."',
				'".safeString($this->pribadi)."',
				'".safeString($this->istri)."',
				'".safeString($this->anak)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->mt_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>