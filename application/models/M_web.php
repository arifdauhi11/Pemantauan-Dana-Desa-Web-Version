<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_web extends CI_Model {

	public function getAnggaranBidang($tahun)
	{
		$query = $this->db->query('SELECT `t_bidang`.`id_bidang`, `t_bidang`.`nama_bidang`, anggaran_semula, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun
			FROM `t_anggaran`
			LEFT JOIN t_bidang ON t_bidang.id_bidang = t_anggaran.id_bidang 
			LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun 
			WHERE t_tahun_anggaran.tahun = '.$tahun.' 
			AND t_anggaran.id_bidang != 0 
			ORDER BY anggaran_semula ASC')->result();
			return $query;
	}

	// public function getAnggaranPendapatan($tahun)
	// {
	// 	$query = $this->db->query('SELECT `t_sumber_pendapatan`.`id_pendapatan`, `t_sumber_pendapatan`.`sumber_pendapatan`, anggaran, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun FROM `t_anggaran` LEFT JOIN t_sumber_pendapatan ON t_sumber_pendapatan.id_pendapatan = t_anggaran.id_pendapatan LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun WHERE t_anggaran.id_pendapatan != 0 AND t_tahun_anggaran.tahun = '.$tahun.' ORDER BY anggaran ASC');
	// 	return $query;
	// }

	public function getAnggaranPendapatan($tahun)
	{
		$this->db->select('id_anggaran, t_sumber_pendapatan.id_pendapatan, t_sumber_pendapatan.sumber_pendapatan, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_anggaran.id_pendapatan = t_sumber_pendapatan.id_pendapatan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_pendapatan !=', 0);
        $this->db->where('t_tahun_anggaran.tahun =', $tahun);
        return $this->db->get();
	}

	function getAggaranPendapatan($tahun)
    {
        $this->db->select('id_anggaran, t_sumber_pendapatan.id_pendapatan, t_sumber_pendapatan.sumber_pendapatan, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_anggaran.id_pendapatan = t_sumber_pendapatan.id_pendapatan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_pendapatan !=', 0);
        $this->db->where('t_tahun_anggaran.tahun =', $tahun);
        $this->db->order_by('t_anggaran.id_tahun', 'asc');
        return $this->db->get();
    }

    function getAggaranProgram($tahun, $bidang)
    {
        $this->db->select('id_anggaran, t_program.id, t_program.nama_program, anggaran_semula,anggaran_menjadi, t_bidang.nama_bidang, t_sub_bidang.sub_bidang, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_program', 't_anggaran.id_program = t_program.id', 'left');
        $this->db->join('t_bidang', 't_program.id_bidang = t_bidang.id_bidang', 'left');
        $this->db->join('t_sub_bidang', 't_program.id_sub_bidang = t_sub_bidang.id_sub_bidang', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_program !=', 0);
        $this->db->where('t_tahun_anggaran.tahun =', $tahun);
        $this->db->where('t_bidang.id_bidang =', $bidang);
        $this->db->order_by('t_anggaran.id_tahun', 'asc');
        return $this->db->get();
    }

	public function getJumlahAnggaran($tahun)
	{
		$this->db->select_sum('anggaran_semula', 'jumlah');
		$this->db->from('t_anggaran');
		$this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
		$this->db->where('t_tahun_anggaran.tahun', $tahun);
		$this->db->where('t_anggaran.id_pendapatan != ', 0);
		return $this->db->get();
		
	}

	function get_galeri_list($limit, $start){
        $query = $this->db->get('gambar', $limit, $start);
        return $query;
    }

}

/* End of file m_web.php */
/* Location: ./application/models/m_web.php */