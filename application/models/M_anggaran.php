<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_anggaran extends CI_Model
{

    function getAll()
    {
        $this->db->select('t_sumber_pendapatan.sumber_pendapatan,t_bidang.nama_bidang, t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.id_anggaran');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_sumber_pendapatan.id_pendapatan = t_anggaran.id_pendapatan', 'left');
        $this->db->join('t_bidang', 't_anggaran.id_bidang = t_bidang.id_bidang', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        return $this->db->get();
    }

    function getAggaranBidang()
    {
        $this->db->select('id_anggaran, t_bidang.id_bidang, t_bidang.nama_bidang, t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi');
        $this->db->from('t_anggaran');
        $this->db->join('t_bidang', 't_anggaran.id_bidang = t_bidang.id_bidang', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_bidang !=', 0);
        return $this->db->get();

    }

    function getAggaranPembiayaan()
    {
        $this->db->select('id_anggaran, t_pembiayaan.id_pembiayaan, t_pembiayaan.nama_pembiayaan, t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi');
        $this->db->from('t_anggaran');
        $this->db->join('t_pembiayaan', 't_anggaran.id_pembiayaan = t_pembiayaan.id_pembiayaan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_pembiayaan !=', 0);
        return $this->db->get();

    }

    function getAggaranProgram()
    {
        $this->db->select('id_anggaran, t_program.id, t_program.nama_program, t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi');
        $this->db->from('t_anggaran');
        $this->db->join('t_program', 't_anggaran.id_program = t_program.id', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_program !=', 0);
        return $this->db->get();

    }

    function getAggaranSubProgram()
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, t_tahun_anggaran.tahun, t_bulan.bulan , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi, t_anggaran.serapan');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->join('t_bulan', 't_bulan.id_bulan = t_anggaran.id_bulan', 'left');
        $this->db->where('t_anggaran.id_realisasi !=', 'SPM0');
        return $this->db->get();

    }

    function getAggaranSubProgramTahun()
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, t_tahun_anggaran.tahun, t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi_pertahun = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_realisasi_pertahun !=', 'SPM0');
        return $this->db->get();

    }

    function getAggaranPendapatan()
    {
        $this->db->select('id_anggaran, t_sumber_pendapatan.id_pendapatan, t_sumber_pendapatan.sumber_pendapatan, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_anggaran.id_pendapatan = t_sumber_pendapatan.id_pendapatan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_pendapatan !=', 0);
        $this->db->order_by('t_anggaran.id_tahun', 'asc');
        return $this->db->get();
    }

    function getAggaranPendapatanById($id)
    {
        $this->db->select('id_anggaran, t_sumber_pendapatan.id_pendapatan, t_sumber_pendapatan.sumber_pendapatan, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_anggaran.id_pendapatan = t_sumber_pendapatan.id_pendapatan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND t_sumber_pendapatan.id_pendapatan !=', 0);
        return $this->db->get();

    }

    function getAggaranProgramById($id)
    {
        $this->db->select('id_anggaran, t_program.id, t_program.nama_program, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_program', 't_anggaran.id_program = t_program.id', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND t_program.id !=', 0);
        return $this->db->get();

    }

    function getAggaranSubProgramById($id)
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun, t_bulan.bulan');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->join('t_bulan', 't_bulan.id_bulan = t_anggaran.id_bulan', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND realisasi.id_realisasi !=', 'SPM0');
        return $this->db->get();

    }

    function getAggaranSubProgramTahunById($id)
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, anggaran_semula,anggaran_menjadi, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi_pertahun = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND realisasi.id_realisasi !=', 'SPM0');
        return $this->db->get();

    }

    function getAggaranBidangById($id)
    {
        $this->db->select('id_anggaran, t_bidang.id_bidang, t_bidang.nama_bidang, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_bidang', 't_anggaran.id_bidang = t_bidang.id_bidang', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND t_anggaran.id_bidang !=', 0);
        return $this->db->get();
    }

    function getAggaranPembiayaanById($id)
    {
        $this->db->select('id_anggaran, t_pembiayaan.id_pembiayaan, t_pembiayaan.nama_pembiayaan, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_pembiayaan', 't_anggaran.id_pembiayaan = t_pembiayaan.id_pembiayaan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_anggaran.id_anggaran = '.$id.' AND t_anggaran.id_pembiayaan !=', 0);
        return $this->db->get();
    }

    function getTahunPendapatan($id,$tahun)
    {
        $this->db->select('id_anggaran, t_sumber_pendapatan.id_pendapatan, t_sumber_pendapatan.sumber_pendapatan, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_sumber_pendapatan', 't_anggaran.id_pendapatan = t_sumber_pendapatan.id_pendapatan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_sumber_pendapatan.id_pendapatan = '.$id.' AND t_anggaran.id_pendapatan !=', 0);
        return $this->db->get();
    }

    function getTahunBidang($id,$tahun)
    {
        $this->db->select('id_anggaran, t_bidang.id_bidang, t_bidang.nama_bidang, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_bidang', 't_anggaran.id_bidang = t_bidang.id_bidang', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_anggaran.id_bidang = '.$id.' AND t_anggaran.id_bidang !=', 0);
        return $this->db->get();
    }

    function getTahunPembiayaan($id,$tahun)
    {
        $this->db->select('id_anggaran, t_pembiayaan.id_pembiayaan, t_pembiayaan.nama_pembiayaan, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_pembiayaan', 't_anggaran.id_pembiayaan = t_pembiayaan.id_pembiayaan', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_anggaran.id_pembiayaan = '.$id.' AND t_anggaran.id_pembiayaan !=', 0);
        return $this->db->get();
    }

    function getTahunProgram($id,$tahun)
    {
        $this->db->select('id_anggaran, t_program.id, t_program.nama_program, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('t_program', 't_anggaran.id_program = t_program.id', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_anggaran.id_program = '.$id.' AND t_anggaran.id_program !=', 0);
        return $this->db->get();
    }

    function getTahunSubProgram($id,$tahun,$bulan)
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, anggaran_semula, t_tahun_anggaran.tahun, t_bulan.bulan');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->join('t_bulan', 't_bulan.id_bulan = t_anggaran.id_bulan', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_bulan.id_bulan', $bulan);
        $this->db->where('t_anggaran.id_realisasi = '."'".$id."'".' AND t_anggaran.id_realisasi !=', 'SPM0');
        return $this->db->get();
    }

    function getTahunSubProgramTahun($id,$tahun)
    {
        $this->db->select('id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, anggaran_semula, t_tahun_anggaran.tahun');
        $this->db->from('t_anggaran');
        $this->db->join('realisasi', 't_anggaran.id_realisasi_pertahun = realisasi.id_realisasi', 'left');
        $this->db->join('t_tahun_anggaran', 't_tahun_anggaran.id_tahun = t_anggaran.id_tahun', 'left');
        $this->db->where('t_tahun_anggaran.id_tahun', $tahun);
        $this->db->where('t_anggaran.id_realisasi_pertahun = '."'".$id."'".' AND t_anggaran.id_realisasi_pertahun !=', 'SPM0');
        return $this->db->get();
    }

    function getById($id)
    {
        $this->db->from('t_anggaran');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getByName($name)
    {
        $this->db->from('t_anggaran');
        $this->db->where('sumber_pendapatan', $name);
        $query = $this->db->get();
        return $query->row();
    }

    function updateAnggaran($where, $data)
    {
        $this->db->update('t_anggaran', $data, $where);
        return $this->db->affected_rows();
    }

    function deletePendapatanById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('t_anggaran');
    }

    public function savePendapatan($data)
    {

        $this->db->insert('t_anggaran', $data);

        return $this->db->insert_id();
    }

    public function rincianTahun($id,$tahun)
    {
        $query = $this->db->query('SELECT id_anggaran, t_pembiayaan.id_pembiayaan AS id_rincian_anggaran_program, t_pembiayaan.nama_pembiayaan AS rincian_anggaran_program , t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi
            FROM t_anggaran
            LEFT JOIN t_tahun_anggaran ON t_anggaran.id_tahun = t_tahun_anggaran.id_tahun
            LEFT JOIN t_pembiayaan ON t_anggaran.id_pembiayaan = t_pembiayaan.id_pembiayaan
            WHERE t_tahun_anggaran.tahun = '.$tahun.'
            AND t_anggaran.id_pembiayaan != 0
            AND t_anggaran.id_pembiayaan = '.$id.'
            UNION
            SELECT id_anggaran, t_program.id AS id_rincian_anggaran_program, t_program.nama_program AS rincian_anggaran_program , t_tahun_anggaran.tahun , t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi
            FROM t_anggaran
            LEFT JOIN t_tahun_anggaran ON t_anggaran.id_tahun = t_tahun_anggaran.id_tahun
            LEFT JOIN t_program ON t_anggaran.id_program = t_program.id
            WHERE t_tahun_anggaran.tahun = '.$tahun.'
            AND t_anggaran.id_program != 0
            AND t_anggaran.id_program = '.$id.'
            ');
        return $query;
    }

    public function rincianTahunSub($id, $idSub, $tahun)
    {
        $query = $this->db->query('
            SELECT id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, t_tahun_anggaran.tahun, t_bulan.bulan, t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi, t_anggaran.serapan
            FROM t_anggaran
            LEFT JOIN realisasi ON t_anggaran.id_realisasi = realisasi.id_realisasi
            LEFT JOIN t_tahun_anggaran ON t_anggaran.id_tahun = t_tahun_anggaran.id_tahun
            LEFT JOIN t_bulan ON t_anggaran.id_bulan = t_bulan.id_bulan
            WHERE realisasi.id_realisasi != '."'SPM0'".'
            AND t_tahun_anggaran.tahun = '.$tahun.'
            AND realisasi.id_realisasi = '."'$idSub'".'
            AND realisasi.id_parent = '.$id.'
            ');
        return $query;
    }

    public function rincianTahunSub2($id, $tahun)
    {
        $query = $this->db->query('
            SELECT id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, t_tahun_anggaran.tahun, t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi
            FROM t_anggaran
            LEFT JOIN realisasi ON t_anggaran.id_realisasi_pertahun = realisasi.id_realisasi
            LEFT JOIN t_tahun_anggaran ON t_anggaran.id_tahun = t_tahun_anggaran.id_tahun
            WHERE realisasi.id_realisasi != '."'SPM0'".'
            AND t_tahun_anggaran.tahun = '.$tahun.'            
            AND realisasi.id_parent = '.$id.'
            ');
        return $query;
    }

    public function rincianTahunSub3($id, $tahun)
    {
        $query = $this->db->query('
            SELECT id_anggaran, realisasi.id_realisasi, realisasi.realisasi, realisasi.parent, t_tahun_anggaran.tahun, t_anggaran.anggaran_semula, t_anggaran.anggaran_menjadi
            FROM t_anggaran
            LEFT JOIN realisasi ON t_anggaran.id_realisasi_pertahun = realisasi.id_realisasi
            LEFT JOIN t_tahun_anggaran ON t_anggaran.id_tahun = t_tahun_anggaran.id_tahun
            WHERE realisasi.id_realisasi != '."'SPM0'".'
            AND t_tahun_anggaran.tahun = '.$tahun.'            
            AND realisasi.id_realisasi = '."'$id'".'
            ');
        return $query;
    }
}
