<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kode_rekening extends CI_Model {


	function getByKr($kr)
    {
        $this->db->from('t_kode_rek');
        $this->db->where('kode_rek', $kr);
        $query = $this->db->get();
        return $query->row();
    }

	function getByName($name)
    {
        $this->db->from('t_kode_rek');
        $this->db->where('nama_akun', $name);
        $query = $this->db->get();
        return $query->row();
    }

    function updateKoderekening($where, $data)
    {
        $this->db->update('t_kode_rek', $data, $where);
        return $this->db->affected_rows();
    }

}

/* End of file m_kode_rekening.php */
/* Location: ./application/models/m_kode_rekening.php */