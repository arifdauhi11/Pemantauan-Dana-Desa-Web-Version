<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user');
        $this->id_pengguna = $this->session->userdata('id_pengguna');
    }

    public function index()
    {
        $this->form_validation->set_rules(
            'nik',
            'NIK',
            'trim|required|min_length[16]|max_length[16]',
            [
                'required' => 'Silahkan masukkan NIK anda!',
                'min_length' => 'NIK yang anda masukan tidak sampai 16 karakter!',
                'max_length' => 'NIK yang anda masukan terlalu panjang!'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required',
            ['required' => 'Silahkan masukkan Password anda!']
        );

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Masuk | Pengawasan Dana Desa";
            $this->load->view('admin/v_login', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nik = $this->input->post('nik');
        $password = md5($this->input->post('password'));

        $pengguna = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();

        if ($pengguna) {
            if ($pengguna['is_active'] == 1) {
                if ($password == $pengguna['password']) {
                    $data = [
                        'id_pengguna' => $pengguna['id_pengguna'],
                        'nik' => $pengguna['nik'],
                        'nama' => $pengguna['nama'],
                        'role' => $pengguna['role'],
                        'role_id' => $pengguna['id_role'],
                        'status' => $pengguna['is_active']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                    // echo "Login sukses";
                } else {
                    $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Alert!</h4>
					Password yang anda masukan salah!
					</div>
					');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                NIK yang anda masukan belum diaktivasi!
              	</div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            NIK yang anda masukan salah!
          	</div>
            ');
            redirect('auth');
        }
    }

    public function registrasi()
    {

        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|is_unique[t_pengguna.nik]', [
            'min_length' => 'NIK yang anda masukan tidak sesuai!',
            'max_length' => 'NIK yang anda masukan terlalu panjang!',
            'is_unique' => 'NIK yang anda masukan telah terdaftar!'
        ]);
        
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Daftar | Pengawasan Dana Desa";
            $this->load->view('admin/v_register', $data);
        } else {
            $data = [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'image' => 'default.png',
                'password' => md5($this->input->post('password1')),
                'role_id' => 3,
                'is_active' => 0,
                'date_created' => time(),
                'registration_ids' => 'NULL'
            ];
            $this->db->set('id', 'UUID()', FALSE);
            $this->db->insert('t_pengguna', $data);
            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Selamat!</h4>
                Selamat anda berhasil mendaftar di aplikasi kami
              </div>
                ');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('id_pengguna');
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-success"></i> Alert!</h4>
                Anda berhasil keluar!
              	</div>
                ');
        redirect(base_url('auth'));
    }
}
