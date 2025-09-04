<?
/*
  Write : Onix
  Last Modified : October 12, 2008
*/

class MasterBarang
{

    var $master_id,$master_name,$satuan_id,$satuan_name,$group_name,$last_price,$konversi,$date_add,$note;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "master_barang";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Nama", $this->master_name, "text", "y", 100, 5);
	   $example->add_num_field("Satuan", $this->satuan_id, "number", "y", 0, 10);
	   $example->add_num_field("Harga Terakhir", $this->last_price, "number", "y", 0, 10);
	   $example->add_num_field("Konversi", $this->konversi, "number", "n", 0, 1);
	   $example->add_text_field("Keterangan", $this->note, "text", "n", 0, 0);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterMasterBarang()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->master_name;
		$this->master_name			= $myFilter->process($before);
		$before 			= $this->satuan_id;
		$this->satuan_id	= $myFilter->process($before);
		$before				= $this->last_price;
		$this->last_price	= $myFilter->process($before);
		$before				= $this->konversi;
		$this->konversi		= $myFilter->process($before);
		$before				= $this->note;
		$this->note			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->master_id	= $this->data['master_id'];   
         $this->master_name 		= $this->data['master_name'];   
	     $this->satuan_id 	= $this->data['satuan_id'];
	     $this->last_price	= $this->data['last_price'];
	     $this->konversi	= $this->data['konversi'];
	     $this->date_add 	= $this->data['date_add'];
	     $this->note	 	= $this->data['note'];

		require_once("satuan.php");
		$satuan = new Satuan;
		if ($satuan->getSatuan($this->satuan_id,$db))
		   $this->satuan_name = $satuan->satuan_name;		 
	}

	function existMasterBarang($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where master_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasterBarang($txt_id,$db) 
    {
       if (! $this->existMasterBarang($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delMasterBarang($txt_id,$db) 
	{
       if ($this->existMasterBarang($txt_id,$db)) {
	       $sqlstr = "select master_id from detail_op where master_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where master_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
				}
		    } else {
		       $this->error = "Data masih digunakan pada Procurement";
		       return False;
			} 
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveMasterBarang($db) 
	{   
	  $this->filterMasterBarang();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterBarang($this->master_id,$db)) {
  	         $sqlstr = "update $this->tablename set master_name='".safeString($this->master_name)."',
			  last_price='".safeString($this->last_price)."',
			  konversi='".safeString($this->konversi)."',
			  satuan_id='".safeString($this->satuan_id)."',
			  note='".safeString($this->note)."',
			  date_add='".safeString(date("Y-m-d H:i:s"))."'
		        where master_id='".safeString($this->master_id)."'";
	       } else {
		      $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(master_name,satuan_id,last_price,konversi,note,date_add) 
		        values ('".safeString($this->master_name)."',
				'".safeString($this->satuan_id)."',
				'".safeString($this->last_price)."',
				'".safeString($this->konversi)."',
				'".safeString($this->note)."',
		        '".safeString(date("Y-m-d H:i:s"))."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->master_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>