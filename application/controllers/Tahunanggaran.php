<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunanggaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_tahun_anggaran');
        if (!$this->session->userdata('id_pengguna')) {
            return redirect(base_url('auth/'));
        }
    }

    public function index()
    {
        $data['title'] = "Tahun Anggaran | Pengawasan Dana Desa";
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['tahun'] = $this->m_tahun_anggaran->getAll()->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_tahun_anggaran', $data);
        $this->load->view('admin/template/footer');
    }

    public function tambah()
    {
        $tahun = $this->input->post('tahunAnggaran');
        $row = $this->m_tahun_anggaran->getByName($tahun);
        if ($row > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $tahun . '
            sudah ada!
            </div>
            ');
            echo json_encode(array("status" => true));
        } else {
            $data = array(
                'tahun' => $tahun
            );
            $this->m_tahun_anggaran->saveTahun($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                 Data berhasil ditambah!
              </div>
            ');
            echo json_encode(array("status" => true));
        }
    }

    public function edit($id)
    {
        $data = $this->m_tahun_anggaran->getById($id);
        echo json_encode($data);
    }

    public function update()
    {
        $tahun = $this->input->post('tahunAnggaran');
        $row = $this->m_tahun_anggaran->getByName($tahun);
        if ($row > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $tahun . '
                sudah ada!
            </div>
            '
            );
            echo json_encode(array("status" => true));
            redirect('tahunanggaran','refresh');
        } else {
            $data = array(
                'tahun' => $tahun
            );
            $this->m_tahun_anggaran->updateTahun(array('id_tahun' => $this->input->post('id_tahun')), $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Data berhasil diubah!
            </div>
            '
            );
            echo json_encode(array("status" => true));
            redirect('tahunanggaran','refresh');
        }
    }

    public function delete($id)
    {
        $this->m_tahun_anggaran->deleteTahunById($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
        echo json_encode(array("status" => true));
        redirect('Tahunanggaran','refresh');
    }
}
