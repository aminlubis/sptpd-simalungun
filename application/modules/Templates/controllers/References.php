<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class References extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	/*here function used for this application*/

	public function getProvince()
	{
        
		$result = $this->getProvinceByKeyword($_POST['keyword']);
		$arrResult = [];
		foreach ($result as $key => $value) {
			$arrResult[] = $value->id.' : '.$value->name;
		}
		echo json_encode($arrResult);
		
		
	}

	public function getProvinceByKeyword($key='')
	{
        $query = $this->db->where("name LIKE '%".$key."%' ")
        				  ->order_by('name', 'ASC')
                          ->get('provinces');
		
        return $query->result();
	}

	public function getRegencyByKeyword()
	{
        
		$query = $this->db->where("name LIKE '%".$_POST['keyword']."%' ")
        				  ->order_by('name', 'ASC')
                          ->get('regencies');
		$arrResult = [];
		foreach ($query->result() as $key => $value) {
			$arrResult[] = $value->id.' : '.$value->name;
		}
		echo json_encode($arrResult);
		
		
	}

	public function getDistricts()
	{
        
		$result = $this->getDistrictsByKeyword($_POST['keyword']);
		$arrResult = [];
		foreach ($result as $key => $value) {
			$arrResult[] = $value->id.' : '.$value->name;
		}
		echo json_encode($arrResult);
		
		
	}

	public function getDistrictsByKeyword($key='',$regency='')
	{
        $query = $this->db->where("name LIKE '%".$key."%' ")
        				  ->order_by('name', 'ASC')
                          ->get('districts');
		
        return $query->result();
	}

	public function getVillage()
	{
        
		$result = $this->getVillageByKeyword($_POST['keyword']);
		$arrResult = [];
		foreach ($result as $key => $value) {
			$arrResult[] = $value->kode_kecamatan.'.'.$value->kode_kelurahan.' : '.$value->nama_kelurahan;
		}
		echo json_encode($arrResult);
		
		
	}

	public function getVillageByKeyword($key='')
	{
        $query = $this->db->where("nama_kelurahan LIKE '%".$key."%' ")
        				  ->order_by('nama_kelurahan', 'ASC')
                          ->get('kode_kelurahan');
		
        return $query->result();
	}

	public function getRegencyByProvince($provinceId='')
	{
        $query = $this->db->where('province_id', $provinceId)
        				  ->order_by('name', 'ASC')
                          ->get('regencies');
		
        echo json_encode($query->result());
	}

	public function getDistrictByRegency($regency_id='')
	{
        $query = $this->db->where('regency_id', $regency_id)
        				  ->order_by('name', 'ASC')
                          ->get('districts');
		
        echo json_encode($query->result());
	}

	public function getVillagesByDistrict($district_id='')
	{
        $query = $this->db->where('kode_kecamatan', $district_id)
        				  ->order_by('nama_kelurahan', 'ASC')
                          ->get('kode_kelurahan');
		
        echo json_encode($query->result());
	}

	public function getDistrictsById($id='')
	{
		$query = "select kode_kecamatan, nama_kecamatan
				from kode_kecamatan a
				where a.kode_kecamatan=".$id." ";
		$exc = $this->db->query($query);
		echo json_encode($exc->row());
	}

	public function getRegencyById($id='')
	{
		$query = "select b.id as province_id, b.name as province_name, a.id as regency_id, a.name as regency_name, b.zona_waktu
				from regencies a
				left join provinces b on b.id=a.province_id
				where a.id=".$id." ";
		$exc = $this->db->query($query);
		echo json_encode($exc->row());
	}

	public function getMenuByModulId($modul_id='')
	{
        $query = $this->db->where('modul_id', $modul_id)->where('parent', 0)->where('is_active', 'Y')
        				  ->order_by('name', 'ASC')
                          ->get('tmp_mst_menu');
		
        echo json_encode($query->result());
	}

	public function getUsaha()
	{
        $query = $this->db->order_by('nama_usaha', 'ASC')
							->where('npwpd', $_POST['npwpd'])
							->get('objek_pajak')->result();
		
		$arrResult = [];
		foreach ($query as $key => $value) {
			$arrResult[] = $value->id_izin_usaha.' - '.$value->nama_usaha.' - '.$value->npwpd.'';
		}
		echo json_encode($arrResult);
	}

	public function getUsahaByID($id)
	{
        $query = $this->db->where('id_izin_usaha', $id)
        				  ->order_by('nama_usaha', 'ASC')
                          ->get('view_objek_pajak')->row();
		echo json_encode($query);
	}

	public function get_detail_table( $id )
    {
        $fields = $this->db->list_fields( $_GET['reftbl'] );
        $data = $this->db->where($_GET['fldid'], $id)->get( $_GET['reftbl'] )->row();
        $html = $this->master->show_detail_row_table( $fields, $data );      

        echo json_encode( array('html' => $html) );
    }

	public function getJenisUsaha()
	{
        $result = $this->db->where("nama_usaha LIKE '%".$_POST['keyword']."%' ")->get('view_objek_pajak')->result();
		
		$arrResult = [];
		foreach ($result as $key => $value) {
			$arrResult[] = $value->id_izin_usaha.' : '.$value->nama_usaha.' ['.$value->jenispajak.'] ';
		}
		echo json_encode($arrResult);
		
	}

	public function getWajibPajak()
	{
        $result = $this->db->where("nama LIKE '%".$_POST['keyword']."%' ")->get('wajibpajak')->result();
		
		$arrResult = [];
		foreach ($result as $key => $value) {
			$arrResult[] = $value->npwpd.' : '.$value->nama.' ['.$value->alamat.'] ';
		}

		echo json_encode($arrResult);
		
	}

	public function getDetailWp($npwpd)
	{
        $query = $this->db->where('npwpd', $npwpd)
                          ->get('wajibpajak')->row();
		echo json_encode($query);
	}

}
