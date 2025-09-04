<?
/*
  Write : Onix
  Last Modified : Nov 15, 2008
*/

class DetailBeli
{

    var $id,$id_beli,$item_id_op,$qty,$qty_minta,$qty_ambil,$hrg_beli,$ppn;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "detail_beli";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	  $this->filterDetailBeli();   
  	   $example = new Validate_fields;
//	   $example->add_num_field("Beli ID", $this->id_beli, "number", "y", 0, 0, 0);
	   $example->add_num_field("Item ID OP", $this->item_id_op, "number", "y", 0, 0, 1);
	   $example->add_num_field("Qty", $this->qty, "number", "n", 0, 0, 0);
	   $example->add_num_field("Qty Permintaan", $this->qty_minta, "number", "y", 0, 0, 1);
	   $example->add_num_field("Harga Beli", $this->hrg_beli, "number", "y", 0, 0, 1);
	   $example->add_text_field("PPN", $this->ppn, "text", "y", 0, 1);
	   if ($example->validation()) {
		   $this->good_fields = $example->good_fields;
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 


	function filterDetailBeli()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme

		$before 			= $this->id;
		$this->id			= $myFilter->process($before);
		$before 			= $this->id_beli;
		$this->id_beli		= $myFilter->process($before);
		$before 			= $this->item_id_op;
		$this->item_id_op	= $myFilter->process($before);
		$before 			= $this->qty;
		$this->qty	 		= $myFilter->process($before);
		$before 			= $this->qty_minta;
		$this->qty_minta	= $myFilter->process($before);
		$before 			= $this->qty_ambil;
		$this->qty_ambil	= $myFilter->process($before);
		$before 			= $this->hrg_beli;
		$this->hrg_beli		= $myFilter->process($before);
		$before 			= $this->ppn;
		$this->ppn			= $myFilter->process($before);
	}


	function getData()
	{
         $this->id		 		= $this->data['id'];   
         $this->id_beli	 		= $this->data['id_beli'];   
         $this->item_id_op		= $this->data['item_id_op'];   
	     $this->qty				= $this->data['qty'];
	     $this->hrg_beli		= $this->data['hrg_beli'];
	     $this->ppn				= $this->data['ppn'];
	}

	function existDetailBeli($txt_id,$db) 
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

    function getDetailBeli($txt_id,$db) 
    {
       if (! $this->existDetailBeli($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }


	function delDetailBeli($txt_id,$db) 
	{
       if ($this->existDetailBeli($txt_id,$db)) {
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

	function saveAmbilGudang($db) 
	{   
		  if ($this->existDetailBeli($this->id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  qty_ambil='".safeString($this->qty_ambil)."'
		        where id='".safeString($this->id)."'";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
	} 


	function saveDetailBeli($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailBeli($this->id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  id_beli='".safeString($this->id_beli)."',
			  item_id_op='".safeString($this->item_id_op)."',
			  qty='".safeString($this->qty)."',
			  qty_ambil='".safeString($this->qty_ambil)."',
			  hrg_beli='".safeString($this->hrg_beli)."',
			  ppn='".safeString($this->ppn)."'
		        where id='".safeString($this->id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(id_beli,item_id_op,qty,hrg_beli,ppn) 
		        values ('".safeString($this->id_beli)."',
				'".safeString($this->item_id_op)."',				
				'".safeString($this->qty)."',
				'".safeString($this->hrg_beli)."',
		        '".safeString($this->ppn)."')";
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