<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('front/Register_model','Register');

    }

    public function index() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Register/'.strtolower(get_class($this)));
         $data = array(
            'title' => COMPANY,
            'subtitle' => '',
            
        );

        $this->load->view('Register/index', $data);
        
    }

    public function form_register() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Register/'.strtolower(get_class($this)));
         $data = array(
            'title' => 'Form Registrasi',
            'subtitle' => COMPANY,
            
        );

        $this->load->view('Register/form', $data);
        
    }

    public function show_data(){
        $data = array(
           'keyword' => $_GET['key'],
           'value' => $this->Register->cekMember($_GET['key']),
       );
    //    echo '<pre>'; print_r($data);die;

       $this->load->view('Register/form_show_dt', $data);
   }

    public function form_cek_kta() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Register/'.strtolower(get_class($this)));
         $data = array(
            'title' => 'Form Registrasi',
            'subtitle' => COMPANY,
            'app' => $this->db->get_where('tmp_profile_app', array('id' => 1))->row(),
            
        );

        $this->load->view('Register/form_cek_kta', $data);
        
    }

    public function process()
    {
        // print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        
        if($_POST['tipe_anggota'] == 'old'){
            $val->set_rules('masa_aktif', 'Masa Aktif', 'trim|required' );
            $val->set_rules('no_kta_old', 'No KTA Lama', 'trim|required' );
            if (empty($_FILES['foto_kta_old']['name'])){
                $val->set_rules('foto_kta_old', 'Foto KTA Old', 'required', array('required' => 'Silahkan upload Foto KTA Lama') );
            }
        }
        
        $val->set_rules('no_identitas', 'No Identitas', 'trim|required');
        $val->set_rules('nama', 'Nama', 'trim|required');
        $val->set_rules('tmp_lhr', 'Tempat Lahir', 'trim|required');
        $val->set_rules('tgl_lhr', 'Tanggal Lahir', 'trim|required');
        $val->set_rules('alamat', 'Alamat', 'trim|required');
        $val->set_rules('provinsiHidden', 'Provinsi', 'trim|required',array('required' => 'Provinsi tidak ditemukan'));
        $val->set_rules('kotaHidden', 'Kab/Kota', 'trim|required',array('required' => 'Kab/Kota tidak ditemukan'));
        $val->set_rules('kecamatanHidden', 'Kecamatan', 'trim|required',array('required' => 'Kecamatan tidak ditemukan'));
        $val->set_rules('no_telp', 'No. Telp', 'trim|required');
        $val->set_rules('email', 'Email', 'trim|required|valid_email', array('valid_email' => "Format \"%s\" tidak sesuai") );
        $val->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
        $val->set_rules('agama', 'Agama', 'trim|required');
        $val->set_rules('agreement', 'Pernyataan dan Persetujuan', 'trim|required', array('required' => 'Silahkan ceklist Pernyataan dan Persetujuan Anggota') );

        

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

            $dataexc = array(
                'no_id' => $this->regex->_genRegex( $val->set_value('no_identitas') , 'RGXQSL'),
                'nama' => $this->regex->_genRegex( $val->set_value('nama') , 'RGXQSL'),
                'no_telp' => $this->regex->_genRegex( $val->set_value('no_telp') , 'RGXQSL'),
                'email' => $this->regex->_genRegex( $val->set_value('email') , 'RGXQSL'),
                'alamat_ktp' => $this->regex->_genRegex( $val->set_value('alamat') , 'RGXQSL'),
                'provinsi' => $this->regex->_genRegex( $val->set_value('provinsiHidden') , 'RGXQSL'),
                'kabkota' => $this->regex->_genRegex( $val->set_value('kotaHidden') , 'RGXQSL'),
                'kecamatan' => $this->regex->_genRegex( $val->set_value('kecamatanHidden') , 'RGXQSL'),
                'pekerjaan' => $this->regex->_genRegex( $val->set_value('pekerjaan') , 'RGXQSL'),
                'kabkota' => $this->regex->_genRegex( $val->set_value('kotaHidden') , 'RGXQSL'),
                'tmp_lhr' => $this->regex->_genRegex( $val->set_value('tmp_lhr') , 'RGXQSL'),
                'tgl_lhr' => $this->regex->_genRegex( $val->set_value('tgl_lhr') , 'RGXQSL'),
                'agama' => $this->regex->_genRegex( $val->set_value('agama') , 'RGXQSL'),
                'jenis_anggota' => $this->regex->_genRegex( strtoupper($_POST['jenis_anggota']) , 'RGXQSL'),
                'tgl_register' => $this->regex->_genRegex( date('Y-m-d') , 'RGXQSL'),
                'tipe_anggota' => $this->regex->_genRegex( $_POST['tipe_anggota'] , 'RGXQSL'),
                'is_active' => $this->regex->_genRegex( 'N' , 'RGXQSL'),
            );

            if($_POST['tipe_anggota'] == 'old'){
                $dataexc['no_kta_old'] = $_POST['no_kta_old'];
                $dataexc['masa_aktif'] = $_POST['masa_aktif'];

                if(isset($_FILES['foto_kta_old']['name'])){
                    /*hapus dulu file yang lama*/
                    if( $id != 0 ){
                        $file_kta_old_ex = $this->Register->get_by_id($id);
                        if ($file_kta_old_ex->foto_kta_old != NULL) {
                            unlink(PATH_IMG_DEFAULT.$file_kta_old_ex->foto_kta_old.'');
                        }
                    }
                    $dataexc['foto_kta_old'] = $this->upload_file->doUpload('foto_kta_old', PATH_IMG_DEFAULT);
                }
            }

            if(isset($_FILES['file_identitas']['name'])){
                /*hapus dulu file yang lama*/
                if( $id != 0 ){
                    $file_ex = $this->Register->get_by_id($id);
                    if ($file_ex->scan_identitas != NULL) {
                        unlink(PATH_IMG_DEFAULT.$file_ex->scan_identitas.'');
                    }
                }
                $dataexc['scan_identitas'] = $this->upload_file->doUpload('file_identitas', PATH_IMG_DEFAULT);
            }

            if(isset($_FILES['pas_foto']['name'])){
                /*hapus dulu file yang lama*/
                if( $id != 0 ){
                    $file_ex = $this->Register->get_by_id($id);
                    if ($file_ex->pas_foto != NULL) {
                        unlink(PATH_IMG_DEFAULT.$file_ex->pas_foto.'');
                    }
                }
                $dataexc['pas_foto'] = $this->upload_file->doUpload('pas_foto', PATH_IMG_DEFAULT);
            }

            
            if($id==0){
                $dataexc['created_date'] = date('Y-m-d H:i:s');
                $dataexc['created_by'] = json_encode(array('user_id' =>'register user', 'fullname' => $_POST['nama']));
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>'register user', 'fullname' => $_POST['nama']));
                /*save post data*/
                $this->Register->save($dataexc);
                $newId = $this->db->insert_id();
            }else{
                $dataexc['updated_date'] = date('Y-m-d H:i:s');
                $dataexc['updated_by'] = json_encode(array('user_id' =>'register user', 'fullname' => $_POST['nama']));
                /*update record*/
                $this->Register->update(array('id' => $id), $dataexc);
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
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }
    }

    

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

