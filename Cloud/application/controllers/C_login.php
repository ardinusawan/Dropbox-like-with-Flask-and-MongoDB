<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller 
{
	function __construct(){
		parent::__construct();
		$this->load->library('Curl');
	}


	public function index()
	{
		//get
		$data = json_decode(file_get_contents('http://localhost:8888/'),true);
		$this->load->view('login',array('data' => $data));
	}

	public function login_post()
	{
		$curl = curl_init();
		$data['username_post'] = $this->input->post('username_post');
		$data['password_post'] = $this->input->post('password_post');

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => "http://localhost:8888/login",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "username_post=".$data['username_post']."&password_post=".$data['password_post'],
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/x-www-form-urlencoded",
		    "postman-token: 63b11385-89ef-e84c-92f9-cd2b961eaeca"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		
		if ($err) {
  		echo "cURL Error #:" . $err;
		} else {
			// $data = json_decode($response,true);
			redirect('C_main/index');
			// var_dump($data);
  		// echo $response;
		}
		// //Post
		// $url = 'http://10.151.36.31:8888/login';
		// $data = array(
//          'username_post' => 'wawan',
//          'password_post' => 'wawan',
//  		);

	 //    $data_string = json_encode($data);

	 //    $curl = curl_init('http://10.151.36.31:8888/login');

	 //    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

	 //    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	 //    'Content-Type: application/json',
	 //    'Content-Length: ' . strlen($data_string))
	 //    );

	 //    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
	 //    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

	 //    // Send the request
	 //    $result = curl_exec($curl);
	 //    echo $result;

	 //    // Free up the resources $curl is using
	 //    curl_close($curl);

	}

	public function logout()
	{
		$data = json_decode(file_get_contents('http://10.151.36.31:8888/logout'),true);
		// print_r($data);
		if ($data['Message']=="Logout Success")
		{
			// echo "berhasil";
			redirect('C_login',array('data' => $data));
		}
		else
		{
			echo "Gagal";
		}
	}
}