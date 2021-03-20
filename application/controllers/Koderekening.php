<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koderekening extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->model('m_kode_rekening');
		$this->load->library('form_validation');
        $this->load->helper('url');
        if (!$this->session->userdata('id_pengguna')) {
        	return redirect( base_url('auth/') );
        }
	}

	public function index()
	{
		$this->db->select('count(id_pengguna) as inactive');
	    $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
		$data['title'] = "Kode Rekening | Pengawasan Dana Desa";
		$this->db->order_by('kode_rek', 'asc');		
		$data['koderek'] = $this->db->get('t_kode_rek')->result();		

		$data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/template/sidebar',$data);
		$this->load->view('admin/v_koderekening');
		$this->load->view('admin/template/footer');
	}

	public function editKoderek($id)
	{
		$data = $this->db->get_where('t_kode_rek', ['id_rek' => $id])->row_array();

		echo json_encode($data);
	}

	public function updateKoderek()
	{	
		$kr = $this->input->post('kodeRek');
		$na = $this->input->post('namaAkun');

		$rowna = $this->m_kode_rekening->getByName($na);
		$rowkr = $this->m_kode_rekening->getByKr($kr);

		if ($rowkr > 0) {
			$this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $kr . '
                sudah ada!
            </div>
            '
            );            
		}else if ($rowna > 0) {
			$this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' . $na . '
                sudah ada!
            </div>
            '
            );
		}else{

			$data = array(
                'kode_rek' => $kr,
                'nama_akun' => $na
            );
            $this->m_kode_rekening->updateKoderekening(array('id_rek' => $this->input->post('id_rek')), $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses</h4>
                Data berhasil diubah!
            </div>
            '
            );
            redirect('koderekening','refresh');
		}		
        echo json_encode(array("status" => true));
        redirect('koderekening','refresh');
	}

	public function deleteKoderek($id)
	{
		$this->db->where('id_rek', $id);
		$this->db->delete('t_kode_rek');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
		// $this->m_bidang->deleteBidangById($id);
		echo json_encode(array("status" => true));
	}

	public function tambahKoderek()
	{
		$kr = $this->input->post('kodeRek');
		$na = $this->input->post('namaAkun');

		$data = array(
			'kode_rek' => $kr,
			'nama_akun' => $na
		);

		$this->db->insert('t_kode_rek', $data);
		
		echo json_encode(array("status" => true));
	}

	public function tambah()
	{
		$this->form_validation->set_rules('kdRek', 'Kode Rekening', 'trim|required|is_unique[t_kode_rek.kode_rek]',['required' => 'Kode Rekening tidak boleh kosong!',
			'is_unique' => 'Kode Rekening sudah ada!']);
		$this->form_validation->set_rules('akun', 'Nama Akun', 'trim|required|is_unique[t_kode_rek.nama_akun]',['required' => 'Nama Akun tidak boleh kosong!',
			'is_unique' => 'Nama Akun sudah ada!']);
		if ($this->form_validation->run() == FALSE) {
			$this->index();			
		} else {
			$data = array(
			'kode_rek' => $this->input->post('kdRek'),
			'nama_akun' => $this->input->post('akun')
			);

			$this->db->insert('t_kode_rek', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambah!
            </div>
            ');		
            redirect('koderekening');
		}

	}
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */