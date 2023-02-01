<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmp_user extends MX_Controller {

    /*function constructor*/
    function __construct() {

        parent::__construct();
        /*breadcrumb default*/
        $this->breadcrumbs->push('Index', 'setting/Tmp_user');
        /*session redirect login if not login*/
        if($this->session->userdata('logged')!=TRUE){
            echo 'Session Expired !'; exit;
        }
        /*load model*/
        $this->load->model('Tmp_user_model', 'Tmp_user');

        /*load library*/
        $this->load->library('bcrypt');
        /*enable profiler*/
        $this->output->enable_profiler(false);
        /*profile class*/
        $this->title = 'Pengguna';

    }

    public function index() { 
        //echo '<pre>';print_r($this->session->all_userdata());
        /*define variable data*/
        $data = array(
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumbs->show()
        );
        /*load view index*/
        $this->load->view('Tmp_user/index', $data);
    }

    public function form($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Tmp_user/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tmp_user->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Tmp_user/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_user/form', $data);
    }

    public function form_reset($id='')
    {
        /*if id is not null then will show form edit*/
        if( $id != '' ){
            /*breadcrumbs for edit*/
            $this->breadcrumbs->push('Edit '.strtolower($this->title).'', 'Tmp_user/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
            /*get value by id*/
            $data['value'] = $this->Tmp_user->get_by_id($id);
            /*initialize flag for form*/
            $data['flag'] = "update";
        }else{
            /*breadcrumbs for create or add row*/
            $this->breadcrumbs->push('Add '.strtolower($this->title).'', 'Tmp_user/'.strtolower(get_class($this)).'/form');
            /*initialize flag for form add*/
            $data['flag'] = "create";
        }
        /*title header*/
        $data['title'] = $this->title;
        /*show breadcrumbs*/
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_user/form_reset', $data);
    }

    /*function for view data only*/
    public function show($id)
    {
        /*breadcrumbs for view*/
        $this->breadcrumbs->push('View '.strtolower($this->title).'', 'Tmp_user/'.strtolower(get_class($this)).'/'.__FUNCTION__.'/'.$id);
        /*define data variabel*/
        $data['value'] = $this->Tmp_user->get_by_id($id);
        $data['title'] = $this->title;
        $data['flag'] = "read";
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        /*load form view*/
        $this->load->view('Tmp_user/form', $data);
    }


    public function get_data()
    {
        /*get data from model*/
        $list = $this->Tmp_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" name="selected_id[]" value="'.$row_list->id.'"/>
                            <span class="lbl"></span>
                        </label>
                      </div>';
            $row[] = '';
            $row[] = $row_list->id;
            $row[] = '<div class="center">'.$row_list->id.'</div>';
            $row[] = strtoupper($row_list->fullname);
            $row[] = $row_list->username;
            $row[] = $row_list->noktp;
            $status = ($row_list->status_user == 'aktif') ? '<label class="label label-success">Aktif</label>' :'<label class="label label-warning">Non Aktif</label>';
            $is_deleted = ($row_list->is_deleted == 'Y') ? '<label class="label label-danger">Dihapus</label>' :$status;
            $row[] = '<div class="center">'.$is_deleted.'</div>';
            $row[] = $row_list->tgl_daftar;
            $row[] = '<div class="center">'.$row_list->level.'</div>';
            if(in_array($row_list->user_level, array(1,3))){
                $row[] = '<div class="center"><a href="#" class="btn btn-xs btn-success" onclick="getMenu('."'setting/Tmp_user/form/".$row_list->id."')".'"><i class="fa fa-pencil"></i> Ubah</a><a href="#" class="btn btn-xs btn-danger" onclick="delete_data(' . "'" . $row_list->id . "'" . ')"><i class="fa fa-trash"></i> Hapus</a></div>';
            }else{
                if($row_list->status_user == 'aktif'){
                    $row[] = '<div class="center"><a href="#" class="btn btn-xs btn-inverse" onclick="getMenu('."'setting/Tmp_user/form_reset/".$row_list->id."')".'"><i class="fa fa-refresh"></i> Reset Password</a></div>';
                }else{
                    $row[] = '<div class="center"><a href="#" class="btn btn-xs btn-purple" onclick="aktivasi_akun(' . "'" . $row_list->id . "'" . ')"><i class="fa fa-unlock"></i> Aktivasi Akun</a></div>';
                }
            }
                   
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Tmp_user->count_all(),
                        "recordsFiltered" => $this->Tmp_user->count_filtered(),
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
        $val->set_rules('fullname', 'Password', 'trim|required');
        $val->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $val->set_rules('user_level', 'Level', 'trim|required');
        $val->set_rules('confirm', 'Password Confirmation', 'trim|required|matches[password]');
        if($_POST['id'] == 0){
            $val->set_rules('username', 'Email', 'trim|required|valid_email|is_unique[qrcode_user.username]', array('is_unique' => 'Email sudah pernah terdaftar'));
        }else{
            $val->set_rules('username', 'Email', 'trim|required');
        }

        $val->set_message('required', "Silahkan isi field \"%s\"");
        $val->set_message('matches', "\"%s\" tidak sesuai dengan password");
        $val->set_message('valid_email', "\"%s\" tidak valid");
        $val->set_message('min_length', "\"%s\" minimal 6 karakter");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;

            $dataexc = array(
                'fullname' => $this->regex->_genRegex($val->set_value('fullname'),'RGXQSL'),
                'username' => $this->regex->_genRegex($val->set_value('username'),'RGXQSL'),
                'password' => $this->bcrypt->hash_password($val->set_value('password')),
                'status' => 'aktif',
                'user_level' => $this->regex->_genRegex($val->set_value('user_level'),'RGXQSL'),
                'is_deleted' => 'N',
            );
            
            if($id==0){
                $newId = $this->Tmp_user->save($dataexc);
            }else{
                $this->Tmp_user->update(array('id' => $id), $dataexc);
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
                //redirect(base_url().'login/logout');
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }
    }

    public function process_reset()
    {
        // print_r($_POST);die;
        $this->load->library('form_validation');
        $val = $this->form_validation;
        $val->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $val->set_message('required', "Silahkan isi field \"%s\"");
        $val->set_message('matches', "\"%s\" tidak sesuai dengan password");
        $val->set_message('valid_email', "\"%s\" tidak valid");
        $val->set_message('min_length', "\"%s\" minimal 6 karakter");

        if ($val->run() == FALSE)
        {
            $val->set_error_delimiters('<div style="color:white">', '</div>');
            echo json_encode(array('status' => 301, 'message' => validation_errors()));
        }
        else
        {                       
            $this->db->trans_begin();
            $id = ($this->input->post('id'))?$this->regex->_genRegex($this->input->post('id'),'RGXINT'):0;

            $dataexc = array(
                'password' => $this->bcrypt->hash_password($val->set_value('password')),
                'status' => 'aktif',
                'is_deleted' => 'N',
            );
            
            $this->Tmp_user->update(array('id' => $id), $dataexc);

            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Gagal Dilakukan'));
            }
            else
            {
                $this->db->trans_commit();
                //redirect(base_url().'login/logout');
                echo json_encode(array('status' => 200, 'message' => 'Proses Berhasil Dilakukan'));
            }
        }
    }

    public function delete()
    {
        $id=$this->input->post('ID')?$this->regex->_genRegex($this->input->post('ID',TRUE),'RGXQSL'):null;
        $toArray = explode(',',$id);
        if($id!=null){
            if($this->Tmp_user->delete_by_id($toArray)){
                echo json_encode(array('status' => 200, 'message' => 'Proses Hapus Data Berhasil Dilakukan'));

            }else{
                echo json_encode(array('status' => 301, 'message' => 'Maaf Proses Hapus Data Gagal Dilakukan'));
            }
        }else{
            echo json_encode(array('status' => 301, 'message' => 'Tidak ada item yang dipilih'));
        }
        
    }

    public function aktivasi(){
		$query = $this->db->get_where('qrcode_user', array('id' => $_POST['ID']));
		if($query->num_rows() > 0){
			// update user
			$this->db->where( array('id' => $_POST['ID']) )->update('qrcode_user', array('status' => 'aktif'));
			echo json_encode(array('status' => 200, 'message' => 'Aktivasi akun Berhasil Dilakukan'));
		}else{
			echo json_encode(array('status' => 301, 'message' => 'Aktivasi akun gagal dilakukan!'));
		}
	}

}


/* End of file example.php */
/* Location: ./application/modules/example/controllers/example.php */
