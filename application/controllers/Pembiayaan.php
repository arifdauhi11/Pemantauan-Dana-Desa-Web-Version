<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembiayaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_pembiayaan');
		if (!$this->session->userdata('id_pengguna')) {
			return redirect(base_url('auth/'));
		}
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
		$data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Pembiayaan | Pengawasan Dana Desa";
		$data['pembiayaan'] = $this->m_pembiayaan->getAll();		
		$data['subpembiayaan'] = $this->db->get('sub_pembiayaans')->result();
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/v_pembiayaan', $data);
		$this->load->view('admin/template/footer');
	}

	public function editPembiayaan($id)
	{
		$data = $this->m_pembiayaan->getById($id)->row();
		echo json_encode($data);
	}

	public function updatePembiayaan()
	{
		$pembiayaan = $this->input->post('namaPembiayaan');
		$row = $this->m_pembiayaan->getByName($pembiayaan);
		if ($row > 0) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $pembiayaan . '
	            sudah ada!
	        </div>
	        '
			);
			echo json_encode(array("status" => true));
			redirect('pembiayaan','refresh');
		} else {
			$data = array(
				'nama_pembiayaan' => $pembiayaan
			);
			$this->m_pembiayaan->updatePembiayaan(array('id_pembiayaan' => $this->input->post('id_pembiayaan')), $data);
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
			redirect('pembiayaan','refresh');			
		}
	}

	public function tambahPembiayaan()
	{
		$pembiayaan = $this->input->post('namaPembiayaan');
		$row = $this->m_pembiayaan->getByName($pembiayaan);
		if ($row > 0) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-warning alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $pembiayaan . '
	            sudah ada!
	        </div>
	        '
			);
			echo json_encode(array("status" => true));
			redirect('pembiayaan','refresh');
		} else {
			$data = array(
				'nama_pembiayaan' => $pembiayaan
			);
			$this->m_pembiayaan->savePembiayaan($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses</h4>
	             Data berhasil ditambah!
	          </div>
	        ');
			echo json_encode(array("status" => true));
			redirect('pembiayaan','refresh');			
		}
	}

	public function deletePembiayaan($id)
	{
		$this->m_pembiayaan->deletePembiayaanById($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
		echo json_encode(array("status" => true));
		redirect('pembiayaan','refresh');
	}

	public function tambahSubPembiayaan()
	{

		$this->form_validation->set_rules('subPembiayaan', 'Sub Pembiayaan', 'trim|required',['required' => 'Sub Pembiayaan tidak boleh kosong!']);
		if ($this->form_validation->run() == FALSE) {
			$this->index();			
		} else {
			$this->db->where('id_pembiayaan', $this->input->post('pembiayaan'));
			$this->db->where('sub_pembiayaan', $this->input->post('subPembiayaan'));
			$sub = $this->db->get('t_sub_pembiayaan')->row();
			if ($sub) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
		        Data yang ditambahkan sudah ada!
		        </div>
		        ');				        
			} else {
				$this->db->select('id_sub_pembiayaan');								
				$sub = $this->db->get('t_sub_pembiayaan')->result();
				$index = 1;
				foreach ($sub as $key) {
					$iSM = str_replace("SPM", "", "SPM".$index++);
				}				
				$kd = "SPM".strval($iSM+1);
				$data = array(			
				'id_sub_pembiayaan' => $kd,
				'id_pembiayaan' => $this->input->post('pembiayaan'),
				'sub_pembiayaan' => $this->input->post('subPembiayaan')
				);				

				$this->db->insert('t_sub_pembiayaan', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
	            Data berhasil ditambah!
	            </div>
	            ');			            
			}
			redirect('pembiayaan');
			
		}
	}

}

/* End of file pembiayaan.php */
/* Location: ./application/controllers/pembiayaan.php */