<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class DetailPelatihan
{

    var $det_id,$pel_id,$kry_id,$nilai1,$nilai2,$nilai3,$nilai4,$nilai5;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "detail_pelatihan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Pelatihan", $this->pel_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabel2($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Peserta", $this->det_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Nilai 1", $this->nilai1, "text", "y", 5, 1);
	   $example->add_text_field("Nilai 2", $this->nilai2, "text", "y", 5, 1);
	   $example->add_text_field("Nilai 3", $this->nilai3, "text", "y", 5, 1);
	   $example->add_text_field("Nilai 3", $this->nilai4, "text", "y", 5, 1);
	   $example->add_text_field("Kemampuan", $this->nilai5, "text", "y", 5, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDetailPelatihan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->pel_id;
		$this->pel_id		= $myFilter->process($before);
		$before 			= $this->kry_id;
		$this->kry_id		= $myFilter->process($before);
		$before 			= $this->nilai1;
		$this->nilai1		= $myFilter->process($before);
		$before 			= $this->nilai2;
		$this->nilai2		= $myFilter->process($before);
		$before 			= $this->nilai3;
		$this->nilai3		= $myFilter->process($before);
		$before 			= $this->nilai4;
		$this->nilai4		= $myFilter->process($before);
		$before 			= $this->nilai5;
		$this->nilai5		= $myFilter->process($before);
	}


	function getData()
	{
         $this->det_id		= $this->data['det_id'];   
         $this->pel_id 		= $this->data['pel_id'];   
         $this->kry_id 		= $this->data['kry_id'];   
         $this->nilai1 		= $this->data['nilai1'];   
         $this->nilai2	 	= $this->data['nilai2'];   
         $this->nilai3 		= $this->data['nilai3'];   
         $this->nilai4 		= $this->data['nilai4'];   
         $this->nilai5 		= $this->data['nilai5'];   
	}

	function existDetailPelatihan($txt_id,$db) 
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


    function getDetailPelatihan($txt_id,$db) 
    {
       if (! $this->existDetailPelatihan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDetailPelatihan($txt_id,$db) 
	{
       if ($this->existDetailPelatihan($txt_id,$db)) {
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
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveDetailPelatihan($db) 
	{   
	  $this->filterDetailPelatihan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailPelatihan($this->det_id,$db)) {
  	         $sqlstr = "update $this->tablename set pel_id='".safeString($this->pel_id)."',
			 kry_id='".safeString($this->kry_id)."'
		        where det_id='".safeString($this->det_id)."'";
	       } else {
		   	  $this->new	= 1;
  	          $sqlstr = "insert into $this->tablename(pel_id,kry_id) 
		        values ('".safeString($this->pel_id)."',
				'".safeString($this->kry_id)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->det_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 

	function saveDetailNilai($db) 
	{   
	  $this->filterDetailPelatihan();   
	  if ($this->cekVariabel2($db))  {
		  if ($this->existDetailPelatihan($this->det_id,$db)) {
  	         $sqlstr = "update $this->tablename set nilai1='".safeString($this->nilai1)."',
			 nilai2='".safeString($this->nilai2)."',
			 nilai3='".safeString($this->nilai3)."',
			 nilai4='".safeString($this->nilai4)."',
			 nilai5='".safeString($this->nilai5)."'
		        where det_id='".safeString($this->det_id)."'";
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
			  if ($this->new==1)
	 			  $this->det_id = mysql_insert_id(); 
		      return True;
		    }  
		  } else {
		  	return False;
			$this->error = "Peserta tidak ditemukan";
		  }
       }
	} 

}

?>