<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_anggaran');
        if (!$this->session->userdata('id_pengguna')) {
            return redirect(base_url('auth/'));
        }
    }

    public function index()
    {
        $data['title'] = "Realisasi | Pengawasan Dana Desa";
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['detail_program'] = $this->db->get('detail_program')->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_realisasi', $data);
        $this->load->view('admin/template/footer');
    }

    public function rincian($id,$tahun)
    {
        $data['title'] = "Realisasi | Pengawasan Dana Desa";
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['tahun'] = $this->db->get('t_tahun_anggaran')->result();
        $data['rincianTahun'] = $this->m_anggaran->rincianTahun($id,$tahun)->result();
        // $data['rincianTahunSub'] = $this->m_anggaran->rincianTahunSub($id, $tahun)->result();
        $data['rincianTahunSub2'] = $this->m_anggaran->rincianTahunSub2($id,$tahun)->result();
        
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_rincian', $data);
        $this->load->view('admin/template/footer');
    }

    public function detailSub($id,$idSub,$tahun)
    {
        $anggaran = 0;
        $subProg2 = $this->m_anggaran->rincianTahunSub3($idSub,$tahun)->row();
        if ($subProg2->anggaran_menjadi > 0) {
            $anggaran = $subProg2->anggaran_menjadi;
        } else {
            $anggaran = $subProg2->anggaran_semula;
        }
        $subProg = $this->m_anggaran->rincianTahunSub($id,$idSub,$tahun)->result();
        $data = array();
        $jumlah = 0;
        foreach ($subProg as $key => $value) {
            $id_anggaran = $value->id_anggaran;
            $id_realisasi = $value->id_realisasi;
            $realisasi = $value->realisasi;
            $parent = $value->parent;
            $tahun = $value->tahun;
            $bulan = $value->bulan;
            $asemula = $value->anggaran_semula;
            $amenjadi = $value->anggaran_menjadi;
            $semula = "Rp. " . number_format($value->anggaran_semula,2,',','.');
            $menjadi = "Rp. " . number_format($value->anggaran_menjadi,2,',','.');            
            $serapan = "Rp. " . number_format($value->serapan,2,',','.');
            $sisa = 0;
            if ($value->anggaran_menjadi > 0) {
                $sisa = $value->anggaran_menjadi - $value->serapan;
                $jumlah += $amenjadi; 
            } else {
                $sisa = $value->anggaran_semula - $value->serapan;
                $jumlah += $asemula;
            }
            $s = "Rp. " . number_format($sisa,2,',','.');
            $j = "Rp. " . number_format($jumlah,2,',','.');
            $data[$key] = array(
                'id_anggaran' => $id_anggaran,
                'id_realisasi' => $id_realisasi,
                'amenjadi' => $amenjadi,
                'asemula' => $asemula,
                'realisasi' => $realisasi,
                'parent' => $parent,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'semula' => $semula,
                'menjadi' => $menjadi,
                'serapan' => $serapan,
                'sisa' => $s,
                'jumlah' => $j,
                'anggaran' => $anggaran
            );
        }
        echo json_encode($data);        
    }

}

/* End of file realisasi.php */
/* Location: ./application/controllers/realisasi.php */