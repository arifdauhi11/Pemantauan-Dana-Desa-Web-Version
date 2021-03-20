<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
		parent::__construct();		
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('m_user');
        if (!$this->session->userdata('id_pengguna')) {
        	return redirect( base_url('auth/') );
        }
	}

	public function index()
	{
        $this->db->select('count(id_pengguna) as inactive');
        $data['inactive'] = $this->db->get_where('pengguna', ['is_active' => '0'])->row_array();
        $data['user'] = $this->db->get_where('pengguna', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['title'] = "Aktivasi Pengguna | Pengawasan Dana Desa";
        $this->db->order_by('nik', 'asc');
        $data['auser'] = $this->db->get('pengguna')->result();
        $this->db->where_not_in('id', '1');
        $data['role'] = $this->db->get('t_role')->result();    
        $this->load->view('admin/template/header',$data); 
        $this->load->view('admin/template/sidebar',$data);        
        $this->load->view('admin/v_user',$data);
        $this->load->view('admin/template/footer'); 
	}

	public function updateStatus()
	{

		$id = $_REQUEST['sid'];
    	$val = $_REQUEST['sval'];
        $data = $this->db->get_where('pengguna', ['id_pengguna' => $id])->row_array();

        if ($data['id_role'] == 1) {
            $this->session->set_flashdata('hapus', '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            Akun pengguna dengan role Operator Desa tidak dapat dinonaktifkan!
            </div>
            ');
            redirect('user');
        }else{

        if ($val === '1') 
        {
            $status = '0';
            $data = array('is_active' => $status);
            $where = array('id' => $id);
            $this->m_user->upStatus('t_pengguna',$data,$where);

            $this->session->set_flashdata('status', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Akun pengguna telah dinonaktifkan!
              </div>
            ');
            $ta = $this->m_user->getToken($id);
            $no = 1;
            foreach($ta as $t){
            $curl = curl_init();                        
            $token = $t->registration_ids;
            $authKey = "key=AAAAp8cSpq8:APA91bHpyPHZPndhT_SgUgdUX2MSKn29XKF74GVLhB-VdyMJr_dwaZOIxCMmMVH797plfJt_iTqZ9TOtUvs0YLKuM_Y4LaTZiAko0CE_kbI0mzlBUilBfMrvP6xXsb3npvpC1yjDf_9C";
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
            "registration_ids": ["'.$token.'"],
            "notification": {
            "title":"Pemantauan Dana Desa",
            "body":"Akun anda telah dinonaktifkan!"
            }
            }',
            CURLOPT_HTTPHEADER => array(
            "Authorization: ".$authKey,
            "Content-Type: application/json",
            "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);          
            }
            
            redirect(base_url('user/'));
        }
        if ($val !== '1') {
            $status = '1';
            $data = array('is_active' => $status);
            $where = array('id' => $id);
            $this->m_user->upStatus('t_pengguna',$data,$where);
            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Akun pengguna telah diaktifkan!
              </div>
            ');
            
            $ta = $this->m_user->getToken($id);
            $no = 1;
            foreach($ta as $t){
            $curl = curl_init();                        
            $token = $t->registration_ids;
            $authKey = "key=AAAAp8cSpq8:APA91bHpyPHZPndhT_SgUgdUX2MSKn29XKF74GVLhB-VdyMJr_dwaZOIxCMmMVH797plfJt_iTqZ9TOtUvs0YLKuM_Y4LaTZiAko0CE_kbI0mzlBUilBfMrvP6xXsb3npvpC1yjDf_9C";
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
            "registration_ids": ["'.$token.'"],
            "notification": {
            "title":"Pemantauan Dana Desa",
            "body":"Akun anda telah diaktifkan!"
            }
            }',
            CURLOPT_HTTPHEADER => array(
            "Authorization: ".$authKey,
            "Content-Type: application/json",
            "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);          
            }
            redirect(base_url('user/'));    
        }    
        }         	
		
	}
	

    public function deleteUser($nik)
    {
        $this->m_user->deleteUserByNik($nik);
        $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Akun pengguna telah dihapus!
              </div>
            ');
        echo json_encode(array("status" => true));
    }

	public function hapus(){    
        $nik = $_REQUEST['nik'];
        $data = $this->db->get_where('pengguna', ['nik' => $nik])->row_array();        
        $where = array('nik' => $nik);

        if ($data['id_role'] == 1) {
            $this->session->set_flashdata('hapus', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Akun pengguna dengan role Operator Desa tidak dapat dihapus!
              </div>
            ');
            redirect('user');
        }else{
            $this->m_user->hapus_data($where,'t_pengguna');
            $this->session->set_flashdata('hapus', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Akun pengguna telah dihapus!
              </div>
            ');
            redirect('user');            
        }                
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|is_unique[t_pengguna.nik]',[
            'required' => 'NIK tidak boleh kosong!',
            'min_length' => 'NIK yang anda masukan terlalu pendek!',
            'max_length' => 'NIK yang anda masukan terlalu panjang!',
            'is_unique' => 'NIK yang anda masukan telah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|is_unique[t_pengguna.nama]',['required' => 'Nama Pengguna tidak boleh kosong!',
            'is_unique' => 'Nama Pengguna sudah ada!']);
        if ($this->form_validation->run() == FALSE) {
            $this->index();        
        } else {
            $data = [
                'nik' => htmlspecialchars($this->input->post('nik', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'image' => 'default.png',
                'password' => md5('pdd123'),
                'role_id' => $this->input->post('role', true),
                'is_active' => 1,
                'date_created' => time(),
                'registration_ids' => 'NULL'
            ];
            $this->db->set('id', 'UUID()', FALSE);
            $this->db->insert('t_pengguna', $data);
            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Pengguna dengan nama '.$data['nama'].' berhasil ditambahkan!
              </div>
                ');
            redirect('user');
        }
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */