<?
/*
  Write : Onix
  Last Modified : Mar 3, 2009
*/

class DemosiKaryawan
{

    var $demo_id,$kry_id,$demo_sk,$approve;
	var $tgl_sk,$tgl_approve,$user_create,$user_approve,$demo_ket,$tgl_buat;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "demosi_karyawan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 0);
	   $example->add_date_field("Tanggal SK", $this->tgl_sk,  "date", "us", "y");
	   $example->add_text_field("Surat Keputusan", $this->demo_sk, "text", "y", 50, 1);
	   $example->add_num_field("User", $this->user_create, "number", "y", 0, 0, 1);
	   $example->add_text_field("Keterangan", $this->demo_ket, "text", "y", 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDemosiKaryawan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->demo_id;
		$this->demo_id			= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->demo_sk;
		$this->demo_sk			= $myFilter->process($before);
		$before 				= $this->approve;
		$this->approve			= $myFilter->process($before);
		$before 				= $this->tgl_approve;
		$this->tgl_approve		= $myFilter->process($before);
		$before 				= $this->user_create;
		$this->user_create		= $myFilter->process($before);
		$before 				= $this->user_approve;
		$this->user_approve		= $myFilter->process($before);
		$before 				= $this->demo_ket;
		$this->demo_ket			= $myFilter->process($before);
		$before 				= $this->tgl_buat;
		$this->tgl_buat			= $myFilter->process($before);
		$before 				= $this->tgl_sk;
		$this->tgl_sk			= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->demo_id			= $this->data['demo_id'];   
         $this->kry_id	 		= $this->data['kry_id'];   
         $this->demo_sk			= $this->data['demo_sk'];   
         $this->tgl_sk			= $this->data['tgl_sk'];   
         $this->approve			= $this->data['approve'];   
         $this->tgl_approve		= $this->data['tgl_approve'];   
         $this->user_create		= $this->data['user_create'];   
         $this->user_approve	= $this->data['user_approve'];   
         $this->demo_ket		= $this->data['demo_ket'];   
         $this->tgl_buat		= $this->data['tgl_buat'];   

	}

	function existDemosiKaryawan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where demo_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getDemosiKaryawan($txt_id,$db) 
    {
       if (! $this->existDemosiKaryawan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delDemosiKaryawan($txt_id,$db) 
	{
       if ($this->existDemosiKaryawan($txt_id,$db)) {
           $this->approve			= $this->data['approve'];   
		   if ($this->approve==0) {
			   $sqlstr = "delete from $this->tablename where demo_id='".safeString($txt_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
				  
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
			} else {
		        $this->error = "Demosi telah diproses oleh Direksi";
				return False;
			}
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	function saveApprove($db) {
	  if ($this->existDemosiKaryawan($this->demo_id,$db)) {
         $sqlstr = "update $this->tablename set
		 approve='".safeString($this->approve)."',
		 tgl_approve='".safeString(date("Y-m-d"))."',
		 user_approve='".safeString($this->user_approve)."',
		 demo_ket='".safeString($this->demo_ket)."'
	        where demo_id='".safeString($this->demo_id)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 			
		      return True;
		    }  
	  } else {
	  	return False;
		$this->error = "Demosi karyawan tidak ditemukan";
	  }		
	}
	
	function saveDemosiKaryawan($db) 
	{   
	  $this->filterDemosiKaryawan();   
	  $this->new	= 0;
	  if ($this->cekVariabel($db))  {
		  if ($this->existDemosiKaryawan($this->demo_id,$db)) {
  	         $sqlstr = "update $this->tablename set kry_id='".safeString($this->kry_id)."',
			 demo_sk='".safeString($this->demo_sk)."',
			 tgl_sk='".safeString($this->tgl_sk)."',
			 approve='".safeString($this->approve)."',
			 user_create='".safeString($this->user_create)."',
			 demo_ket='".safeString($this->demo_ket)."'
		        where demo_id='".safeString($this->demo_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(kry_id,demo_sk,tgl_sk,user_create,demo_ket,tgl_buat) 
		        values ('".safeString($this->kry_id)."',
				'".safeString($this->demo_sk)."',
				'".safeString($this->tgl_sk)."',
				'".safeString($this->user_create)."',
				'".safeString($this->demo_ket)."',
				'".safeString(date("Y-m-d"))."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->demo_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>