<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tahun_anggaran extends CI_Model
{

    function getAll()
    {
        $this->db->order_by('tahun', 'asc');
        return $this->db->get('t_tahun_anggaran');
    }

    function getById($id)
    {
        $this->db->from('t_tahun_anggaran');
        $this->db->where('id_tahun', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getByName($name)
    {
        $this->db->from('t_tahun_anggaran');
        $this->db->where('tahun', $name);
        $query = $this->db->get();
        return $query->row();
    }

    function updateTahun($where, $data)
    {
        $this->db->update('t_tahun_anggaran', $data, $where);
        return $this->db->affected_rows();
    }

    function deleteTahunById($id)
    {
        $this->db->where('id_tahun', $id);
        $this->db->delete('t_tahun_anggaran');
    }

    public function saveTahun($data)
    {

        $this->db->insert('t_tahun_anggaran', $data);

        return $this->db->insert_id();
    }
}
