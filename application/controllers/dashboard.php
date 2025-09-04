<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->helper('rumus');
        // $this->load->model('bpc_m');
    }

    function index() {
        $data['title'] = '';
        $this->xajax->processRequest();
        // $data['dept'] = $this->bpc_m->getdeptall();
        $data['xajax_js'] = $this->xajax->getJavascript();

        // $dept=$this->input->post("dept");
        // if ($dept==''){
        //     $data['datarkap'] = $this->bpc_m->getdatarkap(''); 
        //     $data['dataonhand'] = $this->bpc_m->getdataonhand('');
        //     $data['dataretail'] = $this->bpc_m->getdataretail('');
        //     $data['datamustwin'] = $this->bpc_m->getdatamustwin('');
        //     $data['datawip'] = $this->bpc_m->getdatawip('');
        //     $data['dataul'] = $this->bpc_m->getdataul('');

        //     $data['datarkapjan'] = $this->bpc_m->getdatarkapjan(''); 
        //     $data['dataohjan'] = $this->bpc_m->getdataohjan('');
        //     $data['datartjan'] = $this->bpc_m->getdatartjan('');
        //     $data['datamwjan'] = $this->bpc_m->getdatamwjan('');
        //     $data['datawipjan'] = $this->bpc_m->getdatawipjan('');
        //     $data['datauljan'] = $this->bpc_m->getdatauljan('');

        //     $data['datarkapfeb'] = $this->bpc_m->getdatarkapfeb(''); 
        //     $data['dataohfeb'] = $this->bpc_m->getdataohfeb(''); 
        //     $data['datartfeb'] = $this->bpc_m->getdatartfeb('');
        //     $data['datamwfeb'] = $this->bpc_m->getdatamwfeb('');
        //     $data['datawipfeb'] = $this->bpc_m->getdatawipfeb('');
        //     $data['dataulfeb'] = $this->bpc_m->getdataulfeb('');

        //     $data['datarkapmar'] = $this->bpc_m->getdatarkapmar(''); 
        //     $data['dataohmar'] = $this->bpc_m->getdataohmar(''); 
        //     $data['datartmar'] = $this->bpc_m->getdatartmar('');
        //     $data['datamwmar'] = $this->bpc_m->getdatamwmar('');
        //     $data['datawipmar'] = $this->bpc_m->getdatawipmar('');
        //     $data['dataulmar'] = $this->bpc_m->getdataulmar('');

        //     $data['datarkapapr'] = $this->bpc_m->getdatarkapapr(''); 
        //     $data['dataohapr'] = $this->bpc_m->getdataohapr(''); 
        //     $data['datartapr'] = $this->bpc_m->getdatartapr('');
        //     $data['datamwapr'] = $this->bpc_m->getdatamwapr('');
        //     $data['datawipapr'] = $this->bpc_m->getdatawipapr('');
        //     $data['dataulapr'] = $this->bpc_m->getdataulapr('');

        //     $data['datarkapmei'] = $this->bpc_m->getdatarkapmei(''); 
        //     $data['dataohmei'] = $this->bpc_m->getdataohmei(''); 
        //     $data['datartmei'] = $this->bpc_m->getdatartmei('');
        //     $data['datamwmei'] = $this->bpc_m->getdatamwmei('');
        //     $data['datawipmei'] = $this->bpc_m->getdatawipmei('');
        //     $data['dataulmei'] = $this->bpc_m->getdataulmei('');

        //     $data['datarkapjun'] = $this->bpc_m->getdatarkapjun(''); 
        //     $data['dataohjun'] = $this->bpc_m->getdataohjun(''); 
        //     $data['datartjun'] = $this->bpc_m->getdatartjun('');
        //     $data['datamwjun'] = $this->bpc_m->getdatamwjun('');
        //     $data['datawipjun'] = $this->bpc_m->getdatawipjun('');
        //     $data['datauljun'] = $this->bpc_m->getdatauljun('');

        //     $data['datarkapjul'] = $this->bpc_m->getdatarkapjul(''); 
        //     $data['dataohjul'] = $this->bpc_m->getdataohjul(''); 
        //     $data['datartjul'] = $this->bpc_m->getdatartjul('');
        //     $data['datamwjul'] = $this->bpc_m->getdatamwjul('');
        //     $data['datawipjul'] = $this->bpc_m->getdatawipjul('');
        //     $data['datauljul'] = $this->bpc_m->getdatauljul('');

        //     $data['datarkapagt'] = $this->bpc_m->getdatarkapagt(''); 
        //     $data['dataohagt'] = $this->bpc_m->getdataohagt(''); 
        //     $data['datartagt'] = $this->bpc_m->getdatartagt('');
        //     $data['datamwagt'] = $this->bpc_m->getdatamwagt('');
        //     $data['datawipagt'] = $this->bpc_m->getdatawipagt('');
        //     $data['dataulagt'] = $this->bpc_m->getdataulagt('');

        //     $data['datarkapsep'] = $this->bpc_m->getdatarkapsep(''); 
        //     $data['dataohsep'] = $this->bpc_m->getdataohsep(''); 
        //     $data['datartsep'] = $this->bpc_m->getdatartsep('');
        //     $data['datamwsep'] = $this->bpc_m->getdatamwsep('');
        //     $data['datawipsep'] = $this->bpc_m->getdatawipsep('');
        //     $data['dataulsep'] = $this->bpc_m->getdataulsep('');

        //     $data['datarkapokt'] = $this->bpc_m->getdatarkapokt(''); 
        //     $data['dataohokt'] = $this->bpc_m->getdataohokt(''); 
        //     $data['datartokt'] = $this->bpc_m->getdatartokt('');
        //     $data['datamwokt'] = $this->bpc_m->getdatamwokt('');
        //     $data['datawipokt'] = $this->bpc_m->getdatawipokt('');
        //     $data['dataulokt'] = $this->bpc_m->getdataulokt('');

        //     $data['datarkapnov'] = $this->bpc_m->getdatarkapnov(''); 
        //     $data['dataohnov'] = $this->bpc_m->getdataohnov(''); 
        //     $data['datartnov'] = $this->bpc_m->getdatartnov('');
        //     $data['datamwnov'] = $this->bpc_m->getdatamwnov('');
        //     $data['datawipnov'] = $this->bpc_m->getdatawipnov('');
        //     $data['dataulnov'] = $this->bpc_m->getdataulnov('');

        //     $data['datarkapdes'] = $this->bpc_m->getdatarkapdes(''); 
        //     $data['dataohdes'] = $this->bpc_m->getdataohdes(''); 
        //     $data['datartdes'] = $this->bpc_m->getdatartdes('');
        //     $data['datamwdes'] = $this->bpc_m->getdatamwdes('');
        //     $data['datawipdes'] = $this->bpc_m->getdatawipdes('');
        //     $data['datauldes'] = $this->bpc_m->getdatauldes('');

        //     $data['datatabel'] = $this->bpc_m->getdatatabel('');

        //     $data['datareal2020'] = $this->bpc_m->getdatareal2020('');
        //     $data['datareal2021'] = $this->bpc_m->getdatareal2021('');
        //     $data['databb'] = $this->bpc_m->getdatabb('');

        //     $data['databbbsp'] = $this->bpc_m->getdatabbbsp('');
        //     $data['databbbpc'] = $this->bpc_m->getdatabbbpc('');
        //     $data['databbbm'] = $this->bpc_m->getdatabbbm('');
        //     $data['databbbg'] = $this->bpc_m->getdatabbbg('');

        //     $data['datarkapbsp'] = $this->bpc_m->getdatarkapbsp('');
        //     $data['datarkapbpc'] = $this->bpc_m->getdatarkapbpc('');
        //     $data['datarkapbm'] = $this->bpc_m->getdatarkapbm('');
        //     $data['datarkapbg'] = $this->bpc_m->getdatarkapbg('');
        // }else{
        //     $data['datarkap'] = $this->bpc_m->getdatarkapdept($dept); 
        //     $data['dataonhand'] = $this->bpc_m->getdataonhanddept($dept);
        //     $data['dataretail'] = $this->bpc_m->getdataretaildept($dept);
        //     $data['datamustwin'] = $this->bpc_m->getdatamustwindept($dept);
        //     $data['datawip'] = $this->bpc_m->getdatawipdept($dept);
        //     $data['dataul'] = $this->bpc_m->getdatauldept($dept);

        //     $data['datarkapjan'] = $this->bpc_m->getdatarkapjandept($dept); 
        //     $data['dataohjan'] = $this->bpc_m->getdataohjandept($dept);
        //     $data['datartjan'] = $this->bpc_m->getdatartjandept($dept);
        //     $data['datamwjan'] = $this->bpc_m->getdatamwjandept($dept);
        //     $data['datawipjan'] = $this->bpc_m->getdatawipjandept($dept);
        //     $data['datauljan'] = $this->bpc_m->getdatauljandept($dept);

        //     $data['datarkapfeb'] = $this->bpc_m->getdatarkapfebdept($dept); 
        //     $data['dataohfeb'] = $this->bpc_m->getdataohfebdept($dept); 
        //     $data['datartfeb'] = $this->bpc_m->getdatartfebdept($dept);
        //     $data['datamwfeb'] = $this->bpc_m->getdatamwfebdept($dept);
        //     $data['datawipfeb'] = $this->bpc_m->getdatawipfebdept($dept);
        //     $data['dataulfeb'] = $this->bpc_m->getdataulfebdept($dept);

        //     $data['datarkapmar'] = $this->bpc_m->getdatarkapmardept($dept); 
        //     $data['dataohmar'] = $this->bpc_m->getdataohmardept($dept); 
        //     $data['datartmar'] = $this->bpc_m->getdatartmardept($dept); 
        //     $data['datamwmar'] = $this->bpc_m->getdatamwmardept($dept); 
        //     $data['datawipmar'] = $this->bpc_m->getdatawipmardept($dept); 
        //     $data['dataulmar'] = $this->bpc_m->getdataulmardept($dept); 

        //     $data['datarkapapr'] = $this->bpc_m->getdatarkapaprdept($dept); 
        //     $data['dataohapr'] = $this->bpc_m->getdataohaprdept($dept); 
        //     $data['datartapr'] = $this->bpc_m->getdatartaprdept($dept); 
        //     $data['datamwapr'] = $this->bpc_m->getdatamwaprdept($dept); 
        //     $data['datawipapr'] = $this->bpc_m->getdatawipaprdept($dept); 
        //     $data['dataulapr'] = $this->bpc_m->getdataulaprdept($dept); 

        //     $data['datarkapmei'] = $this->bpc_m->getdatarkapmeidept($dept); 
        //     $data['dataohmei'] = $this->bpc_m->getdataohmeidept($dept); 
        //     $data['datartmei'] = $this->bpc_m->getdatartmeidept($dept); 
        //     $data['datamwmei'] = $this->bpc_m->getdatamwmeidept($dept); 
        //     $data['datawipmei'] = $this->bpc_m->getdatawipmeidept($dept); 
        //     $data['dataulmei'] = $this->bpc_m->getdataulmeidept($dept); 

        //     $data['datarkapjun'] = $this->bpc_m->getdatarkapjundept($dept); 
        //     $data['dataohjun'] = $this->bpc_m->getdataohjundept($dept); 
        //     $data['datartjun'] = $this->bpc_m->getdatartjundept($dept); 
        //     $data['datamwjun'] = $this->bpc_m->getdatamwjundept($dept); 
        //     $data['datawipjun'] = $this->bpc_m->getdatawipjundept($dept); 
        //     $data['datauljun'] = $this->bpc_m->getdatauljundept($dept); 

        //     $data['datarkapjul'] = $this->bpc_m->getdatarkapjuldept($dept); 
        //     $data['dataohjul'] = $this->bpc_m->getdataohjuldept($dept); 
        //     $data['datartjul'] = $this->bpc_m->getdatartjuldept($dept); 
        //     $data['datamwjul'] = $this->bpc_m->getdatamwjuldept($dept); 
        //     $data['datawipjul'] = $this->bpc_m->getdatawipjuldept($dept); 
        //     $data['datauljul'] = $this->bpc_m->getdatauljuldept($dept); 

        //     $data['datarkapagt'] = $this->bpc_m->getdatarkapagtdept($dept); 
        //     $data['dataohagt'] = $this->bpc_m->getdataohagtdept($dept); 
        //     $data['datartagt'] = $this->bpc_m->getdatartagtdept($dept); 
        //     $data['datamwagt'] = $this->bpc_m->getdatamwagtdept($dept); 
        //     $data['datawipagt'] = $this->bpc_m->getdatawipagtdept($dept); 
        //     $data['dataulagt'] = $this->bpc_m->getdataulagtdept($dept); 

        //     $data['datarkapsep'] = $this->bpc_m->getdatarkapsepdept($dept); 
        //     $data['dataohsep'] = $this->bpc_m->getdataohsepdept($dept); 
        //     $data['datartsep'] = $this->bpc_m->getdatartsepdept($dept); 
        //     $data['datamwsep'] = $this->bpc_m->getdatamwsepdept($dept); 
        //     $data['datawipsep'] = $this->bpc_m->getdatawipsepdept($dept); 
        //     $data['dataulsep'] = $this->bpc_m->getdataulsepdept($dept); 

        //     $data['datarkapokt'] = $this->bpc_m->getdatarkapoktdept($dept); 
        //     $data['dataohokt'] = $this->bpc_m->getdataohoktdept($dept); 
        //     $data['datartokt'] = $this->bpc_m->getdatartoktdept($dept); 
        //     $data['datamwokt'] = $this->bpc_m->getdatamwoktdept($dept); 
        //     $data['datawipokt'] = $this->bpc_m->getdatawipoktdept($dept); 
        //     $data['dataulokt'] = $this->bpc_m->getdatauloktdept($dept); 

        //     $data['datarkapnov'] = $this->bpc_m->getdatarkapnovdept($dept); 
        //     $data['dataohnov'] = $this->bpc_m->getdataohnovdept($dept); 
        //     $data['datartnov'] = $this->bpc_m->getdatartnovdept($dept); 
        //     $data['datamwnov'] = $this->bpc_m->getdatamwnovdept($dept); 
        //     $data['datawipnov'] = $this->bpc_m->getdatawipnovdept($dept); 
        //     $data['dataulnov'] = $this->bpc_m->getdataulnovdept($dept); 

        //     $data['datarkapdes'] = $this->bpc_m->getdatarkapdesdept($dept); 
        //     $data['dataohdes'] = $this->bpc_m->getdataohdesdept($dept); 
        //     $data['datartdes'] = $this->bpc_m->getdatartdesdept($dept); 
        //     $data['datamwdes'] = $this->bpc_m->getdatamwdesdept($dept); 
        //     $data['datawipdes'] = $this->bpc_m->getdatawipdesdept($dept); 
        //     $data['datauldes'] = $this->bpc_m->getdatauldesdept($dept); 

        //     $data['datatabel'] = $this->bpc_m->getdatatabeldept($dept); 

        //     $data['datareal2020'] = $this->bpc_m->getdatareal2020dept($dept); 
        //     $data['datareal2021'] = $this->bpc_m->getdatareal2021dept($dept); 
        //     $data['databb'] = $this->bpc_m->getdatabbdept($dept); 

        //     $data['databbbsp'] = $this->bpc_m->getdatabbbsp('');
        //     $data['databbbpc'] = $this->bpc_m->getdatabbbpc('');
        //     $data['databbbm'] = $this->bpc_m->getdatabbbm('');
        //     $data['databbbg'] = $this->bpc_m->getdatabbbg('');

        //     $data['datarkapbsp'] = $this->bpc_m->getdatarkapbsp('');
        //     $data['datarkapbpc'] = $this->bpc_m->getdatarkapbpc('');
        //     $data['datarkapbm'] = $this->bpc_m->getdatarkapbm('');
        //     $data['datarkapbg'] = $this->bpc_m->getdatarkapbg('');
        // }

        $this->template->displayutama('dashboard', $data);        
    }
    
}