<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        session_start();
        parent::__construct();
        $this->load->model('m_auth');
    }

    function index() {
        if(!$this->session->userdata('sess_cbham')){
            $this->xajax->register(XAJAX_FUNCTION, array('simpanupdpass',&$this,'simpanupdpass'));
            $this->xajax->register(XAJAX_FUNCTION, array('simpanlupapass',&$this,'simpanlupapass'));
            $this->xajax->processRequest();
            $data['xajax_js'] = $this->xajax->getJavascript();            
            $this->load->view('login/login',$data);
        } else {
            redirect('/');
        }
    }

    function do_login() {
        if ($this->input->post()) {
            $this->load->model('M_auth', 'auth');
            $this->auth->member_login();
        }
    }

    function simpanupdpass($kopeg,$username,$passlama,$passbaru,$passbaruulang){
        $objResponse = new xajaxResponse();        
        $cekpass = $this->m_auth->cekpass($kopeg,$username,$passlama); 
        if($cekpass==1){            
            $hp = $this->m_auth->simpanupdpass($kopeg,$username,$passlama,$passbaru,$passbaruulang); 
            // if($data!=''){
                $token = "Fjo3sAYT73eeNEYjmhJNTFzKszpX2EkDrB4qyRmVBrPYrcoG62";
                if($hp!=''){
                    $message = "Username ".$username." dengan Password ".$passbaru." berhasil di Update. Lakukan pergantian password secara berkala untuk keamanan data";            
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_SSL_VERIFYHOST => 0,
                      CURLOPT_SSL_VERIFYPEER => 0,                                                          
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$hp.'&message='.$message,
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                }
                $objResponse->script("alert('Password Anda berhasil di Update, silahkan login ulang dengan password yang baru')"); 
            // }else{
            //     $objResponse->script("alert('Check-In Kunjungan Pelanggan di lokasi ini GAGAL, coba ulangi kembali')"); 
            // }
        }else{            
            $objResponse->script("alert('Maaf No.Badge, Username, dan Password Lama Anda tidak sesuai dengan database, cek kembali No.Badge, Username dan Password Lama Anda')");    
            $objResponse->script("$('#modalgantipasswd').modal('hide')");                
        }
        return $objResponse;                     
    }

    function simpanlupapass($kopeg,$username){
        $objResponse = new xajaxResponse();        
        $cekpass = $this->m_auth->cekuser($kopeg,$username); 
        if($cekpass==1){
            $data = $this->m_auth->cekpassuser($kopeg,$username); 
            foreach ($data as $row) {
                $token = "Fjo3sAYT73eeNEYjmhJNTFzKszpX2EkDrB4qyRmVBrPYrcoG62";
                if($row->hp!=''){
                    $message = "Username ".$username." Password Anda adalah ".$row->password.". Simpan dengan baik dan lakukan pergantian password secara berkala untuk keamanan data";            
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_SSL_VERIFYHOST => 0,
                      CURLOPT_SSL_VERIFYPEER => 0,                                    
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$row->hp.'&message='.$message,
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);
                }
                $objResponse->script("alert('Password berhasil di kirim via Whatsapp, silahkan cek notif WA Anda')"); 
            }
        }else{            
            $objResponse->script("alert('Maaf No.Badge dan Username Anda tidak sesuai dengan database, cek kembali No.Badge dan Username Anda')");    
            $objResponse->script("$('#modalgantipasswd').modal('hide')");                
            $objResponse->script("$('#modallupapswd').modal('hide')");
        }
        return $objResponse;                     
    }

    function registrasi() {
        $this->load->view('registrasi/registrasi');
    }

    function do_registrasi() {
        if ($this->input->post()) {
            $this->load->model('registrasi_m', 'auth');
            $this->auth->member_login();
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}