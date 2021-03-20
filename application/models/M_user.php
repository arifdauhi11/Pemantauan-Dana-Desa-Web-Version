<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function getLevel(){
		return $this->db->get('t_level')->result();
	}

	function getAll(){
		return $this->db->get('t_pengguna')->result();
	}

	public function getById($id)
	{
		$this->db->select('`t_pengguna.id`,`nama`,`t_role.role as level`,`t_role.id as id_level`, `image`,`is_active as status`');
		$this->db->from('t_pengguna');
		$this->db->join('t_role', 't_pengguna.role_id = t_role.id', 'left');
		$this->db->where('t_pengguna.id', $id);
		$query = $this->db->get();		
		return $query;
	}

	public function createUser($data)
	{
		$this->db->set('id', 'UUID()', FALSE);
		$this->db->insert('t_pengguna', $data);
		return $this->db->affected_rows();
	}

	public function upStatus($table,$data,$where)
    {
    	$this->db->where($where);
		$this->db->update($table,$data);
    }
    
    public function deleteUserByNik($nik){
		$this->db->where('nik', $nik);
		$this->db->delete('t_pengguna');
	}

    public function hapus_data($where,$table){
	$this->db->where($where);
	$this->db->delete($table);
	}

    public function getStatus()
    {
        $status = '0';
        $this->db->select('count(id) as nonaktif');
        $this->db->from('t_pengguna');
        $this->db->where('is_active', $status);
        return $this->db->get()->row();        
    }

	function checkStatus(){
		$aktif = '1';
		$this->db->select('status');
		$this->db->from('t_pengguna');
		$this->db->where('status', $aktif);
		return $this->db->get();
	}

	public function getToken($id)
    {
        $this->db->select('registration_ids');
        $this->db->from('t_pengguna');
        $this->db->where('id',$id);
        return $this->db->get()->result();

    }
}

/* End of file m_user.php */
/* Location: ./application/models/m_user.php */