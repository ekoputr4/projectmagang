<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DetailPinjaman
{

    var $det_id,$mas_id,$tgl_bayar,$jml_bayar,$lock_pinjam;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "detail_pinjaman";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->mas_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Potong", $this->tgl_bayar, "date", "us", "y");
	   $example->add_num_field("Jumlah", $this->jml_bayar, "number", "y", 0, 0, 1);
	   $example->add_num_field("Lunas", $this->lock_pinjam, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	     	   		  
	   	   if ($this->cekHutang($db)==true && $this->sisaHutang($db)==true)
		       return True;
		   else
		       return False;		   	   
       } else {
	       $this->error = $example->create_msg();
		   $this->cekHutang($db);
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function sisaHutang($db)
	{
		$total = $this->jumlahHutang($db) - $this->jumlahTerbayar($db);
		if ($this->jml_bayar <= $total) {
			return True;
		} else {
			$this->error = "Jumlah potongan pembayaran melebihi sisa hutang";
			return False;
		}			
	}
	
	function cekHutang($db)
	{
	 	if ($this->mas_id>0) {
			$sqlstr = "select mas_id from master_pinjaman where mas_id=$this->mas_id and lunas=0";
			$result = mysql_query($sqlstr,$db);
			if (mysql_num_rows($result)>0) {
				return True;
			} else {
				$this->error = "Karyawan tidak memiliki hutang";
				return False;
			}		
	 	} else {	
			return False;
		}
	}
	
	function jumlahTerbayar($db)
	{
		  $sqlstr 	= "select sum(jml_bayar) as total from $this->tablename where mas_id=$this->mas_id
		  	and lock_pinjam=1 group by mas_id";
		  $result2 	= mysql_query($sqlstr,$db);
		  $total1	= 0;
		  if (mysql_num_rows($result2)>0) {
		     $data2 = mysql_fetch_array($result2);
			 $total1	= $data2[total];
		  }	
		  return $total1;
	}

	function jumlahHutang($db)
	{
		  $sqlstr 	= "select (jml_pinjam+jml_bunga) as jml_pinjam from master_pinjaman where mas_id=$this->mas_id";	
		  $result3	= mysql_query($sqlstr,$db);	
		  $total2	= 0;
		  if (mysql_num_rows($result3)>0) {
		  	$data3	= mysql_fetch_array($result3);
			$total2	= $data3[jml_pinjam];
		  }
		  return $total2;
	}
	
	function filterDetailPinjaman()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->det_id;
		$this->det_id		= $myFilter->process($before);
		$before 			= $this->mas_id;
		$this->mas_id		= $myFilter->process($before);
		$before 			= $this->tgl_bayar;
		$this->tgl_bayar	= $myFilter->process($before);
		$before 			= $this->jml_bayar;
		$this->jml_bayar	= $myFilter->process($before);
		$before 			= $this->lock_pinjam;
		$this->lock_pinjam			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->det_id			= $this->data['det_id'];   
         $this->mas_id 			= $this->data['mas_id'];   
         $this->tgl_bayar		= $this->data['tgl_bayar'];   
         $this->jml_bayar		= $this->data['jml_bayar'];   
         $this->lock_pinjam			= $this->data['lock_pinjam'];   
	}

	function existDetailPinjaman($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where det_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDetailPinjaman($txt_id,$db) 
    {
       if (! $this->existDetailPinjaman($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delDetailPinjaman($txt_id,$db) 
	{
       if ($this->existDetailPinjaman($txt_id,$db)) {
	   	   $this->lock_pinjam	= $this->data['lock_pinjam']; 
		   if ($this->lock_pinjam==0) {
		       $sqlstr = "delete from $this->tablename where det_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Pembayaran Pinjaman telah dikunci";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDetailPinjaman($db) 
	{   
	  $this->filterDetailPinjaman();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailPinjaman($this->det_id,$db)) {
  	         $sqlstr = "update $this->tablename set mas_id='".safeString($this->mas_id)."',
			 tgl_bayar='".safeString($this->tgl_bayar)."',
			 jml_bayar='".safeString($this->jml_bayar)."',
			 lock_pinjam='".safeString($this->lock_pinjam)."'
		        where det_id='".safeString($this->det_id)."'";
	       } else {
		   	  $this->new = 1;	
  	          $sqlstr = "insert into $this->tablename(mas_id,tgl_bayar,jml_bayar,lock_pinjam) 
		        values ('".safeString($this->mas_id)."',
				'".safeString($this->tgl_bayar)."',
				'".safeString($this->jml_bayar)."',
				'".safeString($this->lock_pinjam)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->det_id = mysql_insert_id(); 

			  if ($this->jumlahHutang($db)-$this->jumlahTerbayar($db)==0) {
			  	$sqlstr = "update master_pinjaman set lunas=1 where	mas_id=$this->mas_id";
				mysql_query($sqlstr,$db);
			  }
		      return True;
		    }  
       }
	} 
}

?>