<?php
class Admin_m extends MY_Model{

  function uploaddata($insert){
    ini_set('max_execution_time', 0);
    $this->db->query("delete from admin");
    $this->db->insert_batch('admin', $insert);
    $value = $this->db->affected_rows();
    return $value;
  }

  function simpanadmin($admin){
    $now = new DateTime();
    $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $today=$now->format('Y-m-d H:i:s');
    $today1=$now->format('Y-m-d');       

    $data = array(
        'admin'      => $admin,
        'createdAt'   => $today,
        'createdBy'   => getSession('user')                                    
    );
    $this->db->insert('admin', $data);  
    $value = $this->db->affected_rows();
    if ($value>0) {
      $data = array(
        'proses'  => 'INPUT TERM OF PAYMENT',
        'note'    => $admin,
        'user'    => getSession('user'),
        'tgl'     => $today1
      );
      $this->db->insert('log', $data);  
    }
    return $value;
  }  

  function getdataadmin($nama){
    $carinama = "";
    if ($nama!='' or $nama!=null) {
      $carinama = " AND top like '%".$nama."%'";
    }

    $data = null;
    $sql = "SELECT * FROM admin WHERE 1=1";
    $query = $this->db->query($sql.$carinama." and isdeleted=0 ORDER BY top");
    foreach ($query->result() as $key => $row) {
      $data[] = $row;
    }
    return $data;
  }

  function getadminbyidadmin($noindex){
    $data = null;
    $query = $this->db->query("SELECT * FROM admin WHERE noindex='".$noindex."'");
    foreach ($query->result() as $key => $row) {
      $data[] = $row;
    }
    return $data;
  }

  function cariadmin($admin){
    $data = null;
    $cariadmin='';
    if ($admin!='') {
      $cariadmin=" and admin like '%".$admin."%'";
    }
    $sql = "SELECT * FROM admin WHERE isDeleted=0";
    $query = $this->db->query($sql.$cariadmin);
    foreach ($query->result() as $key => $row) {
      $data[] = $row;
    }
    return $data;
  }

  function updateadmin($id1,$admin1){
    $now = new DateTime();
    $now->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $today=$now->format('Y-m-d H:i:s');
    $today1=$now->format('Y-m-d');       

    $data = array(
        'admin'      => $admin1,
        'updatedAt'   => $today,
        'updatedBy'   => getSession('user')                                    
    );
    $this->db->update('admin', $data, array('noindex' => $id1));  
    $value = $this->db->affected_rows();
    if ($value>0) {
      $data = array(
        'proses'  => 'EDIT TERM OF PAYMENT',
        'note'    => $admin1,
        'user'    => getSession('user'),
        'tgl'     => $today1
      );
      $this->db->insert('log', $data);  
    }
    return $value;
  }  

  function deleteadmin($id2,$admin2,$alasan){    
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
    $this->db->update('admin', $data, array('noindex' => $id2));      
    $value = $this->db->affected_rows();
    if ($value>0) {
      $data = array(
        'proses'  => 'HAPUS TERM OF PAYMENT',
        'note'    => $admin2,
        'user'    => getSession('user'),
        'tgl'     => $today
      );
      $this->db->insert('log', $data);  
    }
    return $value;
  }    

  function cetakadmin(){
    $data = null;
    $query = $this->db->query("SELECT * FROM admin where isDeleted=0 order by admin");
    foreach ($query->result() as $key => $row) {
      $data[] = $row;
    }
    return $data;
  }

}
?>