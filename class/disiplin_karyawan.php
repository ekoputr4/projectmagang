<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DisiplinKaryawan
{

    var $td_id,$dis_id,$kry_id,$tgl_kejadian,$kejadian,$tgl_tindakan,$td_expired,$keterangan;
	var $user_request,$approve,$tgl_approve;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "disiplin_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Tindakan", $this->dis_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_date_field("Tanggal Kejadian", $this->tgl_kejadian, "date", "us", "y");
	   $example->add_text_field("Kejadian", $this->kejadian, "text", "y", 0, 1);
	   $example->add_date_field("Tanggal Tindakan", $this->tgl_tindakan, "date", "us", "n");
	   $example->add_date_field("Tanggal Terakhir Berlaku", $this->td_expired, "date", "us", "y");
	   $example->add_text_field("Keterangan", $this->keterangan, "text", "y", 0, 1);
	   $example->add_num_field("Kabag/Kadiv", $this->user_request, "number", "y", 0, 0, 1);
	   $example->add_num_field("Approve", $this->approve, "number", "y", 0, 0, 1);	   
	   if ($example->validation()) {	   
	       if ($this->cekSP($db))    
		       return True;
		   else 
		   	   return False;	   
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekSP($db)
	{
		$sqlstr = "select * from master_kedisiplinan where dis_id='$this->dis_id'";
		$result = mysql_query($sqlstr,$db);
		if (mysql_num_rows($result)>0) {
			$data = mysql_fetch_array($result);
			if ($data[dis_level]==0) {
				return True;
			} else {				
				$sqlstr = "select b.dis_level from $this->tablename a
				INNER JOIN master_kedisiplinan b ON (a.dis_id=b.dis_id)
				where kry_id='$this->kry_id'
				and (approve=2 and td_expired>='$this->tgl_tindakan') order by td_expired desc limit 0,1";
				$result2 = mysql_query($sqlstr,$db);
				if (mysql_num_rows($result2)>0) {					
					$data2 = mysql_fetch_array($result2);
					if ($data[dis_level]>$data2[dis_level]) {
						return True;
					} else {
						$this->error = "Tindakan harus lebih tinggi";
						return False;									
					}	
				} else {	
					return True;
				}
			}
		} else {
			$this->error = "Tindakan tidak ditemukan";
			return False;
		}
	}

	function filterDisiplinKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$myFilter2 = new InputFilter($tags, $attributes, 1, 1); // more info on constructor in readme
		$before 			= $this->dis_id;
		$this->dis_id		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->tgl_kejadian;
		$this->tgl_kejadian	= $myFilter->process($before);
		$before 			= $this->kejadian;
		$this->kejadian		= $myFilter2->process($before);
		$before 			= $this->tgl_tindakan;
		$this->tgl_tindakan	= $myFilter->process($before);
		$before 			= $this->td_expired;
		$this->td_expired	= $myFilter->process($before);
		$before 			= $this->keterangan;
		$this->keterangan	= $myFilter2->process($before);
		$before 			= $this->user_request;
		$this->user_request	= $myFilter->process($before);
		$before 			= $this->approve;
		$this->approve		= $myFilter->process($before);
		$before 			= $this->tgl_approve;
		$this->tgl_approve	= $myFilter->process($before);
	}

	function getData($db)
	{
         $this->td_id			= $this->data['td_id'];   
         $this->dis_id 			= $this->data['dis_id'];   
         $this->kry_id 			= $this->data['kry_id'];   
         $this->tgl_kejadian	= $this->data['tgl_kejadian'];   
         $this->kejadian		= $this->data['kejadian'];   
         $this->tgl_tindakan	= $this->data['tgl_tindakan'];   
         $this->keterangan		= $this->data['keterangan'];   
         $this->td_expired		= $this->data['td_expired'];   
         $this->tgl_approve		= $this->data['tgl_approve'];   
         $this->approve			= $this->data['approve'];   
         $this->user_request	= $this->data['user_request'];   
	}

	function existDisiplinKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where td_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDisiplinKaryawan($txt_id,$db) 
    {
       if (! $this->existDisiplinKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delDisiplinKaryawan($txt_id,$db) 
	{
       if ($this->existDisiplinKaryawan($txt_id,$db)) {
/*	       $sqlstr = "select td_id from tindakan_karyawan where td_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where td_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "DisiplinKaryawan masih digunakan pada Karyawan";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveApprove($db) {
	  if ($this->existDisiplinKaryawan($this->td_id,$db)) {
         $sqlstr = "update $this->tablename set
		 dis_id='".safeString($this->dis_id)."',
		 approve='".safeString($this->approve)."',
		 tgl_tindakan='".safeString($this->tgl_tindakan)."',
		 td_expired='".safeString($this->td_expired)."',
		 tgl_approve='".safeString(date("Y-m-d H:i:s"))."',
		 keterangan='".safeString($this->keterangan)."'
	        where td_id='".safeString($this->td_id)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 			
		      return True;
		    }  
	  } else {
	  	return False;
		$this->error = "Kedisiplinan karyawan tidak ditemukan";
	  }		
	}

	
	function saveDisiplinKaryawan($db) 
	{   
	  $this->filterDisiplinKaryawan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDisiplinKaryawan($this->td_id,$db)) {
  	         $sqlstr = "update $this->tablename set dis_id='".safeString($this->dis_id)."',
			 kry_id='".safeString($this->kry_id)."',
			 tgl_kejadian='".safeString($this->tgl_kejadian)."',
			 kejadian='".safeString($this->kejadian)."',
			 tgl_tindakan='".safeString($this->tgl_tindakan)."',
			 td_expired='".safeString($this->td_expired)."',
			 keterangan='".safeString($this->keterangan)."',
			 approve='".safeString($this->approve)."',
			 user_request='".safeString($this->user_request)."'
		        where td_id='".safeString($this->td_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(dis_id,kry_id,tgl_kejadian,kejadian,
			  	tgl_tindakan,td_expired,keterangan,user_request,approve) 
		        values ('".safeString($this->dis_id)."',
				'".safeString($this->kry_id)."',
				'".safeString($this->tgl_kejadian)."',
				'".safeString($this->kejadian)."',
				'".safeString($this->tgl_tindakan)."',
				'".safeString($this->td_expired)."',
				'".safeString($this->keterangan)."',
				'".safeString($this->user_request)."',
				'".safeString($this->approve)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->td_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>