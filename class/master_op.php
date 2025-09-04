<?
/*
  Write : Onix
  Last Modified : October 30, 2008
*/

class MasterOP
{

    var $op_id,$requestid,$tgl_op,$user_id,$realname,$group_id,$group_name,$tgl_approve,$tgl_approve2,$status;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "master_op";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_text_field("OP Number", $this->requestid, "text", "y", 30, 10);
	   $example->add_date_field("OP Date", $this->tgl_op, "date", "us", "y");
	   $example->add_num_field("User ID", $this->user_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Group", $this->group_id, "number", "y", 0, 0, 1);
//	   $example->add_date_field("Approve Date", $this->tgl_approve, "date", "us", "y");
	   $example->add_text_field("Status", $this->status, "text", "y", 1, 1);
	   if ($example->validation()) {
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 

	function cekVariabelStatus($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("OP ID", $this->op_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Status", $this->status, "text", "y", 1, 1);
	   if ($example->validation()) {
	       return True;
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 


	function filterMasterOP()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->op_id;
		$this->op_id		= $myFilter->process($before);
		$before 			= $this->requestid;
		$this->requestid	= $myFilter->process($before);
		$before 			= $this->tgl_op;
		$this->tgl_op  		= $myFilter->process($before);
		$before 			= $this->user_id;
		$this->user_id		= $myFilter->process($before);
		$before 			= $this->group_id;
		$this->group_id		= $myFilter->process($before);
		$before 			= $this->tgl_approve;
		$this->tgl_approve	= $myFilter->process($before);
		$before 			= $this->status;
		$this->status		= $myFilter->process($before);
	}


	function getData($db)
	{
         $this->op_id	 		= $this->data['op_id'];   
         $this->requestid		= $this->data['requestid'];   
	     $this->tgl_op			= $this->data['tgl_op'];
	     $this->user_id			= $this->data['user_id'];
	     $this->group_id	 	= $this->data['group_id'];
	     $this->tgl_approve		= $this->data['tgl_approve'];
	     $this->tgl_approve2	= $this->data['tgl_approve2'];
	     $this->status			= $this->data['status'];
	     
		require_once("account.php");
		$account = new Account;
		if ($account->getAccountID($this->user_id,$db)) 
		   $this->realname = $account->kry_name;		

		require_once("group_user.php");
		$groupuser = new GroupUser;
		if ($groupuser->getGroupUser($this->group_id,$db)) 
		   $this->group_name = $groupuser->group_name;		
	}

	function existMasterOP($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where op_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getMasterOP($txt_id,$db) 
    {
       if (! $this->existMasterOP($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }


	function delMasterOP($txt_id,$db) 
	{
       if ($this->existMasterOP($txt_id,$db)) {
	       $sqlstr = "delete from $this->tablename where op_id='".safeString($txt_id)."'";
   		   if (!$result = mysql_query($sqlstr,$db))  {
	    	   $this->error = mysql_error();    
			}
							  
   	       if (! $result) { 
    	      return False;
	    	} else { 
		      return True;
		    }  
	   } else {
	       $this->error = "Data is not exist";
	       return False;
	   }
	}


	function saveMasterOP($db) 
	{   
	  $this->filterMasterOP();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existMasterOP($this->op_id,$db)) {
  	         $sqlstr = "update $this->tablename set requestid='".safeString($this->requestid)."',
			  tgl_op='".safeString($this->tgl_op)."',
			  user_id='".safeString($this->user_id)."',
			  group_id='".safeString($this->group_id)."',
			  tgl_approve='".safeString($this->tgl_approve)."',
			  status='".safeString($this->status)."'
		        where op_id='".safeString($this->op_id)."'";
	       } else {
  	          $sqlstr = "insert into $this->tablename(requestid,tgl_op,user_id,group_id,status) 
		        values ('".safeString($this->requestid)."',
				'".safeString($this->tgl_op)."',
				'".safeString($this->user_id)."',
				'".safeString($this->group_id)."',
		        '".safeString($this->status)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->op_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 

	function saveStatus($db) 
	{   
	  $this->filterMasterOP();   
	  if ($this->cekVariabelStatus($db))  {
		  if ($this->existMasterOP($this->op_id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  tgl_approve='".safeString(date("Y-m-d"))."',
			  status='".safeString($this->status)."'
		        where op_id='".safeString($this->op_id)."'";
	           if (!$result = mysql_query($sqlstr,$db)) 
			       $this->error = mysql_error();    
	           if (! $result) { 
		          return False;
			   } else { 
		      	  return True;
  		       }  

		  }
       }
	} 

	function saveStatusDireksi($db) 
	{   
	  $this->filterMasterOP();   
	  if ($this->cekVariabelStatus($db))  {
		  if ($this->existMasterOP($this->op_id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  tgl_approve2='".safeString(date("Y-m-d"))."',
			  status='".safeString($this->status)."'
		        where op_id='".safeString($this->op_id)."'";
	           if (!$result = mysql_query($sqlstr,$db)) 
			       $this->error = mysql_error();    
	           if (! $result) { 
		          return False;
			   } else { 
		      	  return True;
  		       }  

		  }
       }
	} 

	function saveStatus2($db) 
	{   
		  if ($this->existMasterOP($this->op_id,$db)) {
  	         $sqlstr = "update $this->tablename set 
			  status='".safeString($this->status)."'
		        where op_id='".safeString($this->op_id)."'";
	           if (!$result = mysql_query($sqlstr,$db)) 
			       $this->error = mysql_error();    
	           if (! $result) { 
		          return False;
			   } else { 
		      	  return True;
  		       }  
		  } else {
  	          $this->error = "OP not exist in database";    
	          return False;
		  }
	} 

}

?>