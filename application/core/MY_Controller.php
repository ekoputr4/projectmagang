<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cbham_helper');
        $this->load->model('M_auth','auth');
		// //$this->output->enable_profiler();
        $this->auth->is_login();
		$this->sess = $this->session->userdata('sess_cbham');
        // $this->accdenied(curCM());
    }
	
	function restrict($param = array())
    {
        if(!in_array($this->sess->level, $param))
        {
            $this->session->set_flashdata('flash_msg', err_msg('Anda tidak berhak mengakses halaman tersebut.'));
            redirect('dashboard');
        }
    }

    function accdenied($param)
    {
        if(in_array($param,$this->sess->denied_url))
        {
            $this->session->set_flashdata('flash_msg', err_msg('Anda tidak berhak mengakses halaman tersebut.'));
            redirect('dashboard');
        }
    }
    
    function protect($str){
        return "'".$this->db->escape_str($str)."'";
    }

    function protectlike($str){
        return "'%".$this->db->escape_str($str)."%'";
    }
}