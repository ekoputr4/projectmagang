<?
/*
  Write : Onix
  Last Modified : Nopember 14, 2008
*/

class MasterBeli
{

    var $id_beli,$op_id,$no_urut,$tgl_beli,$user_beli,$spl_id,$syarat,$syarat2,$status;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "master_beli";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	   $this->filterMasterBeli();   
	   
  	   $example = new Validate_fields;
	   $example->add_num_field("OP Number", $this->op_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("OP Date", $this->tgl_beli, "date", "us", "y");
	   $example->add_num_field("User Purchase", $this->user_beli, "number", "y", 0, 0, 1);
	   $example->add_num_field("Supplier ID", $this->spl_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Syarat Pembayaran", $this->syarat, "text", "n", 0, 1);
	   $example->add_text_field("Syarat Penyerahan", $this->syarat2, "text", "n", 0, 1);
	   $example->add_num_field("Status", $this->status, "number", "y", 0, 0, 1);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterBeli()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 1, 1); // more info on constructor in readme
		$before 			= $this->id_beli;
		$this->id_beli		= $myFilter->process($before);
		$before 			= $this->op_id;
		$this->op_id		= $myFilter->process($before);
		$before 			= $this->no_urut;
		$this->no_urut		= $myFilter->process($before);
		$before 			= $this->tgl_beli;
		$this->tgl_beli  	= $myFilter->process($before);
		$before 			= $this->user_beli;
		$this->user_beli	= $myFilter->process($before);
		$before 			= $this->spl_id;
		$this->spl_id		= $myFilter->process($before);
		$before 			= $this->syarat;
		$this->syarat		= $myFilter->process($before);
		$before 			= $this->syarat2;
		$this->syarat2		= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
	}

	function getData($db)
	{
         $this->id_beli	 		= $this->data['id_beli'];   
         $this->op_id			= $this->data['op_id'];   
         $this->no_urut			= $this->data['no_urut'];   
	     $this->tgl_beli		= $this->data['tgl_beli'];
	     $this->user_beli		= $this->data['user_beli'];
	     $this->spl_id			= $this->data['spl_id'];
	     $this->syarat			= $this->data['syarat'];	     
	     $this->syarat2			= $this->data['syarat2'];	     
	     $this->status			= $this->data['status'];	     
	}

	function existMasterBeli($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where id_beli='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getMasterBeli($txt_id,$db) 
    {
       if (! $this->existMasterBeli($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delMasterBeli($txt_id,$db) 
	{
       if ($this->existMasterBeli($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where id_beli='".safeString($txt_id)."'";
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
	  if ($this->existMasterBeli($this->id_beli,$db)) {
	  	 $this->status = $this->status + 1;
         $sqlstr = "update $this->tablename set status='".safeString($this->status)."'
	        where id_beli='".safeString($this->id_beli)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }

           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
	  }
	}

	function saveMasterBeli($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterBeli($this->id_beli,$db)) {
  	         $sqlstr = "update $this->tablename set op_id='".safeString($this->op_id)."',
			  tgl_beli='".safeString($this->tgl_beli)."',
			  user_beli='".safeString($this->user_beli)."',
			  spl_id='".safeString($this->spl_id)."',
			  syarat='".safeString($this->syarat)."',
			  syarat2='".safeString($this->syarat2)."',
			  status='".safeString($this->status)."'
		        where id_beli='".safeString($this->id_beli)."'";
	       } else {
		   	  
			  $sqlstr = "select op_id from $this->tablename where op_id=".safeString($this->op_id);
			  $result = mysql_query($sqlstr);
			  if (mysql_num_rows($result)>0)
		   		 $this->no_urut	= mysql_num_rows($result)+1;		   			  
			  else
		   		 $this->no_urut	= 1;	
			  mysql_free_result($result);	 	   
		   
  	          $sqlstr = "insert into $this->tablename(op_id,no_urut,tgl_beli,user_beli,spl_id,syarat,syarat2,status) 
		        values ('".safeString($this->op_id)."',
				'".safeString($this->no_urut)."',
				'".safeString($this->tgl_beli)."',
				'".safeString($this->user_beli)."',
				'".safeString($this->spl_id)."',
				'".safeString($this->syarat)."',
				'".safeString($this->syarat2)."',
		        '".safeString($this->status)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->id_beli = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 


}

?>