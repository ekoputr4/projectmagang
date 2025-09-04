<?
/*
  Write : Onix
  Last Modified : May 19, 2009
*/

class Road
{

    var $road_id,$area_id,$road_name,$acode_id;
	var $data,$error;
	var $good_fields = array();
    var $tablename = "road";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Area", $this->area_id, "text", "y", 0, 0, 1);
	   $example->add_text_field("Road Name", $this->road_name, "text", "y", 50, 2);
	   
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterRoad()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->area_id;
		$this->area_id			= $myFilter->process($before);
		$before 				= $this->road_name;
		$this->road_name		= $myFilter->process($before);
		$before 				= $this->acode_id;
		$this->acode_id			= $myFilter->process($before);

	}


	function getData()
	{
         $this->road_id		= $this->data['road_id'];   
         $this->area_id		= $this->data['area_id'];   
         $this->road_name 	= $this->data['road_name'];
		 //tambahan
		 $this->acode_id 	= $this->data['acode_id'];   
	}

	function existRoad($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where road_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getRoad($txt_id,$db) 
    {
       if (! $this->existRoad($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	function delRoad($txt_id,$db) 
	{
       if ($this->existRoad($txt_id,$db)) {
	       $sqlstr = "select road_id from shipping_account where road_id='".safeString($txt_id)."'";
		   $result = mysql_query($sqlstr,$db);
		   if (mysql_num_rows($result)==0) {
			   $sqlstr = "delete from $this->tablename where road_id='".safeString($txt_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
				  
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		   } else {
		      $this->error = "Road used by Account";
			  return False;
		   }						
	   } else {
	       $this->error = "Data not found";
	       return False;
	   }
	}

	
	function saveRoad($db) 
	{   
	  $this->filterRoad();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existRoad($this->road_id,$db)) {
  	         $sqlstr = "update $this->tablename set road_name='".safeString($this->road_name)."',
			 area_id='".safeString($this->area_id)."',
			 acode_id='".safeString($this->acode_id)."'
		        where road_id='".safeString($this->road_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(area_id,road_name,acode_id) 
		        values ('".safeString($this->area_id)."',
				'".ucwords(safeString($this->road_name))."','".safeString($this->acode_id)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->road_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>