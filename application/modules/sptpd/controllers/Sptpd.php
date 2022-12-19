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

        // echo '<pre>';print_r($this->session->all_userdata());die;

        $this->load->view('sptpd/Sptpd/index', $data);
    }
    

    public function form() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Sptpd/'.strtolower(get_class($this)));
        $profil_wp = $this->Register->get_by_id($this->session->userdata('user')->noktp);
         $data = array(
            'title' => 'Form SPTPD',
            'subtitle' => COMPANY,
            'profil_wp' => $profil_wp,
            'objek_pajak' => $this->Sptpd->get_objek_pajak($profil_wp->npwpd),
        );
        // echo '<pre>';print_r($data);die;
        $this->load->view('sptpd/Sptpd/form', $data);
        
    }

    public function changeForm($kodejenispajak) {

        $data = [];
        $id_hop = isset($_GET['id_hop'])?$_GET['id_hop']:[];
        $data['pajak'] = $this->db->get_where('jenispajak', array('kodejenispajak' => $kodejenispajak))->row();
        $data['value'] = $this->Sptpd->get_data_by_jenis_pajak($id_hop, $kodejenispajak);
        $html = $this->load->view('sptpd/Sptpd/form_'.$kodejenispajak.'', $data, true);
        echo json_encode(array('html' => $html));
        
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Sptpd->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">'.$no.'</div>'; 
            $row[] = '<div class="center">'.$row_list->id_hop.'</div>';
            $row[] = '<div class="center">'.$row_list->noobjekpajak.'</div>';
            $row[] = strtoupper($row_list->nama_usahaop);
            $row[] = $row_list->periode_awal;
            $row[] = $row_list->periode_akhir;
            // $row[] = $row_list->va_bayar;
            $row[] = '<div style="text-align: right">'.number_format($row_list->omset).'</div>';
            $row[] = '<div style="text-align: right">'.number_format($row_list->pajakterutang).'</div>';
            $row[] = '<div style="text-align: center"><a href="'.base_url().'Templates/Attachment/download?refno='.$row_list->id_hop.'&refname=history_objek_pajak" target="_blank">Download File</a></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Sptpd->count_all(),
                        "recordsFiltered" => $this->Sptpd->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // pajak hotel
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
                'kodejenispajak' => $this->regex->_genRegex( 1 , 'RGXINT'),
                'nama_usahaop' => $this->regex->_genRegex( $_POST['nama_usaha_op'] , 'RGXQSL'),
                'periode_awal' => $this->regex->_genRegex( $_POST['periodeawal'] , 'RGXQSL'),
                'periode_akhir' => $this->regex->_genRegex( $_POST['periodeakhir'] , 'RGXQSL'),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang') , 'RGXINT'),
                'waktu_sptpd' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
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


             // upload attachment
             if(isset($_FILES['file']['name'])){
                $config = array(
                    'reftable' => 'history_objek_pajak',
                    'refid' => $nosptpd,
                    'jenis' => 'SPTPD',
                    'npwpd' => $this->input->post('npwpd'),
                    'noktp' => $this->input->post('noktp'),
                ); 
                $this->upload_file->process_upload_blob($config);
            }

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

    // pajak restoran
    public function process_2()
    {
        
        $this->load->library('form_validation');
        $val = $this->form_validation;
        
        $val->set_rules('bayarmakanan', 'Makanan', 'trim|numeric');
        $val->set_rules('bayarminum', 'Minuman', 'trim|numeric');
        $val->set_rules('byrmakanminum', 'Makanan & Minuman', 'trim|numeric');
        $val->set_rules('byrnasikotak', 'Nasi Kotak', 'trim|numeric');
        $val->set_rules('byrpelayanan', 'Pelayanan', 'trim|numeric');
        $val->set_rules('byrlainnya', 'Pembayaran Lainnya', 'trim|numeric');
        $val->set_rules('ttlomset', 'Total Omset', 'trim|numeric');
        // default
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
            // print_r($_FILES);die;

            // history objek pajak
            $hop = array(
                'noobjekpajak' => $this->regex->_genRegex( $_POST['nopd'] , 'RGXQSL'),
                'kodejenispajak' => $this->regex->_genRegex( 2 , 'RGXINT'),
                'nama_wajibpajak' => $this->regex->_genRegex( $_POST['namawajibpajak'] , 'RGXQSL'),
                'nama_usahaop' => $this->regex->_genRegex( $_POST['nama_usaha_op'] , 'RGXQSL'),
                'periode_awal' => $this->regex->_genRegex( $_POST['periodeawal'] , 'RGXQSL'),
                'periode_akhir' => $this->regex->_genRegex( $_POST['periodeakhir'] , 'RGXQSL'),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang') , 'RGXINT'),
                'waktu_sptpd' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                'omset' => $this->regex->_genRegex( $val->set_value('ttlomset') , 'RGXINT'),
            );
            $this->db->insert('history_objek_pajak', $hop);
            $id_hop = $this->db->insert_id();

            $nosptpd = $id_hop;

            $dataexc = array(
                'nosptpd' => $this->regex->_genRegex( $nosptpd , 'RGXINT'),
                'tglsetor' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                // sptpd restoran
                'bayarmakanan' => $this->regex->_genRegex( $val->set_value('bayarmakanan'), 'RGXQSL' ),
                'bayarminum' => $this->regex->_genRegex( $val->set_value('bayarminum'), 'RGXQSL' ),
                'byrmakanminum' => $this->regex->_genRegex( $val->set_value('byrmakanminum'), 'RGXQSL' ),
                'byrnasikotak' => $this->regex->_genRegex( $val->set_value('byrnasikotak'), 'RGXQSL' ),
                'byrpelayanan' => $this->regex->_genRegex( $val->set_value('byrpelayanan'), 'RGXQSL' ),
                'byrlainnya' => $this->regex->_genRegex( $val->set_value('byrlainnya'), 'RGXQSL' ),
                'totalbayar' => $this->regex->_genRegex( $val->set_value('ttlomset'), 'RGXQSL' ),
                'dpp' => $this->regex->_genRegex( $val->set_value('dpp'), 'RGXQSL' ),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang'), 'RGXQSL' ),
                // default
                'dpp' => $this->regex->_genRegex( $val->set_value('dpp') , 'RGXINT'),
                'trfpajak' => $this->regex->_genRegex( $val->set_value('trfpajak') , 'RGXINT'),
                'pajakterutang' => $this->regex->_genRegex( $val->set_value('pajakterutang') , 'RGXINT'),
                'tglsistem' => $this->regex->_genRegex( date('Y-m-d H:i:s') , 'RGXQSL'),
                'id_hop' => $this->regex->_genRegex( $nosptpd , 'RGXINT'),
            );

            $this->db->insert('sptpdrestoran', $dataexc);

            // upload attachment
            if(isset($_FILES['file']['name'])){
                $config = array(
                    'reftable' => 'history_objek_pajak',
                    'refid' => $nosptpd,
                    'jenis' => 'SPTPD',
                    'npwpd' => $this->input->post('npwpd'),
                    'noktp' => $this->input->post('noktp'),
                ); 
                $this->upload_file->process_upload_blob($config);
            }


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

    public function download_file($id_hop){
        $file = $this->db->get_where('t_fileattachment', array('refid' => $_GET['refno'], 'reftable' => $_GET['refname']))->row();
        if(!empty($file)){
            $data['value'] = $file;
            $this->load->view('sptpd/Sptpd/download_view', $data);
        }else{
            echo 'Tidak ada file ditemukan';
        }
    }


    

    

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

