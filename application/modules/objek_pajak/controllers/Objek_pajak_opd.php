<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Objek_pajak_opd extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'objek_pajak/Objek_pajak_opd');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Objek_pajak_opd_model', 'Objek_pajak_opd');
        $this->load->model('front/Register_model', 'Register');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        $this->title = 'Objek Pajak';
    }

    public function index() { 
        // echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('objek_pajak/Objek_pajak_opd/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Objek_pajak_opd/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Objek_pajak_opd->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Objek_pajak_opd/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        $profil_wp = $this->Register->get_by_id($this->session->userdata('user')->noktp);
		// Get the default view file for the module and return as a string.
    	$data['profil_wp'] = $profil_wp;
        // echo '<pre>';print_r($data);die;
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('objek_pajak/Objek_pajak_opd/form', $data);
    }
    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Objek_pajak_opd/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Objek_pajak_opd->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('objek_pajak/Objek_pajak_opd/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Objek_pajak_opd->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">'.$no.'</div>';
            $txt_nopd = ($row_list->is_verified != 1)?'<span style="font-weight: bold; color: red; font-style: italic">Belum diverifikasi</span>':'<b>'.$row_list->nopd.'</b>';
            $row[] = '<div class="center">'.$txt_nopd.'</div>';
            $row[] = strtoupper($row_list->nama_usaha).'<br>No. Telp : '.$row_list->telp;
            // $row[] = $row_list->noizinusaha.'<br>'.$this->tanggal->formatDateFormDmy($row_list->tanggal_awal_usaha).' s/d '.$this->tanggal->formatDateFormDmy($row_list->tanggal_akhir_usaha);
            $row[] = $row_list->jenisusaha;
            $row[] = $this->tanggal->formatDateFormDmy($row_list->tanggal_daftar);
            $row[] = $row_list->alamat_usaha.', '.$row_list->kodepos_usaha;
            $row[] = $row_list->nama_kecamatan;
            $row[] = $row_list->nama_kelurahan;
            $row[] = '<div class="center"><a href="#" onclick="getMenu('."'objek_pajak/Objek_pajak_opd/form/".$row_list->id_izin_usaha."'".')" class="btn btn-xs btn-success"><i class="fa fa-edit"></i>Ubah</a><a href="#" class="btn btn-xs btn-danger" onclick="delete_data('.$row_list->id_izin_usaha.')"><i class="fa fa-trash"></i> Hapus</a></div>';
            $row[] = '<div class="center"><a href="#" onclick="getMenu('."'sptpd/Sptpd_opd/form?id_izin_usaha=".$row_list->id_izin_usaha."'".')" class="btn btn-xs btn-primary"><i class="fa fa-send"></i> Entri SPTPD</a></div>';
            
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Objek_pajak_opd->count_all(),
                        "recordsFiltered" => $this->Objek_pajak_opd->count_filtered(),
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
        $val->set_rules('jenispajak', 'Jenis Pajak', 'trim|required');
        // $val->set_rules('jenisusaha', 'Jenis Usaha', 'trim|required');
        // $val->set_rules('noizinusaha', 'No Izin Usaha', 'trim|required');
        // $val->set_rules('tanggal_awal_usaha', 'Tanggal Berlaku Izin', 'trim|required');
        // $val->set_rules('tanggal_akhir_usaha', 'Jatuh Tempo Masa Berlaku Izin', 'trim|required');
        $val->set_rules('nama_usaha', 'Nama Usaha', 'trim|required');
        $val->set_rules('alamat_usaha', 'Alamat Usaha', 'trim|required');
        $val->set_rules('kecamatanHidden', 'Kecamatan', 'trim|required');
        $val->set_rules('kelurahanHidden', 'Kelurahan', 'trim|required', array('required' => 'Silahkan pilih Kelurahan kembali'));
        $val->set_rules('kodepos_usaha', 'Kelurahan', 'trim');
        $val->set_rules('telp', 'No. Telp', 'trim|required');

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

            // generate NOPD
            $config = array(
                'npwpd' => $_POST['npwpd'],
                'kodejenispajak' => $_POST['jenispajak'],
                'kode_kelurahan' => $_POST['kelurahanHidden'],
            );
            $format_nopd = $this->Objek_pajak_opd->getNopd($config);

            $dataexc = array(
                'nopd' => $this->regex->_genRegex($format_nopd, 'RGXQSL'),
                'npwpd' => $this->regex->_genRegex($_POST['npwpd'], 'RGXQSL'),
                'kodejenispajak' => $this->regex->_genRegex($val->set_value('jenispajak'), 'RGXQSL'),
                // 'idjenis_usaha' => $this->regex->_genRegex($val->set_value('jenisusaha'), 'RGXQSL'),
                'tanggal_daftar' => $this->regex->_genRegex(date('Y-m-d'), 'RGXQSL'),
                'nama_usaha' => $this->regex->_genRegex($val->set_value('nama_usaha'), 'RGXQSL'),
                'alamat_usaha' => $this->regex->_genRegex($val->set_value('alamat_usaha'), 'RGXQSL'),
                'kecamatan_usaha' => $this->regex->_genRegex($val->set_value('kecamatanHidden'), 'RGXQSL'),
                'kode_kelurahan' => $this->regex->_genRegex($val->set_value('kelurahanHidden'), 'RGXQSL'),
                'kodepos_usaha' => $this->regex->_genRegex($val->set_value('kodepos_usaha'), 'RGXQSL'),
                'telp' => $this->regex->_genRegex($val->set_value('telp'), 'RGXQSL'),
                'user_opd_id' => $this->regex->_genRegex($this->session->userdata('user')->id, 'RGXINT'),
                'is_verified' => 1
            );

            
            if($id==0){
                $newId = $this->Objek_pajak_opd->save($dataexc);
            }else{
                $this->Objek_pajak_opd->update(array('id_izin_usaha' => $id), $dataexc);
                $newId = $id;
            }
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan', 'id_izin_usaha' => $newId));
            }
        }
    }

    public function delete()
    {
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Objek_pajak_opd->delete_by_id($toArray)){
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
