<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('id_pengguna')) {
        	redirect('auth');
        }
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();	
		$data['title'] = "Profile | Pengawasan Dana Desa";
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();	
		$data['role'] = $this->db->get('t_role')->result();		
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/template/sidebar',$data);
		$this->load->view('admin/v_user_profile',$data);
		$this->load->view('admin/template/footer');		
		
	}

	public function updateProfil()
	{
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');

		if ($this->form_validation->run() ==  FALSE) {
			$this->index();
		} else {
			$nama = $this->input->post('nama');
			$nik = $this->input->post('nik');

			$image = $_FILES['image'];	
			
			if ($image) {				
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']	= '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old = $data['user']['image'];
										
					if ($old != 'default.png') {
						unlink(FCPATH . 'assets/images/' . $old);
					}
					$new = $this->upload->data('file_name');					
					$this->db->set('image',$new);
				} else {
					echo $this->upload->display_errors();
				}	
			}			
			$this->db->set('nik',$nik);
			$this->db->set('nama',$nama);
			$this->db->where('nik', $nik);
			$this->db->update('t_pengguna');
			$this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Alert!</h4>
				Berhasil mengubah data!
				</div>
				');
				redirect('profile');
		}
	}

	public function updatePassword()
	{
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->form_validation->set_rules('lama', 'Password Lama', 'trim|required', ['required' => 'Password Lama tidak boleh kosong!']);
		$this->form_validation->set_rules('baru', 'Password Baru', 'trim|required|min_length[6]', ['required' => 'Password Baru tidak boleh kosong!',
			'min_length' => 'Password Baru terlalu pendek!'
		]);
		$this->form_validation->set_rules('konfir', 'Konfirmasi Password Baru', 'trim|required|min_length[6]|matches[baru]',['required' => 'Konfirmasi Password Baru tidak boleh kosong!','min_length' => 'Konfirmasi Password Baru terlalu pendek!', 'matches' => 'Konfirmasi Password Baru harus sama dengan Password Baru!']);
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$pwd_lama = md5($this->input->post('lama'));
			$pwd_baru = md5($this->input->post('baru'));

			if ($pwd_lama !== $data['user']['password']) {
				$this->session->set_flashdata('alert', '<div class="callout callout-warning">	
				<h4>Password Lama salah!</h4>				
				</div>
				');
				redirect('profile');
			}else{
				if ($pwd_lama === $pwd_baru) {
				$this->session->set_flashdata('alert', '<div class="callout callout-warning"><h4>Password Lama tidak boleh sama dengan Password Baru!</h4>				
				</div>
				');
				redirect('profile');
				}else{
					$this->db->set('password', $pwd_baru);
					$this->db->where('nik', $this->session->userdata('nik'));
					$this->db->update('t_pengguna');

					$this->session->set_flashdata('alert', '<div class="callout callout-success"><h4>Password berhasil diupdate!</h4>				
					</div>
					');
					redirect('profile');
				}
			}
		}
	}

}