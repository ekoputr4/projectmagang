<?
/*
  Write : Onix
  Last Modified : Nov 23, 2008
*/

class DetailGudang
{

    var $id,$id_trm,$item_id_beli,$qty,$status,$ket;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "detail_gudang";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	  $this->filterDetailGudang();   
  	   $example = new Validate_fields;
//	   $example->add_num_field("Gudang ID", $this->id_trm, "number", "y", 0, 0, 0);
	   $example->add_num_field("Item ID OP", $this->item_id_beli, "number", "y", 0, 0, 1);
	   $example->add_num_field("Qty", $this->qty, "number", "n", 0, 0, 0);
	   $example->add_num_field("Status", $this->status, "number", "y", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->ket, "text", "n", 50, 0);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 


	function filterDetailGudang()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme

		$before 			= $this->id;
		$this->id			= $myFilter->process($before);
		$before 			= $this->id_trm;
		$this->id_trm		= $myFilter->process($before);
		$before 			= $this->item_id_beli;
		$this->item_id_beli	= $myFilter->process($before);
		$before 			= $this->qty;
		$this->qty	 		= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
		$before 			= $this->ket;
		$this->ket			= $myFilter->process($before);
	}


	function getData()
	{
         $this->id		 		= $this->data['id'];   
         $this->id_trm	 		= $this->data['id_trm'];   
         $this->item_id_beli	= $this->data['item_id_beli'];   
	     $this->qty				= $this->data['qty'];
	     $this->status			= $this->data['status'];
	     $this->ket				= $this->data['ket'];
	}

	function existDetailGudang($txt_id,$db) 
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

    function getDetailGudang($txt_id,$db) 
    {
       if (! $this->existDetailGudang($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }


	function delDetailGudang($txt_id,$db) 
	{
       if ($this->existDetailGudang($txt_id,$db)) {
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


	function saveDetailGudang($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailGudang($this->id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  id_trm='".safeString($this->id_trm)."',
			  item_id_beli='".safeString($this->item_id_beli)."',
			  qty='".safeString($this->qty)."',
			  status='".safeString($this->status)."',
			  ket='".safeString($this->ket)."'
		        where id='".safeString($this->id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(id_trm,item_id_beli,qty,status,ket) 
		        values ('".safeString($this->id_trm)."',
				'".safeString($this->item_id_beli)."',				
				'".safeString($this->qty)."',
		        '".safeString($this->status)."',
		        '".safeString($this->angin)."')";
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