<?
/*
  Write : Onix
  Last Modified : Mar 10, 2009
*/

class DetailDokumen
{

    var $det_id,$mt_id,$judul_dokumen,$file_dokumen;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "detail_dokumen";
	var $path_file  = "../dokumen/";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Judul Dokumen", $this->judul_dokumen, "text", "y", 50, 1);
	   $example->add_num_field("Group Dokumen", $this->mt_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("File Dokumen", $this->file_dokumen, "text", "y", 100, 5);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterDetailDokumen()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->det_id;
		$this->det_id			= $myFilter->process($before);
		$before 				= $this->mt_id;
		$this->mt_id			= $myFilter->process($before);
		$before 				= $this->judul_dokumen;
		$this->judul_dokumen	= $myFilter->process($before);
		$before 				= $this->file_dokumen;
		$this->file_dokumen		= $myFilter->process($before);
	}


	function getData()
	{
         $this->det_id			= $this->data['det_id'];   
         $this->mt_id			= $this->data['mt_id'];   
         $this->judul_dokumen 	= $this->data['judul_dokumen'];   
         $this->file_dokumen 	= $this->data['file_dokumen'];   
	}

	function existDetailDokumen($txt_id,$db) 
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


    function getDetailDokumen($txt_id,$db) 
    {
       if (! $this->existDetailDokumen($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delDetailDokumen($txt_id,$db) 
	{
       if ($this->existDetailDokumen($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where det_id='".safeString($txt_id)."'";
   	       if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    
			}
			  
           if (! $result) { 
	          return False;
		    } else { 
			  if (file_exists($this->path_file.$this->file_dokumen) && ($this->file_dokumen!="")) 
				 unlink($this->path_file.$this->file_dokumen);
	    	  return True;
		    }  
	   } else {
	       $this->error = "Data DetailDokumen tidak ditemukan";
	       return False;
	   }
	}

	function UploadFile($file_name,$file_type,$file_size,$file_tmp)
	{
      $pic = $file_name; 		
	  if ($pic!='') {
		   // create Thumbnail Images
			$path_thumbs = $target;
			$extlimit 	= "yes"; //Limit allowed extensions? (no for all extensions allowed)
			$limitedext = array(".doc",".rtf",".txt",".xls",".pdf");
					
			$ext = strrchr($file_name,'.');	
			$ext = strtolower($ext);
		
			if (($extlimit == "yes") && (!in_array($ext,$limitedext))) {
			  $this->error = "File tidak dikenal";   
			}
					
			$getExt 		= explode ('.', $file_name);
			$file_ext 		= $getExt[count($getExt)-1];
			$rand_name 		= md5(time());
			$rand_name		= rand(0,999999999);
			$ThumbWidth 	= $img_thumb_width;
			$ThumbHeight 	= $img_thumb_width;	
					
			if($this->error==''){	
			  move_uploaded_file($file_tmp,$this->path_file."$rand_name.$file_ext");
			  $pic	=	"$rand_name.$file_ext";			
		    } else {
			  $pic  = "";					
		    }	
		   
	  	    if ($this->file_dokumen!='' && $pic!='') {
			   unlink($this->path_file.$this->file_dokumen);	
			   $this->file_dokumen	= $pic;		 	
		    } elseif ($pic!='') {
		 	   $this->file_dokumen = $pic;
		    } 
	   }
	   if ($error!='')
	  	  return False;
	   else
	      return True;	
	}
	
	function saveDetailDokumen($db) 
	{   
	  $this->filterDetailDokumen();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existDetailDokumen($this->det_id,$db)) {
  	         $sqlstr = "update $this->tablename set judul_dokumen='".safeString($this->judul_dokumen)."',
			 mt_id='".safeString($this->mt_id)."',
			 file_dokumen='".safeString($this->file_dokumen)."'
		        where det_id='".safeString($this->det_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(judul_dokumen,mt_id,file_dokumen) 
		        values ('".safeString($this->judul_dokumen)."',
				'".safeString($this->mt_id)."',
				'".safeString($this->file_dokumen)."')";
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
}

?>