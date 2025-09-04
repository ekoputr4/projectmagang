<?
/*
  Write : Onix
  Last Modified : Nov 28, 2008
*/

class DetailAmbil
{

    var $id,$id_ambil,$item_id_gudang,$qty,$aqty;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
	var $qty_field = "y";
    var $tablename = "detail_ambil";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
	   $this->filterDetailAmbil();   
  	   $example = new Validate_fields;
	   $example->add_num_field("Item ID Gudang", $this->item_id_gudang, "number", "y", 0, 0, 1);
	   $example->add_num_field("Qty Gudang", $this->aqty, "number", "n", 0, 0, 0);
	   $example->add_num_field("Qty", $this->qty, "number", "n", 0, 0, 0);
       $this->qty_field = "y";
	   if ($example->validation()) {
	   	   if ($this->qty <= $this->aqty) {
			   $this->good_fields = $example->good_fields;
			   return True;
		   } else {
		       $this->error = "Jumlah pengambilan lebih besar dari jumlah di gudang\\n";
		       $this->qty_field = "n";
			   return False;			   
		   }
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
	   	   if ($this->qty > $this->aqty) {
		       $this->error .= "\\nQuantity is bigger then data";
		       $this->qty_field = "n";
		   }
		   return False;
       }	   	
  	} 


	function filterDetailAmbil()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme

		$before 				= $this->id;
		$this->id				= $myFilter->process($before);
		$before 				= $this->id_ambil;
		$this->id_ambil			= $myFilter->process($before);
		$before 				= $this->item_id_gudang;
		$this->item_id_gudang	= $myFilter->process($before);
		$before 				= $this->qty;
		$this->qty				= $myFilter->process($before);
	}


	function getData()
	{
         $this->id		 		= $this->data['id'];   
         $this->id_ambil 		= $this->data['id_ambil'];   
         $this->item_id_gudang	= $this->data['item_id_gudang'];   
         $this->qty				= $this->data['qty'];   
	}

	function existDetailAmbil($txt_id,$db) 
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

    function getDetailAmbil($txt_id,$db) 
    {
       if (! $this->existDetailAmbil($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }


	function delDetailAmbil($txt_id,$db) 
	{
       if ($this->existDetailAmbil($txt_id,$db)) {
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


	function saveDetailAmbil($db) 
	{   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailAmbil($this->id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  id_ambil='".safeString($this->id_ambil)."',
			  item_id_gudang='".safeString($this->item_id_gudang)."',
			  qty='".safeString($this->qty)."'
		        where id='".safeString($this->id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(id_ambil,item_id_gudang,qty) 
		        values ('".safeString($this->id_ambil)."',
				'".safeString($this->item_id_gudang)."',
				'".safeString($this->qty)."')";
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