<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_register extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Curl');
	}

	public function index()
	{
		//get
		$data = json_decode(file_get_contents('http://10.151.36.31:8888/register'),true);
		$this->load->view('daftar',array('data' => $data));
	}

	public function daftar_post()
	{
		$curl = curl_init();

		$data['username'] = $this->input->post('username_post');
		$data['password'] = $this->input->post('password_post');

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => "http://10.151.36.31:8888/register",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "username_post=".$data['username']."&password_post=".$data['password'],
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/x-www-form-urlencoded",
		    "postman-token: f7d9fbde-0798-237b-54c5-60bf766ebcd1"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} 
		else 
		{
		  echo $response;
		  $this->load->view('user/main');
		}
	}
}
