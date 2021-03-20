<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sumberpendapatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_sumber_pendapatan');
        if (!$this->session->userdata('id_pengguna')) {
            return redirect(base_url('auth/'));
        }
    }

    public function index()
    {
        $data['title'] = "Sumber Pendapatan | Pengawasan Dana Desa";
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['pendapatan'] = $this->m_sumber_pendapatan->getAll()->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_sumber_pendapatan', $data);
        $this->load->view('admin/template/footer');
    }

    public function tambah()
    {
        $pendapatan = $this->input->post('sumberPendapatan');
        $row = $this->m_sumber_pendapatan->getByName($pendapatan);
        if ($row > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $pendapatan . '
            sudah ada!
            </div>
            ');
            echo json_encode(array("status" => true));
        } else {
            $data = array(
                'sumber_pendapatan' => $pendapatan
            );
            $this->m_sumber_pendapatan->savePendapatan($data);
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
        $data = $this->m_sumber_pendapatan->getById($id);
        echo json_encode($data);
    }

    public function update()
    {
        $pendapatan = $this->input->post('sumberPendapatan');
        $row = $this->m_sumber_pendapatan->getByName($pendapatan);
        if ($row > 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $pendapatan . '
                sudah ada!
            </div>
            '
            );
            echo json_encode(array("status" => true));
            redirect('Sumberpendapatan','refresh');
        } else {
            $data = array(
                'sumber_pendapatan' => $pendapatan
            );
            $this->m_sumber_pendapatan->updatePendapatan(array('id_pendapatan' => $this->input->post('id_pendapatan')), $data);
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
            redirect('Sumberpendapatan','refresh');
        }
    }

    public function delete($id)
    {
        $this->m_sumber_pendapatan->deletePendapatanById($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
        echo json_encode(array("status" => true));
        redirect('Sumberpendapatan','refresh');
    }
}

/* End of file Sumberpendapatan.php */
/* Location: ./application/controllers/Sumberpendapatan.php */
