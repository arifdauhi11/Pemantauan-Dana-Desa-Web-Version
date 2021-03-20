<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('m_web');
		$this->load->model('m_tahun_anggaran');
		$this->load->model('m_anggaran');
	}

	public function index()
	{
		$data['tahun'] = '2019';
		$data['judul'] = "Beranda | Pengawasan Dana Desa";
		$data['apendapatan'] = $this->m_web->getAnggaranPendapatan($data['tahun'])->result();		
		$data['abidang'] = $this->m_web->getAnggaranBidang($data['tahun']);
		$data['pemdes'] = $this->db->get('t_pemdes')->result();		
		$data['jumlah'] = $this->m_web->getJumlahAnggaran($data['tahun'])->row_array();			
		$this->db->order_by('id_saran', 'desc');
		$data['saran'] = $this->db->get_where('saran',['status' => '1'], 3)->result();
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/beranda.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function dandes($tahun)
	{
		$data['tahun'] = '2019';
		$data['judul'] = "Dana Desa | Pengawasan Dana Desa";
		$data['ta'] = $this->m_tahun_anggaran->getAll()->result();
		$data['abidang'] = $this->m_web->getAnggaranBidang($tahun);
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/dandes.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function galeri()
	{
		$data['judul'] = "Galeri | Pengawasan Dana Desa";

		// Pagination
		$config['base_url'] = site_url('web/galeri'); //site url
        $config['total_rows'] = $this->db->count_all('t_gambar'); //total row
        $config['per_page'] = 6;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        //Style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<nav class="pagi clearfix text-center"><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav>';

        $this->pagination->initialize($config);
        
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['galeri'] = $this->m_web->get_galeri_list($config["per_page"], $data['page'])->result();

        $data['pagination'] = $this->pagination->create_links();

        //End Pagination

		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/galeri.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function tentang()
	{
		$data['judul'] = "Tentang | Pengawasan Dana Desa";
		$data['pemdes'] = $this->db->get('t_pemdes')->result();
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/tentang.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function kontak()
	{
		$data['judul'] = "Kontak | Pengawasan Dana Desa";
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/kontak.php');
		$this->load->view('web/template/footer.php');
	}

	public function saranAction()
	{
		$nik = $this->input->post('nik');
		$password = $this->input->post('password');
		$saran = $this->input->post('saran');

        $this->db->select('nik');
        $user = $this->db->get_where('t_pengguna', ['nik' => $nik])->row_array();
        if ($user > 0) {        
        	$this->db->select('id,password');
        	$p = $this->db->get_where('t_pengguna', ['nik' => $nik])->row_array();
        	
        	if ($p['password'] == md5($password)) {	        	
        		$data = array(
        			'id_pengguna' => $p['id'],
        			'saran' => $saran,
        			'status' => '0'
        		);

        		$this->db->insert('t_saran', $data);
        		$this->db->affected_rows();
        		$this->session->set_flashdata('alert', 
        			'<div class="alert alert-success" role="alert" id="alert">
                    	<strong>Terima kasih atas saran anda!</strong>
                    </div>');
        		redirect('kontak');
        	} else {
        		$this->session->set_flashdata('alert', 
        			'<div class="alert alert-danger" role="alert" id="alert">
                    	<strong>Password yang anda masukkan salah!</strong>
                    </div>');
        		redirect('kontak');
        	}
        } else {
        	$this->session->set_flashdata('alert', 
        			'<div class="alert alert-danger" role="alert" id="alert">
                    	<strong>NIK atau password yang anda masukkan salah!</strong>
                    </div>');
        		redirect('kontak');
        }
	}

	public function pendapatan($tahun)
	{				
		$data['tahun'] = '2019';
		$data['judul'] = "Pendapatan | Pengawasan Dana Desa";
		$data['ta'] = $this->m_tahun_anggaran->getAll()->result();
		$data['apendapatan'] = $this->m_web->getAggaranPendapatan($tahun)->result();			
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/pendapatan.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function program($tahun, $bidang)
	{
		$data['tahun'] = '2019';
		$data['judul'] = "Program | Pengawasan Dana Desa";
		$data['ta'] = $this->m_tahun_anggaran->getAll()->result();
		$data['aprogram'] = $this->m_web->getAggaranProgram($tahun, $bidang)->result();					
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/program.php',$data);
		$this->load->view('web/template/footer.php');
	}

	public function notfound()
	{
		$data['judul'] = "404 - Not Found";
		$this->load->view('web/template/header.php', $data);
		$this->load->view('web/404.php');
		$this->load->view('web/template/footer.php');
	}

}
