<?php 
class MY_Model extends CI_Model{
	function __construct(){
        parent::__construct();
	}
	function __get($property){
		if(property_exists($this, $property)) {
	      return $this->$property;
	    }
	    if($property == 'db'){
	   		$CI =& get_instance();
	   		if(isset($CI->db)){
	   			return $CI->db;
	   		}
	   		$CI->load->database();
	    	return $CI->db;
	    }
	    if($pt = parent::__get($property)){
	    	return $pt;
	    }
	}
    
    function protect($str){
        return "'".$this->db->escape_str($str)."'";
    }

    function protectlike($str){
        return "'%".$this->db->escape_str($str)."%'";
    }
}