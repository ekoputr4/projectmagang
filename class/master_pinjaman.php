<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class MasterPinjaman
{

    var $mas_id,$kry_id,$tgl_pinjam,$jml_pinjam,$keterangan,$lunas,$jml_bunga;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "master_pinjaman";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Pinjam", $this->tgl_pinjam, "date", "us", "y");
	   $example->add_text_field("Keterangan", $this->keterangan, "text", "y", 0, 1);
	   $example->add_num_field("Jumlah Pinjaman", $this->jml_pinjam, "number", "y", 0, 0, 1);
	   $example->add_num_field("Jumlah Bunga", $this->jml_bunga, "number", "n", 0, 0, 1);
	   $example->add_num_field("Lunas", $this->lunas, "number", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	   	   if ($this->cekHutang($db)==true)
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

	function cekHutang($db)
	{
	 	if ($this->kry_id>0) {
			$sqlstr = "select mas_id from $this->tablename where lunas=0 and kry_id=$this->kry_id";
			$result = mysql_query($sqlstr,$db);
			if (mysql_num_rows($result)>0) {
				$this->error = "Karyawan masih memiliki hutang";
				return False;
			} else {
				return True;
			}		
	 	} else {	
			return False;
		}
	}
	
	function sisaHutang($txt_id,$db)
	{
		$total	= 0;
		$sqlstr = "select jml_pinjam,jml_bunga from $this->tablename where mas_id=$txt_id";	
		$result	= mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0) {
			$data 		= mysql_fetch_array($result);
			$total		+= $data[jml_pinjam] + $data[jml_bunga];
			$sqlstr2	= "select jml_bayar from detail_pinjaman where mas_id=$txt_id and lock_pinjam=1";
			$result2	= mysql_query($sqlstr2,$db);
			if (mysql_num_rows($result)>0) {
				while ($data2=mysql_fetch_array($result2)) {
					$total -= $data2[jml_bayar];
				}
			}			
			return $total;
		} else {
			return 0;
		}
	}
	
	function filterMasterPinjaman()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->mas_id;
		$this->mas_id		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->tgl_pinjam;
		$this->tgl_pinjam	= $myFilter->process($before);
		$before 			= $this->jml_pinjam;
		$this->jml_pinjam	= $myFilter->process($before);
		$before 			= $this->keterangan;
		$this->keterangan	= $myFilter->process($before);
		$before 			= $this->lunas;
		$this->lunas		= $myFilter->process($before);
		$before 			= $this->jml_bunga;
		$this->jml_bunga	= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->mas_id			= $this->data['mas_id'];   
         $this->kry_id 			= $this->data['kry_id'];   
         $this->tgl_pinjam		= $this->data['tgl_pinjam'];   
         $this->jml_pinjam		= $this->data['jml_pinjam'];   
         $this->keterangan 		= $this->data['keterangan'];   
         $this->lunas			= $this->data['lunas'];   
         $this->jml_bunga	 	= $this->data['jml_bunga'];   
	}

	function existMasterPinjaman($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where mas_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getMasterPinjaman($txt_id,$db) 
    {
       if (! $this->existMasterPinjaman($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delMasterPinjaman($txt_id,$db) 
	{
       if ($this->existMasterPinjaman($txt_id,$db)) {
	       $sqlstr = "select mas_id from detail_pinjaman where mas_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where mas_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "Pinjaman telah digunakan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveMasterPinjaman($db) 
	{   
	  $this->filterMasterPinjaman();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterPinjaman($this->mas_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 tgl_pinjam='".safeString($this->tgl_pinjam)."',
			 jml_pinjam='".safeString($this->jml_pinjam)."',
			 keterangan='".safeString($this->keterangan)."',
			 lunas='".safeString($this->lunas)."',
			 jml_bunga='".safeString($this->jml_bunga)."'
		        where mas_id='".safeString($this->mas_id)."'";
	       } else {
		   	  $this->new = 1;	
  	          $sqlstr = "insert into $this->tablename(kry_id,tgl_pinjam,jml_pinjam,keterangan,lunas,jml_bunga) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->tgl_pinjam)."',
				'".safeString($this->jml_pinjam)."',
				'".safeString($this->keterangan)."',
				'".safeString($this->lunas)."',
				'".safeString($this->jml_bunga)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->mas_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>