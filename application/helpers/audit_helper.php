<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function uri($ke){
    $CI =& get_instance();
    return $CI->uri->segment($ke);
}

function warn_msg($data)
{
	return "<div class='alert alert-block'><button data-dismiss='alert' class='close'></button><h4 class='alert-heading'>Warning!</h4>".$data."</div>";
}

function succ_msg($data)
{
	return "<div class='alert alert-success alert-block'><button data-dismiss='alert' class='close'></button><h4 class='alert-heading'>Success!</h4>".$data."</div>";
}

function err_msg($data)
{
	return '<div class="alert alert-error alert-block"><button data-dismiss="alert" class="close"></button><h4 class="alert-heading">Error!</h4>'.$data.'</div>';
}

function button($text,$class=NULL,$size=NULL,$color=NULL,$stripe=NULL)
{
	echo '<button class="btn '.$size.' '.$color.' '.$stripe.' '.$class.'" type="button">'.$text.'</button>';
}

function del($url,$jenis,$nama,$size=NULL)
{
	echo '<button class="btn '.$size.' yellow busek" type="button" data-url="'.$url.'" data-jenis="'.$jenis.'" data-nama="'.$nama.'"><i class="icon-trash"></i>&nbsp;Hapus</button>';
}

function modal_delete($modal_id, $modal_true_action)
{
    $modal = '<div id="'.$modal_id.'" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-body"><p>Apakah anda yakin menghapus data ini ?</p></div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn">Batal</button>
                <a href="' . $modal_true_action . '" class="btn red">Lanjutkan</a>
            </div>
          </div>';      
    return $modal;
}

function url($text,$url,$size=NULL,$color=NULL,$icon=NULL,$stripe=NULL)
{
	if($icon)
	$icon = '<i class="'.$icon.'"></i>&nbsp;';
	echo '<a class="btn '.$size.' '.$color.' '.$stripe.'" href="'.$url.'">'.$icon.$text.'</a>';
}

function curURL()
{
	 $pageURL = 'http';
	 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}

function curCname()
{
    $CI =& get_instance();
    $url ='';
    $url  = $CI->router->fetch_directory().$CI->router->fetch_class();
    $url = strtolower($url);
    return $url;
}

function curCM()
{
    $CI =& get_instance();
    //return $CI->uri->uri_string();
    return $CI->uri->segment(1).'/'.$CI->uri->segment(2);
}

function changeDateFormat($format,$date)
{
	switch($format)
	{
		case "database":
			return date('Y-m-d',strtotime($date));
			break;
		case "webview":
			return date('d-m-Y',strtotime($date));
			break;
		case "datepicker":
			return date('d/m/Y',strtotime($date));
			break;
	}
		
}

/*function paging($url,$total,$perpage = NULL)
{
	$ci =& get_instance();
	$ci->load->library('mypagination');

	$config['base_url'] = @$url;
	$config['num_links'] =3;
	$config['total_rows'] = @$total;
	$config['per_page'] = @$perpage ? $perpage : 5 ;
	$config['use_page_numbers'] = TRUE;
	
	$config['full_tag_open'] = '<div class="pagination pagination-right">';
	$config['full_tag_close'] = '</ul></div>';
	
	$config['first_link'] = 'Awal';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';

	$config['last_link'] = 'Akhir';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';

	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';

	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';

	$ci->mypagination->initialize($config);

	return $ci->mypagination->create_links();
}*/
function paging($cname, $totalrow, $limit, $uri="3", $force_cur='', $prefix='', $suffix=''){
    $CI =& get_instance();
    $CI->load->library('Mypagination');
    $config['base_url'] = base_url().$cname;
    $config['total_rows'] = $totalrow;
    $config['per_page'] = $limit;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['first_link'] = '<<';
    $config['last_link'] = '>>';
    $config['prev_link'] = '<';
    $config['next_link'] = '>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close']= '</li>';
    $config['num_links'] = 3;
    $config['force_cur'] = $force_cur;
    $config['prefix'] = '';
    $config['suffix'] = '';
    $config['uri_segment'] = $uri;
    $config['cur_tag_open'] = '<li class="active"><a><strong>';
    $config['cur_tag_close'] = '</strong></a></li>';
    $CI->mypagination->initialize($config);
    return $CI->mypagination->create_links();
}

function encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
} 

function show_paging($paging=false, $totalrow=false){
    if($totalrow){

        $totalrow= '<p id="dynamic_pager_content1" class="well">Total '.$totalrow.'  Data</p>';
    }
    if($paging){
        echo '<div>'.$totalrow.'<div id="dynamic_pager_demo1" class="pagination"><ul class="bootpag"><li class>'.$paging.'</ul></div></div>';    
    } else {
        echo '<div>'.$totalrow.'</div>';
    }
}


