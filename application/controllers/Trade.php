<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trade extends CI_Controller {

	public function index()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://indodax.com/api/summaries');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


		$headers = array();
		$headers[] = 'Cookie: __cfduid=d520c46ae5943d3b304fa0b0ee310bf3c1600007796; btcid=6ba146eeed0fa175efb74b06d5ba011d';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		} else {
			echo $result;
		}
		curl_close($ch);
	}	

}

/* End of file trade.php */
/* Location: ./application/controllers/trade.php */