<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sptpd_model extends CI_Model {

	var $table = 'history_objek_pajak';
	var $column = array('history_objek_pajak.nama_usaha');
	var $select = 'b.npwpd, history_objek_pajak.*';

	var $order = array('history_objek_pajak.id_hop' => 'DESC');

	public function __construct()
	{
		parent::__construct();
	}

	private function _main_query(){
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('objek_pajak b','b.nopd=history_objek_pajak.noobjekpajak', 'LEFT');
		$this->db->join('wajibpajak c','c.npwpd=b.npwpd', 'LEFT');
		$this->db->where('c.noktp', $this->session->userdata('user')->noktp);

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
		// print_r($this->db->last_query());die;
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
		$this->db->insert('objek_pajak', $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update('objek_pajak', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$get_data = $this->get_by_id($id);
		if( $this->delete_image_default($get_data[0]) ){
			$this->db->where_in(''.'objek_pajak'.'.id_izin_usaha', $id);
			return $this->db->delete('objek_pajak');
		}else{
			return false;
		}
		
	}

	public function delete_image_default($data){
		/*print_r($data);die;*/
		/*if file images exist*/
		if ( file_exists(PATH_IMG_CONTENT.$data->foto_default) ) {
			if($data->foto_default != NULL){
				/*delete first foto_default file*/
	            unlink(PATH_IMG_CONTENT.$data->foto_default);
			}
        }
        return true;
	}


	public function list_fields(){
		return $this->db->list_fields( $this->table );
	}

	public function getNoSptpd($nopd){
		$hop = $this->db->from('history_objek_pajak')
					->where('noobjekpajak', $nopd)
					->order_by('id_hop', 'DESC')
					->get()->row();
		$nosptpd = $hop->id_hop + 1;
		return $nosptpd;
	}

	public function get_objek_pajak($npwpd){
		$objek_pajak = $this->db->get_where('objek_pajak', array('npwpd' => $npwpd));
		return $objek_pajak;
	}


}
