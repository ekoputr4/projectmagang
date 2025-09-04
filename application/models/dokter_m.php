<?php
class Dokter_m extends MY_Model{

  function simpandokter($noindex,$nik,$nama,$kelamin,$alamat,$hp,$email,$tgllahir){
    $now = new DateTime();
    $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $today=$now->format('Y-m-d H:i:s');
    $today1=$now->format('Y-m-d');  
    $data = null;     

    if($noindex==''){

      $query = $this->db->query("select max(noref) as norefmax from dokter order by noref");
      foreach ($query->result() as $key => $row) {
          $data = $row->norefmax;
      }        
      $thn=date('Y');
      $thn=substr($thn,2,2);
      $thn='D'.$thn;
      if ($data!=null) {            
          $norefmax = substr($data, 3,6);            
          $nomor = $norefmax + 1;
          if ($nomor < 10) {
              $nomor = $thn.'00000'.$nomor;
          } else if ($nomor < 100) {
              $nomor = $thn.'0000'.$nomor;
          } else if ($nomor < 1000) {
              $nomor = $thn.'000'.$nomor;                
          } else if ($nomor < 10000) {
              $nomor = $thn.'00'.$nomor;                                
          } else if ($nomor < 100000) {
              $nomor = $thn.'0'.$nomor;                                                
          } else {
              $nomor = $thn.$nomor;                
          }
      } else {
          $nomor = $thn.'000001';                
      }                               

      $data = array(
          'noref'       => $nomor,        
          'nik'         => $nik,        
          'nama'        => $nama,        
          'kelamin'     => $kelamin,        
          'alamat'      => $alamat,        
          'hp'          => $hp,        
          'email'       => $email,        
          'tgllahir'    => $tgllahir,        
          'createdAt'   => $today,
          'createdBy'   => getSession('user')                                    
      );
      $this->db->insert('dokter', $data);  
      $value = $this->db->affected_rows();
      if ($value>0) {
        $data = array(
          'proses'  => 'INPUT DOKTER',
          'note'    => $nama,
          'user'    => getSession('user'),
          'tgl'     => $today1
        );
        $this->db->insert('log', $data);  
      }
    }else{
      $data = array(  
          'nik'         => $nik,        
          'nama'        => $nama,        
          'kelamin'     => $kelamin,        
          'alamat'      => $alamat,        
          'hp'          => $hp,        
          'email'       => $email,        
          'tgllahir'    => $tgllahir,        
          'updatedAt'   => $today,
          'updatedBy'   => getSession('user')                                    
      );
      $this->db->update('dokter', $data, array('noindex' => $noindex));  
      $value = $this->db->affected_rows();
      if ($value>0) {
        $data = array(
          'proses'  => 'EDIT DOKTER',
          'note'    => $nama,
          'user'    => getSession('user'),
          'tgl'     => $today1
        );
        $this->db->insert('log', $data);  
      }
    }
    return $value;
  }  

  function getdatadokter($nama){
    $carinama = "";
    if ($nama!='' or $nama!=null) {
      $carinama = " AND nama like '%".$nama."%'";
    }

    $sql = "SELECT * FROM dokter WHERE 1=1";
    $query = $this->db->query($sql.$carinama." and isdeleted=0 ORDER BY nama");
    return $query->result();
  }

  function getdokterbyiddokter($noindex){
    $query = $this->db->query("SELECT * FROM dokter WHERE noindex='".$noindex."'");
    return $query->result();
  }

  function caridokter($dokter){
    $caridokter='';
    if ($dokter!='') {
      $caridokter=" and nama like '%".$dokter."%'";
    }
    $sql = "SELECT * FROM dokter WHERE isDeleted=0";
    $query = $this->db->query($sql.$caridokter);
    return $query->result();
  }

  function deletedokter($id2,$dokter2,$alasan){    
    $now = new DateTime();
    $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $today=$now->format('Y-m-d H:i:s');
    $today1=$now->format('Y-m-d');       

    $data = array(
        'isDeleted'   => 1,
        'alasan'      => $alasan,
        'deletedAt'   => $today,
        'deletedBy'   => getSession('user')                                    
    );
    $this->db->update('dokter', $data, array('noindex' => $id2));      
    $value = $this->db->affected_rows();
    if ($value>0) {
      $data = array(
        'proses'  => 'HAPUS DOKTER',
        'note'    => $dokter2,
        'user'    => getSession('user'),
        'tgl'     => $today
      );
      $this->db->insert('log', $data);  
    }
    return $value;
  }    

  function cetakdokter(){
    $data = null;
    $query = $this->db->query("SELECT * FROM dokter where isDeleted=0 order by nama");
    return $query->result();
  }

}
?>