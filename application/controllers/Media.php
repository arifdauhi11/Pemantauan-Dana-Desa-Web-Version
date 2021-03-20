<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_bidang');
		$this->load->model('m_media');
		$this->id_pengguna = $this->session->userdata('id_pengguna');
	}

	public function index()
	{
		if(empty($this->id_pengguna)){
	        redirect(base_url('auth'));
	      	}
	    $this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Media | Pengawasan Dana Desa";
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();			
		$data['media'] = $this->db->get('media')->result();
		$data['bidang'] = $this->m_bidang->getAll();
		$this->load->view('admin/template/header',$data); 
        $this->load->view('admin/template/sidebar',$data); 
        $this->load->view('admin/v_media',$data);
        $this->load->view('admin/template/footer');
	}

	public function uploadGambar()
	{
		//Hitung jumlah gambar yg dipilih
		$jumlahGambar = count($_FILES['gambar']['name']);

		// Lakukan perulangan sesuai jumlah gambar
		for ($i=0; $i < $jumlahGambar; $i++):

			// Inisialisasi
			$_FILES['file']['name'] = $_FILES['gambar']['name'][$i];
			$_FILES['file']['type'] = $_FILES['gambar']['type'][$i];
			$_FILES['file']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
			$_FILES['file']['size'] = $_FILES['gambar']['size'][$i];

			// Konfigurasi upload
			$config['upload_path'] = './assets/images/multiple';
			$config['allowed_types'] = 'jpg|png|jpeg';

			// Memanggil library upload dan setting konfigurasi
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) { // Jika Upload berhasi

				$fileData = $this->upload->data(); //Lakukan upload data

				// Membuat variabel untuk dimasukkan ke database
				$uploadData[$i]['id_bidang'] = $this->input->post('bidang', true);			
				$uploadData[$i]['nama_gambar'] = $fileData['file_name'];
			}			
		endfor;	

		if ($uploadData !== null) { //Jika berhasil upload
			
			//Insert ke database
			$insert = $this->m_media->upload($uploadData);

			if ($insert) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambah!
            </div>
            ');		
            redirect('media');
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Gagal!</h4>
            Data gagal ditambah!
            </div>
            ');		
            redirect('media');
			}

		}
	}


}

/* End of file program.php */
/* Location: ./application/controllers/program.php */