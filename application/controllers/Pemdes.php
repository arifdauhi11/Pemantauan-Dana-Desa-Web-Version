<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemdes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// $this->load->model('m_bidang');
		if (!$this->session->userdata('id_pengguna')) {
			return redirect(base_url('auth/'));
		}
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
		$data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Pemerintah Desa | Pengawasan Dana Desa";
		$data['pemdes'] = $this->db->get('t_pemdes')->result();		
		
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		// echo json_encode($data['bidang']);
		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/template/sidebar', $data);
		$this->load->view('admin/v_pemdes', $data);
		$this->load->view('admin/template/footer');
	}

	public function tambah()
	{
		$nama = $this->input->post('namaPemdes');
		$jabatan = $this->input->post('jabatan');
		$foto = $_FILES['image'];

		if ($foto) {
			$config['upload_path'] = './assets/images/pemdes/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']	= '2048';
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('image')) {
				$data = array(
					'nama_pemdes' => $nama,
					'jabatan' => $jabatan,
					'foto' => $this->upload->data('file_name')
				);			
				$this->db->insert('t_pemdes', $data);
				$this->db->affected_rows();

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				Berhasil menambah data pemdes!
				</div>
				');

				redirect('pemdes');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-close"></i> Alert!</h4>
				Gagal menambah data pemdes!
				</div>
				');
				
				redirect('pemdes');
			}
		}		
	}

	public function hapus($id)
	{
		$this->db->where('id_pemdes', $id);
		$this->db->delete('t_pemdes');
		$this->db->affected_rows();

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Alert!</h4>
		Berhasil menghapus data pemdes!
		</div>
		');

		redirect('pemdes');
	}
}

/* End of file pemdes.php */
/* Location: ./application/controllers/pemdes.php */