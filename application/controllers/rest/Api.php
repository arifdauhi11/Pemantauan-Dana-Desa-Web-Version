<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_bidang');
        $this->load->model('m_anggaran');
    }

    public function users_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $penggunas = $this->m_user->getAll();            
        } else {
            $penggunas = $this->m_user->getById($id)->result();
        }   

        if (count($penggunas) > 0) {
            $this->response( 
                    array('status' => true, 
                          'message' => 'Users Found',
                          'data' => $penggunas), RestController::HTTP_OK );
        } else {
            $this->response( 
                    array('status' => false, 
                          'message' => 'Users Not Found',
                          'data' => $penggunas), RestController::HTTP_NOT_FOUND );
        }
    }

    public function users_post()
    {
        
        $nik = $_POST['nik'];
        $pass = $_POST['password'];

        $this->db->select('nik');
        $pengguna = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();   

        if ( $pengguna['nik'] > 0)
        {   
            $detailPengguna = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();
            if ($detailPengguna['password'] != md5($pass)) {
                $this->response( [
                    'status' => false,
                    'message' => 'Password yang anda masukkan salah!'
                ], RestController::HTTP_OK );        
            } else {                                                                            
                $this->response( [
                    'status' => true,
                    'message' => 'Berhasil login',
                    'data' => array($detailPengguna)
                ], RestController::HTTP_OK );                                                    
            }
        } else {
            $this->response( [
                'status' => false,
                'message' => 'NIK yang anda masukkan salah!'
            ], RestController::HTTP_OK );
        }                                             
    }    

    public function bidang_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $bidang = $this->m_bidang->getAll();                    
        } else {
            $bidang = $this->m_bidang->getById($id)->result();
        }

        if (count($bidang) > 0) {
            $this->response( $bidang, RestController::HTTP_OK );
        } else {
            $this->response($bidang, RestController::HTTP_OK );
        }
    }

    public function apendapatan_get()
    {

        $id = $this->get('id');

        if ($id === null) {
            $data = $this->db->query('SELECT `t_sumber_pendapatan`.`id_pendapatan`, `t_sumber_pendapatan`.`sumber_pendapatan`, anggaran_semula, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun FROM `t_anggaran` LEFT JOIN t_sumber_pendapatan ON t_sumber_pendapatan.id_pendapatan = t_anggaran.id_pendapatan LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun WHERE t_anggaran.id_pendapatan != 0 AND t_tahun_anggaran.id_tahun = 1 ORDER BY `t_sumber_pendapatan`.`sumber_pendapatan` ASC')->result();
        } else {
            $data = $this->db->query('SELECT `t_sumber_pendapatan`.`id_pendapatan`, `t_sumber_pendapatan`.`sumber_pendapatan`, anggaran_semula, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun FROM `t_anggaran` LEFT JOIN t_sumber_pendapatan ON t_sumber_pendapatan.id_pendapatan = t_anggaran.id_pendapatan LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun WHERE t_anggaran.id_pendapatan != 0 AND t_anggaran.id_pendapatan = '.$id.' ORDER BY anggaran ASC')->result();
        }

        if (count($data) > 0) {
            $this->response( $data, RestController::HTTP_OK );
        } else {
            $this->response($data, RestController::HTTP_NOT_FOUND );
        }
    }

    public function abidang_get()
    {
        
        $id = $this->get('id');

        if ($id === null) {
            $data = $this->db->query('SELECT `t_bidang`.`id_bidang`, `t_bidang`.`nama_bidang`, anggaran_semula, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun FROM `t_anggaran` LEFT JOIN t_bidang ON t_bidang.id_bidang = t_anggaran.id_bidang LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun WHERE t_anggaran.id_bidang != 0 ORDER BY anggaran ASC')->result_array();
            // $data = $this->db->query('SELECT SUM(anggaran) jumlah FROM `t_anggaran` WHERE id_pendapatan != 0')->row_array();
            // var_dump($data);
            // die;
        } else {
            $data = $this->db->query('SELECT `t_bidang`.`id_bidang`, `t_bidang`.`nama_bidang`, anggaran, t_tahun_anggaran.tahun, t_tahun_anggaran.id_tahun FROM `t_anggaran` LEFT JOIN t_bidang ON t_bidang.id_bidang = t_anggaran.id_bidang LEFT JOIN t_tahun_anggaran ON t_tahun_anggaran.id_tahun = t_anggaran.id_tahun WHERE t_anggaran.id_bidang != 0 AND t_anggaran.id_bidang = '.$id.' ORDER BY anggaran ASC')->result();
        }

        if (count($data) > 0) {
            $this->response( $data, RestController::HTTP_OK );
        } else {
            $this->response($data, RestController::HTTP_NOT_FOUND );
        }
    }

    public function galeri_get()
    {
        
        $id = $this->get('id');

        if ($id === null) {
            $data = $this->db->query('SELECT `t_bidang`.`nama_bidang`, `id_gambar`, `nama_gambar`, `created_at` FROM `t_gambar` LEFT JOIN t_bidang ON t_bidang.id_bidang = t_gambar.id_bidang')->result();
        } else {
            $data = $this->db->query('SELECT `t_bidang`.`nama_bidang`, `id_gambar`, `nama_gambar`, `created_at` FROM `t_gambar` LEFT JOIN t_bidang ON t_bidang.id_bidang = t_gambar.id_bidang WHERE id_gambar = '.$id)->result();
        }

        if (count($data) > 0) {
            $this->response( array('data' => $data), RestController::HTTP_OK );
        } else {
            $this->response($data, RestController::HTTP_NOT_FOUND );
        }
    }

    public function program_get()
    {
        
        $this->response( $this->db->get('detail_program')->result_array(), RestController::HTTP_OK );
    }

    public function rincian_post()
    {
        $id = $_POST['id'];
        $idS = "'".$id."'";
        $tahun = $_POST['tahun'];
        $rincian = $this->m_anggaran->rincianTahun($idS,$tahun)->result_array();        

        if ($rincian) {
            $id = $rincian[0]['id_rincian_anggaran_program'];
            $program = $rincian[0]['rincian_anggaran_program'];
            $tahun = $rincian[0]['tahun'];
            $anggaran_semula = $rincian[0]['anggaran_semula'];
            $anggaran_menjadi = $rincian[0]['anggaran_menjadi']; 
            if (intval($anggaran_menjadi) > 0) {
                $persentase = $anggaran_menjadi / $anggaran_menjadi * 100;
            } else {
                $persentase = $anggaran_semula / $anggaran_semula * 100;
            }

            $this->response(
            array(
                'status' => true,
                'message' => 'Data tersedia',
                'program' => array([
                    'id' => $id,
                    'program' => $program,
                    'tahun' => $tahun,
                    'semula' => $anggaran_semula,
                    'menjadi' => $anggaran_menjadi,
                    'persentase' => $persentase.'%'
                ])                
            ), RestController::HTTP_OK
        );                                
        } else {
            $this->response(
            array(
                'status' => false,
                'message' => 'Data yang anda pilih belum tersedia'
            ), RestController::HTTP_OK
        );                    
        }
        
    }

    public function rincians_post()
    {
        $id = $_POST['id'];
        $idS = "'".$id."'";
        $tahun = $_POST['tahun'];
        $rincian = $this->m_anggaran->rincianTahun($idS,$tahun)->result();
        $rincians = $this->m_anggaran->rincianTahunSub($idS,$tahun)->result();
        $semula = 0;
        $menjadi = 0;
        foreach ($rincian as $key) {
            $semula = $key->anggaran_semula;
            $menjadi = $key->anggaran_menjadi;
        }
        $count = count($rincians);
        $no = 1;
        $jumlah = 0;
        $persentase = 0;
        if ($rincians) {
            foreach ($rincians as $row) {
                if ($row->anggaran_menjadi > 0) {
                    $jumlah += $row->anggaran_menjadi;
                    $persentase = $row->anggaran_menjadi / $menjadi * 100;                                        
                } else {
                    $jumlah += $row->anggaran_semula;
                    $persentase = $row->anggaran_semula / $semula * 100;                    
                }                        
            }

            if ($menjadi > 0) {
                $persentasej = $jumlah / $menjadi * 100;
            } else {
                $persentasej = $jumlah / $semula * 100;
            }

            $this->response(
                array(
                    'status' => true,
                    'semula' => $semula,
                    'menjadi' => $menjadi,
                    'subprogram' => $rincians
                )
            , RestController::HTTP_OK );                                    
        } else {
            $this->response(
            array(
                'status' => false,
                'message' => 'Data untuk program yang anda pilih belum tersedia'
            )
            , RestController::HTTP_OK );
        }        

    }

    public function rt_post()
    {
        $id = $_POST['id'];
        $tahun = $_POST['tahun'];
        $anggaran = 0;
        $subProg = $this->m_anggaran->rincianTahunSub2($id,$tahun)->result();
        $data = array();    
        foreach ($subProg as $key => $value) {
            $id_anggaran = $value->id_anggaran;
            $id_realisasi = $value->id_realisasi;
            $realisasi = $value->realisasi;
            $parent = $value->parent;
            $tahun = $value->tahun;
            $asemula = $value->anggaran_semula;
            $amenjadi = $value->anggaran_menjadi;  
            $semula = "Rp. " . number_format($value->anggaran_semula,2,',','.');
            $menjadi = "Rp. " . number_format($value->anggaran_menjadi,2,',','.');  
            $data[$key] = array(
                'id_anggaran' => $id_anggaran,
                'id_realisasi' => $id_realisasi,
                'amenjadi' => $amenjadi,
                'asemula' => $asemula,
                'realisasi' => $realisasi,
                'parent' => $parent,
                'tahun' => $tahun,
                'semula' => $semula,
                'menjadi' => $menjadi
            );           
        }        
        
        if ($data) {
            $this->response([
            'status' => true,
            'message' => 'Data tersedia',
            'subprogram' => $data], RestController::HTTP_OK );    
        } else {
            $this->response([
            'status' => false,
            'message' => 'Data belum tersedia.'], RestController::HTTP_OK );
        }
    }

    public function rb_post()
    {
        $id = $_POST['id'];
        $idSub = $_POST['sub'];
        $tahun = $_POST['tahun'];

        $anggaran = 0;
        $subProg2 = $this->m_anggaran->rincianTahunSub3($idSub,$tahun)->row();
        if ($subProg2) {
            if ($subProg2->anggaran_menjadi > 0) {
                $anggaran = $subProg2->anggaran_menjadi;
            } else {
                $anggaran = $subProg2->anggaran_semula;
            }            
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
        if ($data) {
            $this->response([
            'status' => true,
            'message' => 'Data tersedia',
            'subprogram' => $data], RestController::HTTP_OK );    
        } else {
            $this->response([
            'status' => false,
            'message' => 'Data belum tersedia.'], RestController::HTTP_OK );
        }
        
    }

    public function saran_get()
    {
        $this->db->order_by('id_saran', 'desc');
        $this->response($this->db->get_where('saran',['status' => '1'])->result(), RestController::HTTP_OK );                                            
    }

    public function saran_post()
    {
        $nik = $_POST['nik'];
        $pass = $_POST['password'];
        $saran = $_POST['saran'];
        $this->db->select('nik');
        $pengguna = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();   

        if ( $pengguna['nik'] > 0)
        {   
            $detailPengguna = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();
            if ($detailPengguna['password'] != md5($pass)) {
                $this->response( [
                    'status' => false,
                    'message' => 'Password yang anda masukkan salah!'
                ], RestController::HTTP_OK );        
            } else {                       
                $object = array(
                    'id_pengguna' => $detailPengguna['id_pengguna'],
                    'saran' => $saran,
                    'status' => '0'
                );
                $this->db->insert('t_saran', $object);                                                     
                $this->db->affected_rows();
                $this->response( [
                    'status' => true,
                    'message' => 'Terima kasih atas saran anda!'
                ], RestController::HTTP_OK );                                                    
            }
        } else {
            $this->response( [
                'status' => false,
                'message' => 'NIK yang anda masukkan salah!'
            ], RestController::HTTP_OK );
        }
    }

}