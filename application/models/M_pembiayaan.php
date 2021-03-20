<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembiayaan extends CI_Model {


	function getAll()
	{
		return $this->db->get('t_pembiayaan')->result();
	}

	function getById($id){
		$this->db->from('t_pembiayaan');
		$this->db->where('id_pembiayaan', $id);
		$query = $this->db->get();
		return $query;
	}

	function getByName($name){
		$this->db->from('t_pembiayaan');
		$this->db->where('nama_pembiayaan', $name);
		$query = $this->db->get();
		return $query->row();
	}

	function updatePembiayaan($where,$data){
		$this->db->update('t_pembiayaan', $data, $where);
		return $this->db->affected_rows();
	}

	function deletePembiayaanById($id){
		$this->db->where('id_pembiayaan', $id);
		$this->db->delete('t_pembiayaan');
	}

	public function savePembiayaan($data){

		$this->db->insert('t_pembiayaan', $data);

		return $this->db->insert_id();
	}

}
