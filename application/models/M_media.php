<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_media extends CI_Model {

	public function upload($data = array())
	{
		// Insert ke database sesuai banyak data sekaligus
		return $this->db->insert_batch('t_gambar', $data);
	}

	public function getMedia()
	{
		$this->db->distinct('id_bidang');
		$this->db->select('nama_bidang');
		return $this->db->get('media')->result();
	}

	public function getMediaById($id)
	{
		$this->db->select('nama_gambar');
		$this->db->where('id_bidang', $id);
		return $this->db->get('media')->result();
	}	
}

/* End of file m_media.php */
/* Location: ./application/models/m_media.php */