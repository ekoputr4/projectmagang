<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model{
    
    public function member_login(){
        // session_start();
        $param = $this->input->post();
		$this->db->where('username',$param['userid']);
        $this->db->where('password',$param['password']);
        // $this->db->where('hp',$param['hp']);
		$this->db->from('karyawan');
        $exec = $this->db->get();
        
        $panjangacak = 5;
        $base="ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789";
        $max=strlen($base)-1;
        $acak="";
        mt_srand((double)microtime()*1000000);
        while (strlen($acak)<$panjangacak)
        $acak.=$base[mt_rand(0,$max)];
  
        if($exec->num_rows() == 1 ){
            $datau = $exec->result();
            foreach ($datau as $row) {
                $kopeg = $row->noref;
                $user = $row->username;
                $namapegawai = $row->nama;
                $pass = $row->password;
                $hp = $row->hp;
                $mrole = $row->role;
                $urut = $row->username.$acak;
                $status = $row->status;
                $statrab = $row->statrab;
                $koordinator = $row->koordinator;
                $dept = $row->dept; 
                $status = $row->status; 
                $updatepswd = $row->updatepswd; 
                $updatepswdx = $row->updatepswd;                                 
                if($status==1){
                    $namastatus='Super Admin';
                }elseif($status==2){
                    $namastatus='Admin';
                }elseif($status==3){
                    $namastatus='User';                    
                }
                // $whcode='';
                // $query = $this->db->query("SELECT taccwhlocation.wh_code FROM dept inner join taccwhlocation on dept.wh_id=taccwhlocation.wh_id where dept.deptid='".$dept."'");
                // foreach ($query->result() as $rowdep) {
                //    $whcode = $rowdep->wh_code;
                // } 
            }

            // $datalogin= array('urut'=>$urut, 'user'=>$user, 'password'=>$pass, 'status'=>$status, 'pdept'=>$dept, 'pstatus'=>$status, 'namastatus'=>$namastatus, 'statrab'=>$statrab, 'koordinator'=>$koordinator);
            // if($datalogin){
            //     $this->session->set_userdata('sess_cbham', $datalogin);
            //     if($this->session->userdata('sess_cbham')){
            //         redirect('dashboard');
            //     }    
            // }else{
            //     redirect('login');
            // }     

            // if (null !== $today) {
            //     $diff = $today->diff($dob);
            //     return $diff->y .' Year';
            // }

            $today=date('Y-m-d');
            $today = new DateTime($today);
            $updatepswd = new DateTime($updatepswd);
            $lama = $today->diff($updatepswd)->days;                

            // if($pass!='123456'){
            //     if($lama < 60){
                    $datalogin= array('urut'=>$urut, 'user'=>$user, 'password'=>$pass, 'status'=>$status, 'pdept'=>$dept, 'pstatus'=>$status, 'namastatus'=>$namastatus, 'kopeg'=>$kopeg, 'hp'=>$hp, 'namapegawai'=>$namapegawai, 'mrole'=>$mrole);
                    if($datalogin){
                        $this->session->set_userdata('sess_cbham', $datalogin);
                        if($this->session->userdata('sess_cbham')){
                            redirect('dashboard');
                        }    
                    }else{
                        redirect('login');
                    }     
            //     }else{
            //         $this->session->set_flashdata('flash_msg', err_msg('<strong>Login gagal., </strong>Password Anda terakhir diupdate pada tanggal '.$updatepswdx.' sudah lebih dari 60 hari, demi keamanan data silahkan ganti password Anda terlebih dulu. <a data-toggle="modal" href="#modalgantipasswd">Klik disini untuk update Password</a>'));
            //         redirect($_SERVER['HTTP_REFERER']);                
            //     }
            // }else{
            //     $this->session->set_flashdata('flash_msg', err_msg('<strong>Login gagal., </strong>Password Anda masih standar, demi keamanan data silahkan ganti password Anda terlebih dulu. <a data-toggle="modal" href="#modalgantipasswd">Klik disini untuk update Password</a>'));
            //     redirect($_SERVER['HTTP_REFERER']);                
            // }            
        } else {
            $this->session->set_flashdata('flash_msg', err_msg('<strong>Login gagal., </strong>Silahkan masukkan username dan password dengan benar'));
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
    
    public function is_login(){
        if(!$this->session->userdata('sess_cbham') && $this->uri->segment(1)!='login'){
            $this->session->set_flashdata('flash_msg', warn_msg('<strong>Silahkan login terlebih dahulu'));
            redirect('login');
        }
           
    }   

    function cekpass($kopeg,$username,$passlama){
        $query = $this->db->query("select count(noref) as jum from karyawan where noref='".$kopeg."' and username='".$username."' and password='".$passlama."' and isDeleted=0");
        foreach ($query->result() as $key => $row) {
            $jum = $row->jum;
        }
        return $jum;
    }

    function cekuser($kopeg,$username){
        $query = $this->db->query("select count(noref) as jum from karyawan where noref='".$kopeg."' and username='".$username."' and isDeleted=0");
        foreach ($query->result() as $key => $row) {
            $jum = $row->jum;
        }
        return $jum;
    }

    function cekpassuser($kopeg,$username){
        $query = $this->db->query("select * from karyawan where noref='".$kopeg."' and username='".$username."' and isDeleted=0");
        return $query->result();
    }

    function simpanupdpass($kopeg,$username,$passlama,$passbaru,$passbaruulang){
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $today=$now->format('Y-m-d');          
        $cekin=$now->format('H:i:s');
        $today1=$now->format('Y-m-d H:i:s');

        $query = $this->db->query("select * from karyawan where noref=?",array($kopeg));    
        foreach ($query->result() as $row) {
            $hp = $row->hp;            
        }

        $data = array(
            'password'    => $passbaru,
            'updatedAt'   => $today1,
            'updatedBy'   => $username,
            'updatepswd'  => $today
        );
        $this->db->update('karyawan', $data, array('noref' => $kopeg,'username' => $username));  

        return $hp;
    }  

    public function is_admin($menu=NULL){
        
        $sess = $this->session->userdata('sess_cbham');
        if($sess->role!='admin'){
            if($menu)
            {
                return FALSE;
                die();
            }
            $this->session->set_flashdata('flash_msg', err_msg('Anda tidak berhak mengakses halaman tersebut'));
            redirect('/');
        }
        if($menu)
        {
            return TRUE;
            die();
        }
    }

    public function member_logout(){
        $this->db->delete('tampungbeli', array('user' => getSession('user')));  
        $this->db->delete('tampungitem', array('user' => getSession('user')));  
        $this->db->delete('tampungitemsp', array('user' => getSession('user')));   
    }
    
    
}