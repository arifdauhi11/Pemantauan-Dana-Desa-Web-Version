<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->id_pengguna = $this->session->userdata('id_pengguna');
		if (!$this->session->userdata('id_pengguna')) {
			return redirect(base_url('auth/'));
		}
	}
	public function index()
	{		
	    $this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Program | Pengawasan Dana Desa";
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$data['program'] = $this->db->get('programs')->result();
		$data['bidang'] = $this->db->get('t_bidang')->result();
		$data['subbidang'] = $this->db->get('t_sub_bidang')->result();
		$this->load->view('admin/template/header',$data); 
        $this->load->view('admin/template/sidebar',$data); 
        $this->load->view('admin/v_program',$data);
        $this->load->view('admin/template/footer');
	}

	public function tambah()
	{

		$this->form_validation->set_rules('namaProgram', 'Nama Program', 'trim|required|is_unique[t_program.nama_program]',['required' => 'Nama Program tidak boleh kosong!',
			'is_unique' => 'Nama Program sudah ada!']);
		if ($this->form_validation->run() == FALSE) {
			$this->index();			
		} else {

			$data = array(			
			'nama_program' => $this->input->post('namaProgram'),
			'id_bidang' => $this->input->post('bidang'),
			'id_sub_bidang' => $this->input->post('subbidang')
			);				

			$this->db->insert('t_program', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambah!
            </div>
            ');		
            redirect('program');
		}
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('t_program');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
        Data berhasil dihapus!
        </div>
        ');		
        redirect('program');
	}

	public function subProgram()
	{
		$this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Sub Program | Pengawasan Dana Desa";
		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->db->order_by('id', 'asc');
		$data['subprogram'] = $this->db->get('sub_programs')->result();
		$data['program'] = $this->db->get('t_program')->result();		
		$this->load->view('admin/template/header',$data); 
        $this->load->view('admin/template/sidebar',$data); 
        $this->load->view('admin/v_sub_program',$data);
        $this->load->view('admin/template/footer');
	}

	public function tambahSubProgram()
	{

		$this->form_validation->set_rules('subProgram', 'Sub Program', 'trim|required',['required' => 'Sub Program tidak boleh kosong!']);
		if ($this->form_validation->run() == FALSE) {
			$this->index();			
		} else {
			$this->db->where('id_program', $this->input->post('program'));
			$this->db->where('sub_program', $this->input->post('subProgram'));
			$sub = $this->db->get('t_sub_program')->row();
			if ($sub) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
		        Data yang ditambahkan sudah ada!
		        </div>
		        ');				        
			} else {
				$this->db->select('id_sub_program');								
				$sub = $this->db->get('t_sub_program')->result();
				$index = 1;
				foreach ($sub as $key) {
					$iSP = str_replace("SPR", "", "SPR".$index++);
				}				
				$kd = "SPR".strval($iSP+1);
				$data = array(			
				'id_sub_program' => $kd,
				'id_program' => $this->input->post('program'),
				'sub_program' => $this->input->post('subProgram')
				);				
				echo "<pre>";
				print_r ($sub);
				echo "</pre>";
				die;
				$this->db->insert('t_sub_program', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
	            Data berhasil ditambah!
	            </div>
	            ');			            
			}
			redirect('subprogram');
			
		}
	}

}

/* End of file program.php */
/* Location: ./application/controllers/program.php */