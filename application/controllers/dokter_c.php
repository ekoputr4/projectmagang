<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokter_c extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('dokter_m');
    }

    function index() {
        $data['title'] = 'Dokter';
        $this->xajax->register(XAJAX_FUNCTION, array('simpandokter',&$this,'simpandokter'));   
        $this->xajax->register(XAJAX_FUNCTION, array('editdokter',&$this,'editdokter'));           
        $this->xajax->register(XAJAX_FUNCTION, array('hapusdokter',&$this,'hapusdokter'));   
        $this->xajax->register(XAJAX_FUNCTION, array('deletedokter',&$this,'deletedokter'));   
        $this->xajax->register(XAJAX_FUNCTION, array('caridokter',&$this,'caridokter'));                
        $this->xajax->processRequest();
        $data['datadokter'] = $this->dokter_m->getdatadokter(''); 
        $data['xajax_js'] = $this->xajax->getJavascript();
        $this->template->displayutama('master/dokter/dokter_v', $data);
    }

    function simpandokter($noindex,$nik,$nama,$kelamin,$alamat,$hp,$email,$tgllahir){
        $objResponse = new xajaxResponse();
        if ($nik==''||$nama==''||$alamat==''||$hp=='') {
            if($nik==''){
                $objResponse->script("alert('No NIK Belum Di Isi !')");
            }elseif($nama==''){
                $objResponse->script("alert('Nama Belum Di Isi !')");
            }elseif($alamat==''){
                $objResponse->script("alert('Alamat Belum Di Isi !')");                
            }elseif($hp==''){
                $objResponse->script("alert('No.HP/WA Belum Di Isi !')");                                
            }
        } else {
            $data = $this->dokter_m->simpandokter($noindex,$nik,$nama,$kelamin,$alamat,$hp,$email,$tgllahir);
            if ($data>0) {                
                $objResponse->script("alert('Simpan Berhasil')");
                $objResponse->script("$('#tambah').modal('hide')");
                $html = '';
                $no=0;
                $data = $this->dokter_m->getdatadokter(''); 
                foreach ($data as $row) {
                    $no++;
                    $html = $html."<tr>
                                    <td style='text-align:center'>".$no."</td>
                                    <td style='text-align:center'>".$row->noref."</td>
                                    <td>".$row->nama."</td>
                                    <td>".$row->nik."</td>
                                    <td>".$row->kelamin."</td>
                                    <td>".$row->alamat."</td>
                                    <td>".$row->hp."</td>
                                    <td>".$row->email."</td>
                                    <td>".$row->tgllahir."</td>
                                    <td style='text-align:center'><a class='btn mini yellow sbold' data-toggle='modal' href='#tambah' onClick='editdokter(".$row->noindex.")'><i class='icon-edit'></i> Edit </a>
                                        <a class='btn mini red' data-toggle='modal' href='#delete' onClick='hapusdokter(".$row->noindex.")'><i class='icon-trash'></i> Hapus </a>
                                    </td>
                                </tr>";
                }
                $objResponse->Assign("datadokter","innerHTML",$html);
            } else {
                $objResponse->script("alert('Data Gagal Disimpan')");
            }
        }
        return $objResponse;
    }

    function caridokter($dokter){
        $objResponse = new xajaxResponse();
        $data = $this->dokter_m->caridokter($dokter); 
        $html='';
        $no=0;
        if (count($data)>0) { 
            foreach ($data as $row) {
                $no++;
                $html = $html."<tr>
                                    <td style='text-align:center'>".$no."</td>
                                    <td style='text-align:center'>".$row->noref."</td>
                                    <td>".$row->nama."</td>
                                    <td>".$row->nik."</td>
                                    <td>".$row->kelamin."</td>
                                    <td>".$row->alamat."</td>
                                    <td>".$row->hp."</td>
                                    <td>".$row->email."</td>
                                    <td>".$row->tgllahir."</td>
                                    <td style='text-align:center'><a class='btn mini yellow sbold' data-toggle='modal' href='#tambah' onClick='editdokter(".$row->noindex.")'><i class='icon-edit'></i> Edit </a>
                                        <a class='btn mini red' data-toggle='modal' href='#delete' onClick='hapusdokter(".$row->noindex.")'><i class='icon-trash'></i> Hapus </a>
                                    </td>
                            </tr>";
            }
        } else {
            $html = $html."<tr><td colspan='3'>Data Tidak Ada</td></tr>";
        }
        $objResponse->Assign("datadokter","innerHTML",$html);
        return $objResponse;
    }
   
    function editdokter($noindex){
        $objResponse = new xajaxResponse();
        $data = $this->dokter_m->getdokterbyiddokter($noindex);
        foreach ($data as $row) {
            $objResponse->Assign("noindex","value",$row->noindex);
            $objResponse->Assign("nik","value",$row->nik);
            $objResponse->Assign("nama","value",$row->nama);
            $objResponse->Assign("kelamin","value",$row->kelamin);
            $objResponse->Assign("alamat","value",$row->alamat);
            $objResponse->Assign("hp","value",$row->hp);
            $objResponse->Assign("email","value",$row->email);
            $objResponse->Assign("tgllahir","value",$row->tgllahir);                 
        }
        return $objResponse;
    }

    function hapusdokter($noindex){
        $objResponse = new xajaxResponse();
        $data = $this->dokter_m->getdokterbyiddokter($noindex);
        foreach ($data as $row) {
            $objResponse->Assign("id2","value",$row->noindex);
            $objResponse->Assign("dokter2","value",$row->nama);
        }
        return $objResponse;
    }

    function deletedokter($id2,$dokter2,$alasan){
        $objResponse = new xajaxResponse();
        $data = $this->dokter_m->deletedokter($id2,$dokter2,$alasan);
        if ($data>0) {
            $objResponse->script("alert('Hapus Berhasil')");
            $objResponse->script("$('#delete').modal('hide')");
            $objResponse->Assign("id2","value","");
            $objResponse->Assign("dokter2","value","");
            $objResponse->Assign("alasan","value","");
            $html='';
            $no=0;
            $data = $this->dokter_m->getdatadokter('');
            foreach ($data as $row) {
                $no++;
                $html = $html."<tr>
                                    <td style='text-align:center'>".$no."</td>
                                    <td style='text-align:center'>".$row->noref."</td>
                                    <td>".$row->nama."</td>
                                    <td>".$row->nik."</td>
                                    <td>".$row->kelamin."</td>
                                    <td>".$row->alamat."</td>
                                    <td>".$row->hp."</td>
                                    <td>".$row->email."</td>
                                    <td>".$row->tgllahir."</td>
                                    <td style='text-align:center'><a class='btn mini yellow sbold' data-toggle='modal' href='#tambah' onClick='editdokter(".$row->noindex.")'><i class='icon-edit'></i> Edit </a>
                                        <a class='btn mini red' data-toggle='modal' href='#delete' onClick='hapusdokter(".$row->noindex.")'><i class='icon-trash'></i> Hapus </a>
                                    </td>
                            </tr>";
            }
            $objResponse->Assign("datadokter","innerHTML",$html);
        } else {
            $objResponse->script("alert('Data dokter ".$dokter2." Gagal Di Hapus')");
        }
        return $objResponse;
    }  

    function cetakdokter() {
         $this->load->library('fpdf');
         define('FPDF_FONTPATH',$this->config->item('fonts_path'));
         $data['dataku'] = $this->dokter_m->cetakdokter();
         $this->load->view('master\dokter\cetakdokter', $data);
    }

}
?>