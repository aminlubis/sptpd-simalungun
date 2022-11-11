<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attachment extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        //$this->breadcrumbs->push('Index', 'templates/'.get_class($this).'');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'Login');exit;
        }
        /*load model*/
        $this->load->model('attachment_model');
        /*enable profiler*/
        $this->output->enable_profiler(false);

    }

    public function download(){
        $file = $this->db->get_where('t_fileattachment', array('refid' => $_GET['refno'], 'reftable' => $_GET['refname']))->row();
        if(!empty($file)){
            $data['value'] = $file;
            $this->load->view('download_view', $data);
        }else{
            echo 'Tidak ada file ditemukan';
        }
    }

}


/* End of file templates.php */
/* Location: ./application/modules/templates/controllers/templates.php */
