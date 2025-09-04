<?
/*
  Write : Onix
  Last Modified : Nopember 28, 2008
*/

class MasterAmbil
{

    var $id_ambil,$tgl_ambil,$group_id,$user_ambil,$keterangan,$no_urut;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "master_ambil";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	   //$this->filterMasterAmbil();   
	   
  	   $example = new Validate_fields;
	   $example->add_date_field("Tanggal Ambil", $this->tgl_ambil, "date", "us", "y");
	   $example->add_num_field("Group ID", $this->group_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("User Ambil", $this->user_ambil, "text", "y", 50, 3);
	   $example->add_text_field("Keterangan", $this->keterangan, "text", "n", 0, 0);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterAmbil()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 1, 1); // more info on constructor in readme

		$before 			= $this->id_ambil;
		$this->id_ambil		= $myFilter->process($before);
		$before 			= $this->tgl_ambil;
		$this->tgl_ambil  	= $myFilter->process($before);
		$before 			= $this->group_id;
		$this->group_id		= $myFilter->process($before);
		$before 			= $this->user_ambil;
		$this->user_ambil	= $myFilter->process($before);
		$before 			= $this->keterangan;
		$this->keterangan	= $myFilter->process($before);
	}

	function getData($db)
	{
         $this->id_ambil 		= $this->data['id_ambil'];   
	     $this->tgl_ambil		= $this->data['tgl_ambil'];
	     $this->group_id			= $this->data['group_id'];	     
	     $this->user_ambil		= $this->data['user_ambil'];
	     $this->keterangan		= $this->data['keterangan'];	     
	     $this->no_urut			= $this->data['no_urut'];	     
	}

	function existMasterAmbil($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where id_ambil='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getMasterAmbil($txt_id,$db) 
    {
       if (! $this->existMasterAmbil($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delMasterAmbil($txt_id,$db) 
	{
       if ($this->existMasterAmbil($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where id_ambil='".safeString($txt_id)."'";
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

	function saveMasterAmbil($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterAmbil($this->id_trm,$db)) {
  	         $sqlstr = "update $this->tablename set id_ambil='".safeString($this->id_ambil)."',
			  tgl_ambil='".safeString($this->tgl_ambil)."',
			  group_id='".safeString($this->group_id)."',
			  user_ambil='".safeString($this->user_ambil)."',
			  keterangan='".safeString($this->keterangan)."'
		        where id_ambil='".safeString($this->id_ambil)."'";
	       } else {		   	  
		   
			  $sqlstr = "select group_id from $this->tablename where group_id=".safeString($this->group_id).
			  " and month(tgl_ambil)=".date("m")." and year(tgl_ambil)=".date("Y");
			  $result = mysql_query($sqlstr);
			  if (mysql_num_rows($result)>0)
		   		 $this->no_urut	= mysql_num_rows($result)+1;		   			  
			  else
		   		 $this->no_urut	= 1;	
			  mysql_free_result($result);	 	   

  	          $sqlstr = "insert into $this->tablename(tgl_ambil,group_id,user_ambil,keterangan,no_urut) 
		        values ('".safeString($this->tgl_ambil)."',
				'".safeString($this->group_id)."',
				'".safeString($this->user_ambil)."',
		        '".safeString($this->keterangan)."',
		        '".safeString($this->no_urut)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->id_ambil = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 


}

?>