<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function index()
	{
		$mon = 0;
		for ($i=12; $i > $mon; $i--) { 			
			$datej=date_create("2020-".$i."-15");
			$d = date_format($datej,"F");
			echo $d;
			$object = array(
				'id_bulan' => $i,
				'bulan' => $d
			);
			$this->db->insert('t_bulan', $object);
		}				
		$this->db->affected_rows();
	}

	public function ubahId()
	{
		$id = $this->db->get('t_sub_pembiayaan')->result();
		$kode = 1;
		foreach ($id as $key) {
			$sub = $key->id_sub_pembiayaan;
			// var_dump($sub);		
			echo "<br>";
			$this->db->where('id_sub_pembiayaan', $sub);
			$object = array(
				'id_sub_pembiayaan' => "SPM" . $kode++
			);
			// var_dump($object);		

			$this->db->update('t_sub_pembiayaan', $object);
			$this->db->affected_rows();
		}
	}

}

/* End of file tes.php */
/* Location: ./application/controllers/tes.php */