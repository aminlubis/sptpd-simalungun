<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_model extends CI_Model {

	var $table = 'objek_pajak';
	var $column = array('objek_pajak.nama_usaha');
	var $select = 'objek_pajak.*, jenisusaha.jenisusaha, kode_kecamatan.nama_kecamatan, kode_kelurahan.nama_kelurahan, wajibpajak.is_verified as wp_verified, wajibpajak.tgldaftar, wajibpajak.noktp, wajibpajak.nama, wajibpajak.alamat, tempatlahir, tanggallahir, kodepos, wajibpajak.telp as telp_wp, jenispajak.jenispajak, path_ktp';

	var $order = array('objek_pajak.id_izin_usaha' => 'DESC');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('jenisusaha','jenisusaha.idjenisusaha=objek_pajak.idjenis_usaha','left');
		$this->db->join('jenispajak','jenispajak.kodejenispajak=objek_pajak.kodejenispajak','left');
		$this->db->join('kode_kecamatan','kode_kecamatan.kode_kecamatan=objek_pajak.kecamatan_usaha','left');
		$this->db->join('kode_kelurahan','kode_kelurahan.kode_kelurahan=objek_pajak.kode_kelurahan','left');
		$this->db->join('wajibpajak','wajibpajak.npwpd=objek_pajak.npwpd','left');
		$this->db->where("objek_pajak.npwpd IN (SELECT npwpd FROM wajibpajak WHERE noktp='".$this->session->userdata('user')->noktp."')");
		

	}

	private function _get_datatables_query()
	{
		
		$this->_main_query();

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->_main_query();
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->_main_query();
		if(is_array($id)){
			$this->db->where_in(''.$this->table.'.id_izin_usaha',$id);
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->where(''.$this->table.'.id_izin_usaha',$id);
			$query = $this->db->get();
			return $query->row();
		}
		
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$get_data = $this->get_by_id($id);
		$this->db->where_in(''.$this->table.'.id_izin_usaha', $id);
		return $this->db->update($this->table, array('is_deleted' => 'Y', 'is_active' => 'N'));
	}


}
