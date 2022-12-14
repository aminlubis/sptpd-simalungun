<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        /*breadcrumb default*/
        // $this->breadcrumbs->push('Home', 'main');

        if($this->session->userdata('logged')!=TRUE){
            redirect(base_url().'login');
        }
        
    }

    public function index() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'main/'.strtolower(get_class($this)));
        $data = array(
            'title' => 'Home',
            'subtitle' => 'Welcome Amin',
        );
        // echo '<pre>';print_r($this->session->all_userdata());die;
        $this->template->load($data, 'dashboard');
    }

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

