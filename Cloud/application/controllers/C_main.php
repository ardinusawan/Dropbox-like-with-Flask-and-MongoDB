<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller 
{
	public function index()
	{
		$data = json_decode(file_get_contents('http://10.151.36.31:8888/main'),true);
		// print_r($data);
		// return;
		if ($data['status']==1)
		{
			$this->load->view('user/header', $data);
			$this->load->view('user/main');
		}
		elseif ($data['status']==0) 
		{
			// echo "ga mau";
			redirect('C_login');
		}


		// $this->load->view('user/header');
		// $this->load->view('user/main');
	}

	public function upload()
	{
		$this->load->view('user/header');
		$this->load->view('user/upload');	
	}

	public function my_files()
	{
		$this->load->view('user/header');
		$this->load->view('user/my-files');		
	}

	public function shared_files()
	{
		$this->load->view('user/header');
		$this->load->view('user/sharing-files');
	}

	public function refill()
	{
		$this->load->view('user/header');
		$this->load->view('user/refill');
	}

	public function setting()
	{
		$this->load->view('user/header');
		$this->load->view('user/setting');
	}

}
