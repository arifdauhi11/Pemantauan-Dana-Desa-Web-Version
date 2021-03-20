<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bidang extends CI_Model {

	// function getAll(){
	// 	$this->db->select('t_bidang.id_bidang as bidang_id,nama_bidang');
	// 	$this->db->from('t_bidang');
	// 	return $this->db->get();
	// }

	function getAll()
	{
		return $this->db->get('t_bidang')->result();
	}

	function getById($id){
		$this->db->from('t_bidang');
		$this->db->where('id_bidang', $id);
		$query = $this->db->get();
		return $query;
	}

	function getByName($name){
		$this->db->from('t_bidang');
		$this->db->where('nama_bidang', $name);
		$query = $this->db->get();
		return $query->row();
	}

	function updateBidang($where,$data){
		$this->db->update('t_bidang', $data, $where);
		return $this->db->affected_rows();
	}

	function deleteBidangById($id){
		$this->db->where('id_bidang', $id);
		$this->db->delete('t_bidang');
	}

	public function saveBidang($data){

		$this->db->insert('t_bidang', $data);

		return $this->db->insert_id();
	}


	// Fungsi untuk melakukan proses upload file
	// function uploadGambar(){
	// 	$config['upload_path'] = './assets/images/';
	// 	$config['allowed_types'] = 'jpg|png|jpeg';
	// 	$config['max_size']	= '2048';
	// 	$config['remove_space'] = TRUE;
	
	// 	$this->load->library('upload', $config); // Load konfigurasi uploadnya
	// 	if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
	// 		// Jika berhasil :
	// 		$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	// 		return $return;
	// 	}else{
	// 		// Jika gagal :
	// 		$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	// 		return $return;
	// 	}
	// }

	// public function upBidang($where,$data,$table)
	// {		
	// 	$this->db->where($where);
	// 	$this->db->update($table, $data);
	// }

	// Fungsi untuk menyimpan data ke database
		// $url = "https://sidandes.000webhostapp.com/assets/images/";
		// $bidang = $this->input->post('namaBidang');
		// $gambar = $upload['file']['file_name'];
		// $data = array(
			// 'nama_bidang' => $bidang
		// );
		// $data = array(
		// 	'nama_bidang'=>$this->input->post('input_nama'),
		// 	'gambar' => $upload['file']['file_name']
		// );
		
		// $this->db->insert('t_bidang', $data);

	

	// function getByID($where,$table){		
	// 	return $this->db->get_where($table,$where);
	// }

	// function hapusBidang($where,$table){
	// $this->db->where($where);
	// $this->db->delete($table);
	// }
}

/* End of file m_bidang.php */
/* Location: ./application/models/m_bidang.php */