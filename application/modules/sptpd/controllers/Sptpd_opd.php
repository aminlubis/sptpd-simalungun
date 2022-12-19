<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sptpd_opd extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sptpd/Sptpd_opd_model','Sptpd_opd');
        $this->load->model('front/Register_model','Register');

    }

    public function index() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Sptpd_opd/'.strtolower(get_class($this)));
         $data = array(
            'title' => COMPANY,
            'subtitle' => '',
        );

        // echo '<pre>';print_r($this->session->all_userdata());die;

        $this->load->view('sptpd/Sptpd_opd/index', $data);
    }
    

    public function form() {
        $this->output->enable_profiler(false);
        /*breadcrumb*/
        $this->breadcrumbs->push('Welcome', 'Sptpd_opd/'.strtolower(get_class($this)));
        $id_izin_usaha = isset($_GET['id_izin_usaha'])?$_GET['id_izin_usaha']:0;
        $id_hop = isset($_GET['id_hop'])?$_GET['id_hop']:0;
        $kodejenispajak = isset($_GET['kodejenispajak'])?$_GET['kodejenispajak']:0;
         $data = array(
            'title' => 'Form SPTPD',
            'subtitle' => COMPANY,
            'objek_pajak' => ($id_izin_usaha != 0) ? $this->Sptpd_opd->get_objek_pajak_by_id($id_izin_usaha) : [],
            'hop' => ($id_hop != 0) ? $this->Sptpd_opd->get_by_id($id_hop) : [],
        );
        // echo '<pre>';print_r($data);die;
        $this->load->view('sptpd/Sptpd_opd/form', $data);
        
    }

    public function changeForm($kodejenispajak) {

        $data = [];
        $data['pajak'] = $this->db->get_where('jenispajak', array('kodejenispajak' => $kodejenispajak))->row();
        $html = $this->load->view('sptpd/Sptpd_opd/form_'.$kodejenispajak.'', $data, true);
        echo json_encode(array('html' => $html));
        
    }

    public function get_data()
    {
        /*get data from model*/
        $list = $this->Sptpd_opd->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $row_list) {
            $no++;
            $row = array();
            $row[] = '<div class="center">'.$no.'</div>'; 
            $row[] = '<div class="center"><b><a href="#" onclick="getMenu('."'sptpd/Sptpd_opd/form?id_izin_usaha=".$row_list->id_izin_usaha."&id_hop=".$row_list->id_hop."&kodejenispajak=".$row_list->kdjnspjk."&act=readonly'".')">'.$row_list->id_hop.'</a></b></div>';
            $row[] = '<div class="center">'.$row_list->va_bayar.'</div>';
            $row[] = strtoupper($row_list->nama_usahaop);
            $row[] = '<div class="center">'.$this->tanggal->formatDateShort($row_list->periode_awal).'</div>';
            $row[] = '<div class="center">'.$this->tanggal->formatDateShort($row_list->periode_akhir).'</div>';
            // $row[] = $row_list->va_bayar;
            $row[] = '<div style="text-align: right">'.number_format($row_list->omset).'</div>';
            $row[] = '<div style="text-align: right">'.number_format($row_list->pajakterutang).'</div>';
            // $row[] = '<div style="text-align: center"><a href="'.base_url().'Templates/Attachment/download?refno='.$row_list->id_hop.'&refname=history_objek_pajak" target="_blank">Download File</a></div>';
            $status = ($row_list->penetapan_pajak_official != NULL) ? '<i class="fa fa-check bigger-120 green"></i>' : '<i class="fa times-circle bigger-120 red"></i>' ;
            $row[] = '<div class="center">'.$status.'</div>';

            if($row_list->penetapan_pajak_official != NULL){
                $row[] = '<div class="center"><a href="#">Cetak SKPD</a></div>';
            }else{
                $row[] = '<div class="center"><a href="#" onclick="getMenu('."'objek_pajak/Objek_pajak_opd/form/".$row_list->id_hop."'".')" class="btn btn-xs btn-success"><i class="fa fa-edit"></i>Ubah</a><a href="#" class="btn btn-xs btn-danger" onclick="delete_data('.$row_list->id_hop.')"><i class="fa fa-trash"></i> Hapus</a></div>';
            }
            if($row_list->waktu_transaksi != NULL){
                $row[] = '<div class="center"><a href="#">Cetak SSPD</a></div>';
            }else{
                $row[] = '<div class="center"><span class="red" style="font-weight: bold">Belum bayar</span></div>';
            }

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Sptpd_opd->count_all(),
                        "recordsFiltered" => $this->Sptpd_opd->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function download_file($id_hop){
        $file = $this->db->get_where('t_fileattachment', array('refid' => $_GET['refno'], 'reftable' => $_GET['refname']))->row();
        if(!empty($file)){
            $data['value'] = $file;
            $this->load->view('sptpd/Sptpd_opd/download_view', $data);
        }else{
            echo 'Tidak ada file ditemukan';
        }
    }


    

    

}

/* End of file empty_module.php */
/* Location: ./application/modules/empty_module/controllers/empty_module.php */

