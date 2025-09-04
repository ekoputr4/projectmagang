<?
/*
  Write : Onix
  Last Modified : October 11, 2008
*/

class Account
{

    var $user_id,$user_name,$old_user_name,$password,$confirm,$kry_id,$lvl_id,$new;
	var $lvl_cuti,$lvl_procurement,$group_id;
	var $kry_name,$lvl_name;
	var $data,$error;
	var $good_fields = array();
	var $pass_fields;
    var $tablename = "user";
	
	function cekVariabel($db)
	{
       require_once("validation_class.php");
		
  	   $example = new Validate_fields;
	   $example->add_num_field("Karyawan", $this->kry_id, "number", "y", 0, 0, 1);
	   $example->add_text_field("Nama User", $this->user_name, "text", "y", 20, 3);
	   $example->add_num_field("Group", $this->group_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Level", $this->lvl_id, "number", "y", 0, 0, 1);
	   $example->add_num_field("Level Cuti", $this->lvl_cuti, "number", "y", 0, 0, 1);
	   $example->add_num_field("Level Procurement", $this->lvl_procurement, "number", "y", 0, 0, 1);
	   if ($example->validation()) {
	   	   if ($this->old_user_name!='admin' && $this->user_name!='admin')	{ 
		   		if ($this->old_user_name == $this->user_name){
			       return True;
				} else {			 
					if ($this->existAccount($this->user_name,$db)) {
				       $this->error = "Nama user telah digunakan user lain.";
					   $this->old_user_name = '';
						return False;
					} else {		        
				        return True;
					}
			   }
		   } else {
		       $this->error = "Administrator tidak bisa diubah. Hanya password yang bisa anda ubah";
		       return False;		   
		   }	   
       } else {
	       $this->error = $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
  	} 


   function cekPassword()
   {
       require_once("validation_class.php");
      	$cek = 0;         	
	   	if ($this->password!=$this->confirm){
   			$cek = 1;
		   $this->error .= "Password dan Konfirmasi harus sama.\\n";   	
	   	}
		
  	   $example = new Validate_fields;
	   $example->add_text_field("Password", $this->password, "text", "y", 30, 6);
	   $example->add_text_field("Konfirmasi", $this->confirm, "text", "y", 30, 6);
	   if ($example->validation()) {	       
	   		if ($cek==0)
   				return True;
	   		else {
			   $this->good_fields = $example->good_fields;
   		   		return False;
			}
       } else {
	       $this->error .= $example->create_msg();
		   $this->good_fields = $example->good_fields;
		   return False;
       }	   	
   	
   }

	function filterAccount()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 				= $this->user_name;
		$this->user_name		= $myFilter->process($before);
		$before 				= $this->kry_id;
		$this->kry_id			= $myFilter->process($before);
		$before 				= $this->lvl_id;
		$this->lvl_id			= $myFilter->process($before);
		$before 				= $this->lvl_cuti;
		$this->lvl_cuti			= $myFilter->process($before);
		$before 				= $this->lvl_procurement;
		$this->lvl_procurement	= $myFilter->process($before);
		$before 				= $this->group_id;
		$this->group_id			= $myFilter->process($before);
	}

	function filterPassword()
	{
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 			= $this->password;
		$this->password		= $myFilter->process($before);
		$before 			= $this->confirm;
		$this->confirm		= $myFilter->process($before);
	}

	function getData($db)
	{
         $this->user_id	 		= $this->data['user_id']; 
         $this->kry_id	 		= $this->data['kry_id'];   
	     $this->user_name		= $this->data['user_name'];
	     $this->old_user_name	= $this->data['user_name'];
	     $this->password 		= $this->data['password'];
	     $this->lvl_id			= $this->data['lvl_id'];
	     $this->group_id		= $this->data['group_id'];
	     $this->lvl_cuti		= $this->data['lvl_cuti'];
	     $this->lvl_procurement	= $this->data['lvl_procurement'];

		 $found = 0;
		 $included_files = get_required_files();
		 foreach ($included_files as $filename) {
		 	if (substr($filename,-18)=='class\karyawan.php' ||
			substr($filename,-18)=='class/karyawan.php') {
			   $found=1;
			   break;
			}   
		 }
		 if ($found==0)
			 require_once("karyawan.php");		
		 $karyawan	= new Karyawan;
		 $karyawan->getKaryawan($this->kry_id,$db);
		 $this->kry_name	= $karyawan->kry_name;		 

		 require_once("level_karyawan.php");
		 $level_karyawan	= new LevelKaryawan;
		 $level_karyawan->getLevelKaryawan($this->lvl_id,$db);
		 $this->lvl_name	= $level_karyawan->lvl_name;		 
//		 break;  
	}


	function existAccount($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where user_name='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getAccount($txt_id,$db) 
    {
       if (! $this->existAccount($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

	function existAccountID($txt_id,$db) 
	{
	   $sqlstr = "select * from $this->tablename where user_id='".safeString($txt_id)."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	       return True;
	   }
	}

    function getAccountID($txt_id,$db) 
    {
       if (! $this->existAccountID($txt_id,$db)) {
           return  False;
       } else {
	   	   $this->getData($db);
	       return True;
       }
	 }

    function loginAccount($txt_user,$txt_pass,$db) 
    {
		require_once("class.inputfilter.php");
		$tags = array();
		$attributes = array();

		$myFilter = new InputFilter($tags, $attributes, 0, 1); // more info on constructor in readme
		$before 		= $txt_user;
		$txt_user		= $myFilter->process($before);
		$before 		= $txt_pass;
		$txt_pass		= $myFilter->process($before);

	   $sqlstr = "select * from $this->tablename where user_name='".safeString($txt_user)."' 
	   	and password='".safeString(md5($txt_pass))."' limit 1";
       $result = mysql_query($sqlstr,$db);

       if (! $result)  $this->error = mysql_error();
       if (mysql_num_rows($result) == 0) {
           return False;
       } else {
	       $this->data = mysql_fetch_array($result);
	   	   $this->getData($db);
	       return True;
	   }
	}


	function delAccount($txt_id,$db) 
	{
       if ($this->existAccountID($txt_id,$db)) {
	     $this->user_name		= $this->data['user_name'];
		  if ($this->user_name!='admin') {
			   $sqlstr = "delete from $this->tablename where user_id='".safeString($txt_id)."'";
			   if (!$result = mysql_query($sqlstr,$db))  {
				   $this->error = mysql_error();    
				}
											  
			   if (! $result) { 
				  return False;
				} else { 
				  return True;
				}  
		  } else {
			   $this->error = "Admin tidak dapat dihapus";
			   return False;		  
		  }		
	   } else {
	       $this->error = "User tidak ditemukan";
	       return False;
	   }
	}

	function setPassword($db) 
	{
	  if ($this->existAccountID($this->user_id,$db)) {
         $sqlstr = "update $this->tablename set password='".safeString(md5($this->password))."'
	        where user_id='".safeString($this->user_id)."'";		 
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
		      return True;
		    }  
	  } else {
	  	 $this->error	= "User tidak ditemukan"; 
	  	 return False;
	  }
	}

	function savePassword($db) 
	{   
	  $this->filterPassword();   
	  if ($this->cekPassword())  {
		  return ($this->setPassword($db));
       } else {
	      return False;
	   }
	} 

	function saveAccount($db) 
	{   
	  $this->new = 0;
	  $this->filterAccount();   
	  if ($this->cekVariabel($db))  {
		  if ($this->existAccount($this->old_user_name,$db)) {
  	         $sqlstr = "update $this->tablename set user_name='".safeString($this->user_name)."',
			  group_id='".safeString($this->group_id)."',
			  lvl_id='".safeString($this->lvl_id)."',
			  lvl_cuti='".safeString($this->lvl_cuti)."',
			  lvl_procurement='".safeString($this->lvl_procurement)."',
			  kry_id='".safeString($this->kry_id)."'
		        where user_name='".safeString($this->old_user_name)."'";
	       } else {
		      $this->new = 1;
			 $sqlstr = "insert into $this->tablename(user_name,password,group_id,lvl_id,lvl_cuti,lvl_procurement,kry_id) 
		        values ('".safeString($this->user_name)."',
				'".safeString(md5($this->password))."',
		        '".safeString($this->group_id)."',
		        '".safeString($this->lvl_id)."',
		        '".safeString($this->lvl_cuti)."',
		        '".safeString($this->lvl_procurement)."',
		        '".safeString($this->kry_id)."')";
		    }
           if (!$result = mysql_query($sqlstr,$db))  {
		       $this->error = mysql_error();    }
           if (! $result) { 
	          return False;
		    } else { 
 			  $this->user_id = mysql_insert_id(); 
		      return True;
		    }  
       }
	} 
}

?>