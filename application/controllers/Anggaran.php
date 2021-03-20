<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_anggaran');
        if (!$this->session->userdata('id_pengguna')) {
            return redirect(base_url('auth/'));
        }
    }

    public function index()
    {
        $data['title'] = "Anggaran | Pengawasan Dana Desa";
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['apendapatan'] = $this->m_anggaran->getAggaranPendapatan()->result();
        $data['abidang'] = $this->m_anggaran->getAggaranBidang()->result();
        $data['apembiayaan'] = $this->m_anggaran->getAggaranPembiayaan()->result();
        $data['aprogram'] = $this->m_anggaran->getAggaranProgram()->result();
        $data['asubprogram'] = $this->m_anggaran->getAggaranSubProgram()->result();
        $data['asubprogramtahun'] = $this->m_anggaran->getAggaranSubProgramTahun()->result();
        $data['pendapatan'] = $this->db->get('t_sumber_pendapatan')->result();
        $data['bidang'] = $this->db->get('t_bidang')->result();
        $data['program'] = $this->db->get('t_program')->result();
        $data['subprogram'] = $this->db->get('realisasi')->result();
        // echo '<pre>';

        // var_dump($data['subprogram']);
        // echo '</pre>';
        // die;
        $data['pembiayaan'] = $this->db->get('t_pembiayaan')->result();
        $data['tahun'] = $this->db->get('t_tahun_anggaran')->result();        
        $data['bulan'] = $this->db->get('t_bulan')->result();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/v_anggaran', $data);
        $this->load->view('admin/template/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('anggaran', 'Anggaran', 'trim|required',['required' => 'Anggaran tidak boleh kosong!']);        
        if ($this->form_validation->run() == FALSE) {
            $this->index();         
        } else {

            if (is_null($this->input->post('bidang'))) {
                $bidang = 0;
                $b = 0;
            }else{
                $bidang = $this->input->post('bidang');
                $b = 0;
            }
            if (is_null($this->input->post('pendapatan'))) {
                $pendapatan = 0;
                $b = 0;
            }else{
                $pendapatan = $this->input->post('pendapatan');
                $b = 0;
            }
            if (is_null($this->input->post('pembiayaan'))) {
                $pembiayaan = 0;
                $b = 0;
            }else{
                $pembiayaan = $this->input->post('pembiayaan');
                $b = 0;
            }
            if (is_null($this->input->post('program'))) {
                $program = 0;
                $b = 0;
            }else{
                $program = $this->input->post('program');
                $b = 0;
            }
            if (is_null($this->input->post('subProgramTahun'))) {
                $subProgramTahun = 'SPM0';
                $b = 0;
            }else{
                $subProgramTahun = $this->input->post('subProgramTahun');
                $b = 0;
            }
            if (is_null($this->input->post('subProgram'))) {
                $subprogram = 'SPM0';
                $b = 0;
            }else{
                $subprogram = $this->input->post('subProgram');
                $b = $this->input->post('bulan');
            }

            $t = $this->input->post('tahun');                            
            $getPendapatan = $this->m_anggaran->getTahunPendapatan($pendapatan,$t)->row_array();
            $getBidang = $this->m_anggaran->getTahunBidang($bidang,$t)->row_array();            
            $getPembiayaan = $this->m_anggaran->getTahunPembiayaan($pembiayaan,$t)->row_array();
            $getProgram = $this->m_anggaran->getTahunProgram($program,$t)->row_array();
            $getSubProgram = $this->m_anggaran->getTahunSubProgram($subprogram,$t,$b)->row_array();
            $getSubProgramTahun = $this->m_anggaran->getTahunSubProgramTahun($subProgramTahun,$t)->row_array();

            if ($getPendapatan) {
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getPendapatan['sumber_pendapatan'].' Tahun '.$getPendapatan['tahun'].'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            } 
            
            if ($getBidang){
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getBidang['nama_bidang'].' Tahun '.$getBidang['tahun'].'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            }            

            if ($getPembiayaan){
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getPembiayaan['nama_pembiayaan'].' Tahun '.$getPembiayaan['tahun'].'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            }

            if ($getProgram){
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getProgram['nama_program'].' Tahun '.$getProgram['tahun'].'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            }

            if ($getSubProgram){
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getSubProgram['realisasi']. '( '.$getSubProgram['parent'].' )'.' Tahun '.$getSubProgram['tahun']. ' Bulan ' . $getSubProgram['bulan'] .'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            }

            if ($getSubProgramTahun){
                $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert</h4>' .$getSubProgramTahun['realisasi']. '( '.$getSubProgramTahun['parent'].' )'.' Tahun '.$getSubProgramTahun['tahun'].'
                sudah ada!
                </div>
                '
                );                                
                redirect('anggaran');
            }

            $data = array(
            'id_pendapatan' => $pendapatan,
            'id_bidang' => $bidang,
            'id_pembiayaan' => $pembiayaan,
            'id_program' => $program,
            'id_realisasi' => $subprogram,
            'id_realisasi_pertahun' => $subProgramTahun,
            'id_tahun' => $t,
            'id_bulan' => $b,
            'anggaran_semula' => $this->input->post('anggaran')
            );
            
            $this->db->insert('t_anggaran', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil ditambah!
            </div>
            ');     
            redirect('anggaran');
        }
    }

    public function editAnggaranP($id)
    {
        $data = $this->m_anggaran->getAggaranPendapatanById($id)->row_array();
        echo json_encode($data);
    }

    public function editAnggaranProgram($id)
    {
        $data = $this->m_anggaran->getAggaranProgramById($id)->row_array();
        echo json_encode($data);
    }

    public function editAnggaranSubProgram($id)
    {
        $data = $this->m_anggaran->getAggaranSubProgramById($id)->row_array();
        echo json_encode($data);
    }

    public function editAnggaranSubProgramTahun($id)
    {
        $data = $this->m_anggaran->getAggaranSubProgramTahunById($id)->row_array();
        echo json_encode($data);
    }

    public function editAnggaranPembiayaan($id)
    {
        $data = $this->m_anggaran->getAggaranPembiayaanById($id)->row_array();
        echo json_encode($data);
    }

    public function editAnggaranB($id)
    {
        $data = $this->m_anggaran->getAggaranBidangById($id)->row_array();
        echo json_encode($data);
    }

    public function updateAnggaran()
    {
        $id = $this->input->post('id_anggaran');
        $data_pendapatan = $this->m_anggaran->getAggaranPendapatanById($id)->row_array();
        $data_bidang = $this->m_anggaran->getAggaranBidangById($id)->row_array();
        $data_pembiayaan = $this->m_anggaran->getAggaranPembiayaanById($id)->row_array();
        $data_program = $this->m_anggaran->getAggaranProgramById($id)->row_array();
        $data_subprogram = $this->m_anggaran->getAggaranSubProgramById($id)->row_array();
        $data_subprogramtahun = $this->m_anggaran->getAggaranSubProgramTahunById($id)->row_array();

        $anggaran = $this->input->post('aaanggaran');
        $serapan = $this->input->post('aserapan');
        $pendapatan = $this->input->post('edit_pendapatan');
        $bidang = $this->input->post('edit_bidang');
        $pembiayaan = $this->input->post('edit_pembiayaan');
        $program = $this->input->post('edit_program');
        $subprogram = $this->input->post('edit_subprogram');
        $subprogramtahun = $this->input->post('edit_subprogramtahun');

        if ($data_pendapatan['id_pendapatan'] = $pendapatan) {
            $data = array(
                'anggaran_menjadi' => $anggaran
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }

        if ($data_bidang['id_bidang'] = $bidang) {
            $data = array(
                'anggaran_menjadi' => $anggaran
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }

        if ($data_pembiayaan['id_pembiayaan'] = $pembiayaan) {
            $data = array(
                'anggaran_menjadi' => $anggaran
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }

        if ($data_program['id'] = $program) {
            $data = array(
                'anggaran_menjadi' => $anggaran
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }

        if ($data_subprogram['id_realisasi'] = $subprogram) {
            $data = array(
                'anggaran_menjadi' => $anggaran,
                'serapan' => $serapan
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }

        if ($data_subprogramtahun['id_realisasi'] = $subprogramtahun) {
            $data = array(
                'anggaran_menjadi' => $anggaran
            );            
            $id = $this->input->post('id_anggaran');
            $this->m_anggaran->updateAnggaran(array('id_anggaran' => $id),$data);
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
            redirect('anggaran','refresh');        
        }
        

    }

    public function deleteAnggaran($id)
    {
        $this->db->where('id_anggaran', $id);
        $this->db->delete('t_anggaran');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Data berhasil dihapus!
            </div>
            ');
        echo json_encode(array("status" => true));
    }

}

/* End of file anggaran.php */
/* Location: ./application/controllers/anggaran.php */