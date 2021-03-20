<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_bidang');
		if (!$this->session->userdata('id_pengguna')) {
			return redirect(base_url('auth/'));
		}
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
		$data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Bidang | Pengawasan Dana Desa";
		$data['bidang'] = $this->m_bidang->getAll();
		
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		// echo json_encode($data['bidang']);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/v_bidang', $data);
		$this->load->view('admin/template/footer');
	}

	public function editBidang($id)
	{
		$data = $this->m_bidang->getById($id)->row();
		echo json_encode($data);
	}

	public function updateBidang()
	{
		$bidang = $this->input->post('namaBidang');
		$row = $this->m_bidang->getByName($bidang);
		if ($row > 0) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $bidang . '
	            sudah ada!
	        </div>
	        '
			);
			echo json_encode(array("status" => true));
			redirect('bidang','refresh');
		} else {
			$data = array(
				'nama_bidang' => $bidang
			);
			$this->m_bidang->updateBidang(array('id_bidang' => $this->input->post('id_bidang')), $data);
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
			redirect('bidang','refresh');			
		}
	}

	public function tambahBidang()
	{
		$bidang = $this->input->post('namaBidang');
		$row = $this->m_bidang->getByName($bidang);
		if ($row > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $bidang . '
	        sudah ada!
	        </div>
	        ');
			echo json_encode(array("status" => true));
			redirect('bidang','refresh');			
		} else {
			$data = array(
				'nama_bidang' => $bidang
			);
			$this->m_bidang->saveBidang($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses</h4>
	             Data berhasil ditambah!
	          </div>
	        ');
			echo json_encode(array("status" => true));
			redirect('bidang','refresh');			
		}
	}

	public function deleteBidang($id)
	{
		$this->m_bidang->deleteBidangById($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
		echo json_encode(array("status" => true));
		redirect('bidang','refresh');
	}


	public function subBidang()
	{
		$this->db->select('count(id_pengguna) as inactive');
		$data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Sub Bidang | Pengawasan Dana Desa";
		$data['subbidang'] = $this->db->get('t_sub_bidang')->result();
		
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		// echo json_encode($data['bidang']);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/v_sub_bidang', $data);
		$this->load->view('admin/template/footer');
	}	

	public function editSubBidang($id)
	{
		$data = $this->db->get_where('t_sub_bidang', ['id_sub_bidang' => $id])->row();
		echo json_encode($data);
	}

	public function updateSubBidang()
	{
		$subbidang = $this->input->post('subBidang');
		$row = $this->db->get_where('t_sub_bidang', ['sub_bidang' => $subbidang])->row();
		if ($row > 0) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $subbidang . '
	            sudah ada!
	        </div>
	        '
			);
			echo json_encode(array("status" => true));
			redirect('subbidang','refresh');
		} else {
			$data = array(
				'sub_bidang' => $subbidang
			);
			$this->db->update(array('id_sub_bidang' => $this->input->post('id_sub_bidang')), $data);
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
			redirect('subbidang','refresh');			
		}
	}

	public function tambahSubBidang()
	{
		$subbidang = $this->input->post('subBidang');
		$row = $this->db->get_where('t_sub_bidang', ['sub_bidang' => $subbidang])->row();
		if ($row > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $subbidang . '
	        sudah ada!
	        </div>
	        ');
			echo json_encode(array("status" => true));
			redirect('bidang','refresh');			
		} else {
			$data = array(
				'sub_bidang' => $subbidang
			);
			$this->db->insert('t_sub_bidang', $data);					
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses</h4>
	             Data berhasil ditambah!
	          </div>
	        ');
			echo json_encode(array("status" => true));
			redirect('subbidang','refresh');			
		}
	}

	public function deleteSubBidang($id)
	{
		$this->db->where('id_sub_bidang', $id);
		$this->db->delete('t_sub_bidang');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
		echo json_encode(array("status" => true));
		redirect('subbidang','refresh');
	}
}