function romanNumerals($num) 
{
    $n = intval($num);
    $res = '';
 
    /*** roman_numerals array  ***/
    $roman_numerals = array(
                'M'  => 1000,
                'CM' => 900,
                'D'  => 500,
                'CD' => 400,
                'C'  => 100,
                'XC' => 90,
                'L'  => 50,
                'XL' => 40,
                'X'  => 10,
                'IX' => 9,
                'V'  => 5,
                'IV' => 4,
                'I'  => 1);
 
    foreach ($roman_numerals as $roman => $number) 
    {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
 
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
 
        /*** substract from the number ***/
        $n = $n % $number;
    }
 
    /*** return the res ***/
    return $res;
    }

 

 function getName($nopeg)
 {
 	$CI =& get_instance();
    $CI->db->select('nama');
    $CI->db->from('petugas');
    $CI->db->where('nopeg',$nopeg);
    return $CI->db->get()->row('nama');
 }

 function getUnit($nopeg)
 {
    $CI =& get_instance();
    $CI->db->select('unit');
    $CI->db->from('petugas');
    $CI->db->where('nopeg',$nopeg);
    return $CI->db->get()->row('unit');
 }

 function getDesc($id,$type)
 {
    $CI =& get_instance();
    switch ($type) {
        case 'lokasi':
            $CI->db->select('lokasi');
            $CI->db->from('m_lokasi');
            $CI->db->where('id_lokasi',$id);
            $ret = $CI->db->get()->row('lokasi');
            return $ret ? $ret : '';
            break;
        case 'pekerjaan':
            $CI->db->select('pekerjaan');
            $CI->db->from('m_pekerjaan');
            $CI->db->where('id_pekerjaan',$id);
            $ret = $CI->db->get()->row('pekerjaan');
            return $ret ? $ret : '';
            break;
        case 'station':
            $CI->db->select('station');
            $CI->db->from('m_station');
            $CI->db->where('id_station',$id);
            $ret = $CI->db->get()->row('station');
            return $ret ? $ret : '';
            break;
    }    
 }

 
 function getName2($nopeg)
 {
    $CI =& get_instance();
    $CI->dbku = $CI->load->database('default', true);
    $CI->dbku->select('nama');
    $CI->dbku->from('petugas');
    $CI->dbku->where('nopeg',$nopeg);
    $ret = $CI->dbku->get()->row('nama');
    return $ret ? $ret : 'Nama Tidak Ditemukan';
 }   

function writeLog($loc=NULL,$content)
{
	$CI =& get_instance();
	$sess = $CI->session->userdata('sess_smkonline');
	$data = array(
			'waktu' => date('Y-m-d H:i:s'),
			'nopeg' => $sess->nopeg,
			'lokasi' => $loc,
			'aktivitas' => $content,
		);
	
	$CI->db->insert('log_transaksi',$data);
}

//----------------------------- Ms.Excel Function
function xlsBOF() {
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
    return;
}

function xlsEOF() {
    echo pack("ss", 0x0A, 0x00);
    return;
}

function xlsWriteNumber($Row, $Col, $Value) {
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
    echo pack("d", $Value);
    return;
}

function xlsWriteLabel($Row, $Col, $Value ) {
    $L = strlen($Value);
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
    echo $Value;
    return;
}

function xlsWriteString( $Row , $Col , $Value ){
    $L = strlen( $Value );
    echo pack( "ssssss" , 0x204 , 8 + $L , $Row , $Col , 0x0 , $L );
    echo $Value;
    return;
}

function keys_to_lower($o) {
    if (is_object($o)) {
        $o = (array)$o;
    }
    if (is_array($o)) {
        return array_map('keys_to_lower', array_change_key_case($o));
    }
    else {
        return $o;
    }
}

function check_fiscal_year($date)
{
    $CI =& get_instance();      
    $CI->load->model('m_fiscal');
    
    $fiscalYear = $CI->m_fiscal->get_lock_fiscal();

        $dateSplitted = explode("-", $date);
        $year = $dateSplitted[0];
        if(in_array($year, $fiscalYear))
        {
            // echo $year . "lock";
            return false;
        }
        else
        {
            return true;
            // echo $year . "unlock";
        }
    # code...
}

function agk2hrf($str){
    switch ($str) {
        case 1 : $ans = 'A'; break;
        case 2 : $ans = 'B'; break;
        case 3 : $ans = 'C'; break;
        case 4 : $ans = 'D'; break;
        case 5 : $ans = 'E'; break;
        case 6 : $ans = 'F'; break;
        case 7 : $ans = 'G'; break;
        case 8 : $ans = 'H'; break;
        case 9 : $ans = 'I'; break;
        case 10 : $ans = 'J'; break;
        case 11 : $ans = 'K'; break;
        case 12 : $ans = 'L'; break;
        case 13 : $ans = 'M'; break;
        case 14 : $ans = 'N'; break;
        case 15 : $ans = 'O'; break;
        case 16 : $ans = 'P'; break;
        case 17 : $ans = 'Q'; break;
        case 18 : $ans = 'R'; break;
        case 19 : $ans = 'S'; break;
        case 20 : $ans = 'T'; break;
        case 21 : $ans = 'U'; break;
        case 22 : $ans = 'V'; break;
        case 23 : $ans = 'W'; break;
        case 24 : $ans = 'X'; break;
        case 25 : $ans = 'Y'; break;
        case 26 : $ans = 'Z'; break;
        case 27 : $ans = 'AA'; break;
        case 28 : $ans = 'AB'; break;
        case 29 : $ans = 'AC'; break;
        case 30 : $ans = 'AD'; break;
        case 31 : $ans = 'AE'; break;
        case 32 : $ans = 'AF'; break;
        case 33 : $ans = 'AG'; break;
        case 34 : $ans = 'AH'; break;
        case 35 : $ans = 'AI'; break;
        case 36 : $ans = 'AJ'; break;
        case 37 : $ans = 'AK'; break;
        case 38 : $ans = 'AL'; break;
        case 39 : $ans = 'AM'; break;
        case 40 : $ans = 'AN'; break;
        case 41 : $ans = 'AO'; break;
        case 42 : $ans = 'AP'; break;
        case 43 : $ans = 'AQ'; break;
        case 44 : $ans = 'AR'; break;
        case 45 : $ans = 'AS'; break;
        case 46 : $ans = 'AT'; break;
        case 47 : $ans = 'AU'; break;
        case 48 : $ans = 'AV'; break;
        case 49 : $ans = 'AW'; break;
        case 50 : $ans = 'AX'; break;
        case 51 : $ans = 'AY'; break;
        case 52 : $ans = 'AZ'; break;
        default: $ans = $str; break;
    }
    return $ans;
}