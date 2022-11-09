<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verifikasi extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'verifikasi/Verifikasi');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Verifikasi_model', 'Verifikasi');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        $this->title = 'Verifikasi';
    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('verifikasi/Verifikasi/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Verifikasi/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Verifikasi->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Verifikasi/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        // echo '<pre>';print_r($data);die;
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('verifikasi/Verifikasi/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Verifikasi/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Verifikasi->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('verifikasi/Verifikasi/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Verifikasi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">'.$no.'</div>';
            $txt_nopd = (empty($row_list->nopd))?'<span style="font-weight: bold; color: red; font-style: italic">Belum diverifikasi</span>':'<b>'.$row_list->nopd.'</b>';
            $row[] = '<div class="center">'.$txt_nopd.'</div>';
            $row[] = strtoupper($row_list->nama_usaha).'<br>No. Telp : '.$row_list->telp;
            $row[] = $row_list->noizinusaha.'<br>'.$this->tanggal->formatDateFormDmy($row_list->tanggal_awal_usaha).' s/d '.$this->tanggal->formatDateFormDmy($row_list->tanggal_akhir_usaha);
            $row[] = $row_list->jenisusaha;
            $row[] = $this->tanggal->formatDateFormDmy($row_list->tanggal_daftar);
            $row[] = $row_list->alamat_usaha.', '.$row_list->kodepos_usaha;
            $row[] = $row_list->nama_kecamatan;
            $row[] = $row_list->nama_kelurahan;
            if($row_list->is_verified == 1){

            }
            $row[] = '<div class="center"><a href="#" onclick="getMenu('."'verifikasi/Verifikasi/form/".$row_list->id_izin_usaha."'".')" class="btn btn-xs btn-primary"><i class="fa fa-search"></i> Verifikasi Data</a></div>';
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Verifikasi->count_all(),
                        "recordsFiltered" => $this->Verifikasi->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function process()
    {
        // print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('verifikasi_data', 'Jenis Pajak', 'trim|required');
        $val->set_rules('verifikasi_dokumen', 'Jenis Pajak', 'trim|required');

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;

            $verifikasi_data = array(
                'is_verified' => $this->regex->_genRegex($val->set_value('verifikasi_data'), 'RGXINT'),
            );

            // generate NOPD
            $format_nopd = $this->Verifikasi->getNopd();
            

            $verifikasi_dokumen = array(
                'nopd' => $this->regex->_genRegex($format_nopd, 'RGXQSL'),
                'is_verified' => $this->regex->_genRegex($val->set_value('verifikasi_dokumen'), 'RGXINT'),
            );

            $this->db->where('npwpd', $_POST['npwpd'])->update('wajibpajak', $verifikasi_data);
            $this->db->where('id_izin_usaha', $_POST['id'])->update('objek_pajak', $verifikasi_dokumen);
            
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

    public function delete()
    {
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Verifikasi->delete_by_id($toArray)){
                $this->logs->save('Verifikasi', $id, 'delete record', '', 'level_id');
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));

            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }


}


/* End of file example.php */
/* Location: ./application/modules/example/controllers/example.php */
