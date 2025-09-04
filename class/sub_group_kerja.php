<?
/*
  Write : Onix
  Last Modified : Feb 7, 2009
*/

class SubGroupKerja
{

    var $subgroup_id,$group_id,$subgroup_name;
	var $group_name;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "subgroupkerja";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Group", $this->group_id, "text", "y", 0, 0, 1);
	   $example->add_text_field("Nama SubGroup", $this->subgroup_name, "text", "y", 30, 1);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterSubGroupKerja()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->subgroup_id;
		$this->subgroup_id		= $myFilter->process($before);
		$before 				= $this->group_id;
		$this->group_id			= $myFilter->process($before);
		$before 				= $this->subgroup_name;
		$this->subgroup_name	= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->subgroup_id		= $this->data['subgroup_id'];   
         $this->group_id		= $this->data['group_id'];   
         $this->subgroup_name 	= $this->data['subgroup_name'];   

		 $found = 0;
		 $included_files = get_required_files();
		 foreach ($included_files as $filename) {
		 	if (substr($filename,-21)=='class\group_kerja.php' ||
			substr($filename,-21)=='class/group_kerja.php') {
			   $found=1;
			   break;
			}   
		 }
		 if ($found==0)
			 require_once("group_kerja.php");
		 $groupkerja2 = new GroupKerja;
		 $groupkerja2->getGroupKerja($this->group_id,$db); 
		 $this->group_name	= $groupkerja2->group_name;
	}

	function existSubGroupKerja($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where subgroup_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getSubGroupKerja($txt_id,$db) 
    {
       if (! $this->existSubGroupKerja($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function delSubGroupKerja($txt_id,$db) 
	{
       if ($this->existSubGroupKerja($txt_id,$db)) {
/*	       $sqlstr = "select subgroup_id from unit_kerja where subgroup_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {*/
		       $sqlstr = "delete from $this->tablename where subgroup_id='".safeString($txt_id)."'";
    	       if (!$result = mysql_query($sqlstr,$db))  {
			       $this->error = mysql_error();    
				}
			  
	           if (! $result) { 
		          return False;
			    } else { 
		    	  return True;
			    }  
/*		   } else {
		      $this->error = "SubGroupKerja masih digunakan pada data unit kerja";
			  return False;
		   }						*/
	   } else {
	       $this->error = "Data tidak ditemukan";
	       return False;
	   }
	}

	
	function saveSubGroupKerja($db) 
	{   
	  $this->filterSubGroupKerja();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existSubGroupKerja($this->subgroup_id,$db)) {
  	         $sqlstr = "update $this->tablename set subgroup_name='".safeString($this->subgroup_name)."',
			 group_id='".safeString($this->group_id)."'
		        where subgroup_id='".safeString($this->subgroup_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(group_id,subgroup_name) 
		        values ('".safeString($this->group_id)."',
				'".safeString($this->subgroup_name)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->subgroup_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>