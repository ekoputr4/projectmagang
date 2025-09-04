<?
/*
  Write : Onix
  Last Modified : Nov 06, 2008
*/

class DetailOP
{

    var $id,$op_id,$master_id,$qty,$qty_approve,$qty_buy,$kegunaan,$hrg_estimasi,$tgl_butuh,$status,$note,$note_2;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "detail_op";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("OP ID", $this->op_id, "text", "y", 0, 0, 1);
	   $example->add_num_field("Master ID", $this->master_id, "text", "y", 0, 0, 1);
	   $example->add_num_field("Qty", $this->qty, "number", "y", 0, 0, 1);
	   $example->add_num_field("Kegunaan", $this->kegunaan, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Dibutuhkan", $this->tgl_butuh, "date", "us", "y");
	   $example->add_num_field("Estimation Price", $this->hrg_estimasi, "number", "y", 0, 0, 1);
	   $example->add_num_field("Status", $this->status, "number", "n", 0, 0, 1);
	   $example->add_text_field("Note", $this->note, "text", "y", 0, 1);
	   if ($example->validation()) {
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabelApprove($db)
	{
	   //$this->filterDetailOP();	
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("ID", $this->id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Qty Approve", $this->qty_approve, "number", "y", 0, 0, 1);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDetailOP()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->id;
		$this->id			= $myFilter->process($before);
		$before 			= $this->op_id;
		$this->op_id		= $myFilter->process($before);
		$before 			= $this->master_id;
		$this->master_id	= $myFilter->process($before);
		$before 			= $this->qty;
		$this->qty	 		= $myFilter->process($before);
		$before 			= $this->qty_approve;
		$this->qty_approve	= $myFilter->process($before);
		$before 			= $this->qty_buy;
		$this->qty_buy 		= $myFilter->process($before);
		$before 			= $this->kegunaan;
		$this->kegunaan		= $myFilter->process($before);
		$before 			= $this->hrg_estimasi;
		$this->hrg_estimasi	= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
		$before 			= $this->tgl_butuh;
		$this->tgl_butuh	= $myFilter->process($before);
		$before 			= $this->note;
		$this->note			= $myFilter->process($before);
		$before 			= $this->note_2;
		$this->note_2		= $myFilter->process($before);
	}


	function getData()
	{
         $this->id		 		= $this->data['id'];   
         $this->op_id	 		= $this->data['op_id'];   
         $this->master_id		= $this->data['master_id'];   
	     $this->qty				= $this->data['qty'];
	     $this->qty_approve		= $this->data['qty_approve'];
	     $this->qty_buy			= $this->data['qty_buy'];
	     $this->kegunaan		= $this->data['kegunaan'];
	     $this->hrg_estimasi	= $this->data['hrg_estimasi'];
	     $this->status			= $this->data['status'];
	     $this->tgl_butuh		= $this->data['tgl_butuh'];
	     $this->note			= $this->data['note'];
	     $this->note_2			= $this->data['note_2'];
	}

	function existDetailOP($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getDetailOP($txt_id,$db) 
    {
       if (! $this->existDetailOP($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }


	function delDetailOP($txt_id,$db) 
	{
       if ($this->existDetailOP($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where id='".safeString($txt_id)."'";
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

	function saveDetailApprove($db) 
	{   
	  $this->filterDetailOP();   
	  if ($this->existDetailOP($this->id,$db)) {
         $sqlstr = "update $this->tablename set 
		  qty_approve='".safeString($this->qty_approve)."',
		  status='".safeString($this->status)."',
		  note_2='".safeString($this->note_2)."'
	        where id='".safeString($this->id)."'";

          if (!$result = mysql_query($sqlstr,$db))  {
	       $this->error = mysql_error();    }
          if (! $result) { 
	          return False;
		    } else { 
	    	  return True;
		    }  
	   } else {
          return False;
	   }
	} 

	function savePembelian($db) 
	{   
	  $this->filterDetailOP();   
	  if ($this->existDetailOP($this->id,$db)) {
         $sqlstr = "update $this->tablename set 
		  qty_buy='".safeString($this->qty_buy)."',
		  status='".safeString($this->status)."'
	        where id='".safeString($this->id)."'";

          if (!$result = mysql_query($sqlstr,$db))  {
	       $this->error = mysql_error();    }
          if (! $result) { 
	          return False;
		    } else { 
	    	  return True;
		    }  
	   } else {
          return False;
	   }
	} 

	function saveStatus($db) 
	{   
	  $this->filterDetailOP();   
	  if ($this->existDetailOP($this->id,$db)) {
         $sqlstr = "update $this->tablename set 
		  status='".safeString($this->status)."'
	        where id='".safeString($this->id)."'";

          if (!$result = mysql_query($sqlstr,$db))  {
	       $this->error = mysql_error();    }
          if (! $result) { 
	          return False;
		    } else { 
	    	  return True;
		    }  
	   } else {
          return False;
	   }
	} 

	function saveDetailOP($db) 
	{   
	  $this->filterDetailOP();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailOP($this->id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  op_id='".safeString($this->op_id)."',
			  master_id='".safeString($this->master_id)."',
			  qty='".safeString($this->qty)."',
			  kegunaan='".safeString($this->kegunaan)."',
			  tgl_butuh='".safeString($this->tgl_butuh)."',
			  hrg_estimasi='".safeString($this->hrg_estimasi)."',
			  status='".safeString($this->status)."',
			  note='".safeString($this->note)."'
		        where id='".safeString($this->id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(op_id,master_id,qty,kegunaan,tgl_butuh,hrg_estimasi,status,note) 
		        values ('".safeString($this->op_id)."',
				'".safeString($this->master_id)."',				
				'".safeString($this->qty)."',
				'".safeString($this->kegunaan)."',
				'".safeString($this->tgl_butuh)."',
				'".safeString($this->hrg_estimasi)."',
		        '".safeString($this->status)."',
		        '".safeString($this->note)."')";
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