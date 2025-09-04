<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class SubJabatan
{

    var $sub_id,$sub_name,$jab_id,$job_skill,$job_responsibility,$job_description,$komisi;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "subjabatan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("SubJabatan", $this->sub_name, "text", "y", 30, 2);
	   $example->add_num_field("Jabatan", $this->jab_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Skill", $this->job_skill, "text", "n", 0, 0, 1);
	   $example->add_text_field("Responsibility", $this->job_responsibility, "text", "n", 0, 0, 1);
	   $example->add_text_field("Description", $this->job_description, "text", "n", 0, 0, 1);
	   $example->add_text_field("Komisi", $this->komisi, "text", "n", 0, 0, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSubJabatan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 					= $this->sub_name;
		$this->sub_name				= $myFilter->process($before);
		$before 					= $this->jab_id;
		$this->jab_id				= $myFilter->process($before);
		$before 					= $this->job_skill;
		$this->job_skill			= $myFilter->process($before);
		$before 					= $this->job_responsibility;
		$this->job_responsibility	= $myFilter->process($before);
		$before 					= $this->job_description;
		$this->job_description		= $myFilter->process($before);		
		$before 					= $this->komisi;
		$this->komisi				= $myFilter->process($before);		
	}


	function getData()
	{
         $this->sub_id				= $this->data['sub_id'];   
         $this->sub_name 			= $this->data['sub_name'];   
         $this->jab_id 				= $this->data['jab_id'];   
         $this->job_skill 			= $this->data['job_skill'];   
         $this->job_responsibility	= $this->data['job_responsibility'];   
         $this->job_description 	= $this->data['job_description'];   
         $this->komisi			 	= $this->data['komisi'];   
	}

	function existSubJabatan($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where sub_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSubJabatan($txt_id,$db) 
    {
       if (! $this->existSubJabatan($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delSubJabatan($txt_id,$db) 
	{
       if ($this->existSubJabatan($txt_id,$db)) {
	       $sqlstr = "select sub_id from karyawan where sub_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
		       $sqlstr = "delete from $this->tablename where sub_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
		   } else {
		      $this->error = "SubJabatan masih digunakan pada Karyawan";
			  return False;
		   }						
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveSubJabatan($db) 
	{   
   	  $this->new = 0;
	  $this->filterSubJabatan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSubJabatan($this->sub_id,$db)) {
  	         $sqlstr = "update $this->tablename set sub_name='".safeString($this->sub_name)."',
			 job_skill='".safeString($this->job_skill)."',
			 job_responsibility='".safeString($this->job_responsibility)."',
			 job_description='".safeString($this->job_description)."',
			 komisi='".safeString($this->komisi)."',
			 jab_id='".safeString($this->jab_id)."'
		        where sub_id='".safeString($this->sub_id)."'";
	       } else {
		   	  $this->new = 1;
  	          $sqlstr = "insert into $this->tablename(sub_name,jab_id,job_skill,job_responsibility,job_description,komisi) 
		        values ('".safeString($this->sub_name)."',
		        '".safeString($this->jab_id)."',
		        '".safeString($this->job_skill)."',
		        '".safeString($this->job_responsibility)."',
		        '".safeString($this->job_description)."',
		        '".safeString($this->komisi)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else {
			  if ($this->new == 1) 
	 			  $this->sub_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>