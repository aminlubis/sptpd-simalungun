<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sptpd extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sptpd/Sptpd_model','Sptpd');
        $this->load->model('front/Register_model','Register');

    }

    public function index() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Sptpd/'.strtolower(get_class($this)));
         $data = array(
            'title' => COMPANY,
            'subtitle' => '',
            
        );

        $this->load->view('Sptpd/index', $data);
    }

    public function form() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Sptpd/'.strtolower(get_class($this)));
         $data = array(
            'title' => 'Form SPTPD',
            'subtitle' => COMPANY,
            'profil_wp' => $this->Register->get_by_id($this->session->userdata('user')->noktp),
            
        );

        $this->load->view('sptpd/Sptpd/form', $data);
        
    }

    public function changeForm($kodejenispajak) {

        $data = [];
        $data['pajak'] = $this->db->get_where('jenispajak', array('kodejenispajak' => $kodejenispajak))->row();
        $html = $this->load->view('sptpd/Sptpd/form_'.$kodejenispajak.'', $data, true);
        echo json_encode(array('html' => $html));
        
    }

    public function process_1()
    {
        
        $this->load->library('form_validation');
        $val = $this->form_validation;
        
        $val->set_rules('totalpembayarankamar', 'Omset Pembayaran Kamar', 'trim|required|numeric');
        $val->set_rules('totalbayarfasilitas', 'Omset Pembayaran Fasilitas', 'trim|required|numeric');
        $val->set_rules('ttlomset', 'Total Omset', 'trim|required|numeric');
        $val->set_rules('dpp', 'DPP', 'trim|required|numeric');
        $val->set_rules('pajakterutang', 'Pajak Terhutang', 'trim|required|numeric');

        

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->input->post('id'):0;
            // print_r($_POST);die;

            // history objek pajak
            $hop = array(
                'noobjekpajak' => $this->regex->_genRegex( $_POST['nopd'] , 'RGXQSL'),
                'nama_wajibpajak' => $this->regex->_genRegex( $_POST['namawajibpajak'] , 'RGXQSL'),
                'nama_usahaop' => $this->regex->_genRegex( $_POST['namausahaop'] , 'RGXQSL'),
                'periode_awal' => $this->regex->_genRegex( $_POST['periodeawal'] , 'RGXQSL'),
                'periode_akhir' => $this->regex->_genRegex( $_POST['periodeakhir'] , 'RGXQSL'),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang') , 'RGXINT'),
                'waktu_sptpd' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                'penetapan_pajak_official' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                'omset' => $this->regex->_genRegex( $val->set_value('ttlomset') , 'RGXINT'),
            );
            $this->db->insert('history_objek_pajak', $hop);
            $id_hop = $this->db->insert_id();

            $nosptpd = $id_hop;

            $dataexc = array(
                'nosptpd' => $this->regex->_genRegex( $nosptpd , 'RGXINT'),
                'tglsetor' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                'totalpembayarankamar' => $this->regex->_genRegex( $val->set_value('totalpembayarankamar') , 'RGXINT'),
                'totalbayarfasilitas' => $this->regex->_genRegex( $val->set_value('totalbayarfasilitas') , 'RGXINT'),
                'jlhpembayaran' => $this->regex->_genRegex( $val->set_value('ttlomset') , 'RGXINT'),
                'dpp' => $this->regex->_genRegex( $val->set_value('dpp') , 'RGXINT'),
                'trfpajak' => $this->regex->_genRegex( $val->set_value('trfpajak') , 'RGXINT'),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang') , 'RGXINT'),
                'tglsistem' => $this->regex->_genRegex( date('Y-m-d H:i:s') , 'RGXQSL'),
                'id_hop' => $this->regex->_genRegex( $nosptpd , 'RGXINT'),
            );

            $this->db->insert('sptpdhotel', $dataexc);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {

                $this->db->trans_commit();
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }
    }

    

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

