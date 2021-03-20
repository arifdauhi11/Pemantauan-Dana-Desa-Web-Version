<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sumber_pendapatan extends CI_Model
{

    function getAll()
    {
        return $this->db->get('t_sumber_pendapatan');
    }

    function getById($id)
    {
        $this->db->from('t_sumber_pendapatan');
        $this->db->where('id_pendapatan', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getByName($name)
    {
        $this->db->from('t_sumber_pendapatan');
        $this->db->where('sumber_pendapatan', $name);
        $query = $this->db->get();
        return $query->row();
    }

    function updatePendapatan($where, $data)
    {
        $this->db->update('t_sumber_pendapatan', $data, $where);
        return $this->db->affected_rows();
    }

    function deletePendapatanById($id)
    {
        $this->db->where('id_pendapatan', $id);
        $this->db->delete('t_sumber_pendapatan');
    }

    public function savePendapatan($data)
    {

        $this->db->insert('t_sumber_pendapatan', $data);

        return $this->db->insert_id();
    }
}
