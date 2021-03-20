<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->id_pengguna = $this->session->userdata('id_pengguna');
	}
	public function index()
	{
		if(empty($this->id_pengguna)){
	        redirect(base_url('auth'));
	      	}		
	    $this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();	  
	    $this->db->select('count(id_bidang) as jumlahBidang');  
	    $data['jumlahBidang'] = $this->db->get('t_bidang')->row_array();	    
		$data['title'] = "Dashboard | Pengawasan Dana Desa";
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$data['media'] = $this->db->query('SELECT `t_bidang`.`nama_bidang`, `id_gambar`, `nama_gambar`, `created_at` FROM `t_gambar` LEFT JOIN t_bidang ON t_bidang.id_bidang = t_gambar.id_bidang')->result();
		$this->load->view('admin/template/header',$data); 
        $this->load->view('admin/template/sidebar',$data); 
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/template/footer');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */