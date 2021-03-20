<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_pengguna')) {
			return redirect(base_url('auth/'));
		}
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
		$data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Saran | Pengawasan Dana Desa";
		$data['saran'] = $this->db->get('saran')->result();
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/v_saran', $data);
		$this->load->view('admin/template/footer');
	}

	public function upStatus($id, $status)
	{
		if ($status == '0') {
			$status = '1';
			$data = array(
				'status' => $status
			);
			$this->db->where('id_saran', $id);
			$this->db->update('t_saran', $data);
			$this->db->affected_rows();
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Saran telah disetujui.
              </div>
            ');
            redirect('saran');
		} else if ($status == '1') {
			$status = '0';
			$data = array(
				'status' => $status
			);
			$this->db->where('id_saran', $id);
			$this->db->update('t_saran', $data);
			$this->db->affected_rows();
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Saran tidak disetujui.
              </div>
            ');
            redirect('saran');
		}
	}

	public function deleteSaran($id)
	{
		$this->db->where('id_saran', $id);
		$this->db->delete('t_saran');
		$this->db->affected_rows();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Saran berhasil dihapus.
              </div>
            ');
		redirect('saran');	
	}
}

/* End of file saran.php */
/* Location: ./application/controllers/saran.php */