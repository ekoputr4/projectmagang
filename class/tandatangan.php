<?
/*
  Write : Onix
  Last Modified : Feb 4, 2009
*/

class TandaTangan
{

    var $gm,$fin,$hrd,$ucapan_thr;
	var $data,$error,$new;
	var $good_fields = array();
    var $tablename = "tandatangan";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("General Manager", $this->gm, "text", "y", 50, 2);
	   $example->add_text_field("Finance", $this->fin, "text", "y", 50, 2);
	   $example->add_text_field("HRD", $this->hrd, "text", "y", 50, 2);
	   $example->add_text_field("Ucapan THR", $this->ucapan_thr, "text", "y", 100, 2);
	   if ($example->validation()) {	       
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function filterTandaTangan()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->gm;
		$this->gm			= $myFilter->process($before);
		$before 			= $this->fin;
		$this->fin			= $myFilter->process($before);
		$before 			= $this->hrd;
		$this->hrd			= $myFilter->process($before);
		$before 			= $this->ucapan_thr;
		$this->ucapan_thr	= $myFilter->process($before);
	}

	function getData()
	{
         $this->gm			= $this->data['gm'];   
         $this->fin 		= $this->data['fin'];   
         $this->hrd 		= $this->data['hrd'];   
         $this->ucapan_thr	= $this->data['ucapan_thr'];   
	}

	function existTandaTangan($db) 
	{
	   $sqlstr = "select * from $this->tablename";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}


    function getTandaTangan($db) 
    {
       if (! $this->existTandaTangan($db)) {
           return  False;
       } else {
	   	   $this->getData();
	       return True;
       }
	 }

	
	function saveTandaTangan($db) 
	{   
	  $this->filterTandaTangan();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existTandaTangan($db)) {
  	         $sqlstr = "update $this->tablename set gm='".safeString($this->gm)."',
			 fin='".safeString($this->fin)."',
			 hrd='".safeString($this->hrd)."',
			 ucapan_thr='".safeString($this->ucapan_thr)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(gm,fin,hrd,ucapan_thr) 
		        values ('".safeString($this->gm)."',
				'".safeString($this->fin)."',
				'".safeString($this->hrd)."',
				'".safeString($this->ucapan_thr)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
       }
	} 
}

?>