<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('front/Register_model','Register');
        /*load library*/
        $this->load->library('bcrypt');

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

    public function konfirmasi_email(){
        if($this->Register->confirm()){
            $this->load->view('Register/konfirmasi_sukses_view');
        }
    }

    public function form_register($id='') {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Register/'.strtolower(get_class($this)));
        $data = [];
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit', 'front/Register/'.strtolower(get_class($this)).'/'.__FUNCTION__);
            /*get value by id*/
            $data['value'] = $this->Register->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add', 'front/Register/'.strtolower(get_class($this)).'/form_register');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }

        $data['title'] = 'Registrasi Wajib Pajak';
        $data['subtitle'] = 'Form Registrasi';

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

    public function process()
    {
        // print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;

        $id = ($this->input->post('id'))?$this->input->post('id'):0;

        $val->set_rules('tgldaftar', 'Tanggal Daftar', 'trim|required');
        $val->set_rules('nama', 'Nama WP', 'trim|required|min_length[5]', array('min_length' => 'Nama WP minimal 5 karakter'));
        $val->set_rules('alamat', 'Alamat', 'trim|required');
        $val->set_rules('tempatlahir', 'Tempat Lahir', 'trim|required');
        $val->set_rules('tanggallahir', 'Tanggal Lahir', 'trim|required');
        $val->set_rules('kecamatanHidden', 'Kecamatan', 'trim|required');
        $val->set_rules('kelurahanHidden', 'Kelurahan', 'trim|required');
        $val->set_rules('telp', 'No. Telp/WA', 'trim|required');
        $val->set_rules('kodepos', 'Kode POS', 'trim|required');
       

        if($id == 0){
            $val->set_rules('no_ktp', 'No KTP', 'trim|required|min_length[15]|max_length[16]|numeric|is_unique[wajibpajak.noktp]', array('min_length' => 'No KTP Minimal 15 Karakter', 'max_length' => 'No KTP Maksimal 16 Karakter', 'numeric' => 'No KTP Harus diisi Angka', 'is_unique' => 'No KTP anda sudah terdaftar Wajib Pajak'));
            $val->set_rules('username', 'Nama Pengguna', 'trim|required|valid_email|is_unique[qrcode_user.username]', array('is_unique' => 'Nama Pengguna sudah digunakan', 'valid_email' => 'Mohon masukan sesuai dengan format Email'));
            $val->set_rules('konfirm_password', 'Konfirmasi Password', 'required|matches[password]', array('matches' => 'Konfirmasi Kata Sandi tidak sesuai'));
            $val->set_rules('password', 'Konfirmasi Password', 'trim|required|min_length[6]', array('min_length' => 'Kata Sandi minimal 6 karakter'));
        }else{
            $val->set_rules('no_ktp', 'No KTP', 'trim|required');
        }

        $val->set_message('required', "Silahkan isi field \"%s\"");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            
            $dataexc = array(
                'tgldaftar' => $this->regex->_genRegex( $val->set_value('tgldaftar'), 'RGXQSL'),
                'noktp' => $this->regex->_genRegex( $val->set_value('no_ktp'), 'RGXQSL'),
                'nama' => $this->regex->_genRegex( $val->set_value('nama'), 'RGXQSL'),
                'alamat' => $this->regex->_genRegex( $val->set_value('alamat'), 'RGXQSL'),
                'tempatlahir' => $this->regex->_genRegex( $val->set_value('tempatlahir'), 'RGXQSL'),
                'tanggallahir' => $this->regex->_genRegex( $val->set_value('tanggallahir'), 'RGXQSL'),
                'kecamatan' => $this->regex->_genRegex( $val->set_value('kecamatanHidden'), 'RGXQSL'),
                'kelurahan' => $this->regex->_genRegex( $val->set_value('kelurahanHidden'), 'RGXQSL'),
                'kabupatenkota' => $this->regex->_genRegex( 'Kabupaten Simalungun', 'RGXQSL'),
                'telp' => $this->regex->_genRegex( $val->set_value('telp'), 'RGXQSL'),
                'kodepos' => $this->regex->_genRegex( $val->set_value('kodepos'), 'RGXQSL'),
                'tglsistem' => date('Y-m-d H:i:s'),
            );

            if($id==0){
                $urutan = $this->db->select('(max(no_urut)+1) as urutan')->from('wajibpajak')->get()->row();
                $npwpd = sprintf("%04d-%03d",$urutan->urutan,$_POST['kelurahanHidden']);
                $dataexc['npwpd'] = $npwpd;
                $dataexc['no_urut'] = $urutan->urutan;

                $this->Register->save($dataexc);
                $newId = $npwpd;
                // create account
                $account = array(
                    'fullname' => $this->regex->_genRegex($val->set_value('nama'),'RGXQSL'),
                    'username' => $this->regex->_genRegex($val->set_value('username'),'RGXQSL'),
                    'noktp' => $this->regex->_genRegex($val->set_value('no_ktp'),'RGXQSL'),
                    'password' => $this->bcrypt->hash_password($val->set_value('password')),
                    'tgl_daftar' => $this->regex->_genRegex($dataexc['tglsistem'],'RGXQSL'),
                    'mail_creating' => $this->regex->_genRegex(0,'RGXINT'),
                    'user_level' => 2,
                );
                $this->db->insert('qrcode_user', $account);
                $params = array_merge($dataexc, $account);
                $this->sendmail($params);
            }else{
                $this->Register->update(array('npwpd' => $id), $dataexc);
                $newId = $id;
            }

             // upload attachment
             if(isset($_FILES['file']['name'])){
                $config = array(
                    'reftable' => 'wajib_pajak',
                    'refid' => $newId,
                    'jenis' => 'KTP',
                    'npwpd' => $newId,
                    'noktp' => $this->input->post('no_ktp'),
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

    public function sendmail($params){
        $this->load->library('Mailer');
        $params['base_url'] = base_url();
        $params['email'] = $params['username'];
        $html = $this->load->view('Templates/templates/email_template', $params, true);

        $params['body'] = $html;
        if($this->mailer->set_email_object($params)){
            // update user creating mail
            $this->db->where(array('username' => $params['email'], 'password' => $params['password']))->update('qrcode_user', array('mail_creating' => 1));
        }

    }

    

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

