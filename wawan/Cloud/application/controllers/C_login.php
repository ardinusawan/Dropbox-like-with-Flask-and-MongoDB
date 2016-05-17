<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller 
{
	function __construct(){
		parent::__construct();
		$this->load->library('Curl');
		$this->load->helper('cookie');

	}


	public function index()
	{
		//get
		$data = json_decode(file_get_contents('http://localhost:8888/'),true);
		var_dump($data);
		// $this->load->view('login',array('data' => $data));
	}
	public function user()
	{
		//get
		$data = json_decode(file_get_contents('http://localhost:8888/main'),true);
		var_dump($data);
		// $this->load->view('login',array('data' => $data));
	}

	public function login_post()
	{
		$this->input->cookie('test_cookie', TRUE);
		$curl = curl_init();
		// $data['username_post'] = $this->input->post('username_post');
		// $data['password_post'] = $this->input->post('password_post');

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => "http://localhost:8888/login",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  // CURLOPT_COOKIEFILE => '$cookie',
		  // CURLOPT_POSTFIELDS => "username_post=".$data['username_post']."&password_post=".$data['password_post'],
		  CURLOPT_POSTFIELDS => "username_post=wicak&password_post=wicak",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: application/x-www-form-urlencoded",
		    // "postman-token: 63b11385-89ef-e84c-92f9-cd2b961eaeca",
		    // "Cookie: ".'$cookie'."=cookie"
		  ),
		));
		curl_setopt($curl, CURLOPT_COOKIEFILE,'test_cookie');

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} else 
		{
		  // echo $response;
			$data = json_decode($response,true);
			var_dump($data);
			// echo $data['USER_LOGIN'];
			// $data1 = json_decode(file_get_contents('http://localhost:8888/main'),true);
			// // echo $data1['current_user'];
			// var_dump($data1);
			// $cookie = array(
			//     'name'   => 'test',
			//     'value'  => '.eJwtjUELgjAYhv_K-M4SoXQZeNSdpgVasJCY68stRcNNRMX_nlinl-fwPO8Cj1cjrUYL9L4Acb8pgUJ5u87Kj1txCUNYPTg3KC2SpquIaYnriFQKrSVOG0s-ssIDFGvhbcEerQbq-gE3Mk-g_6JgPOBZdEr8WCdM1ClLTMr4KLJ64u_qmLBo4nMecJbvj4PFfvdhNErWsH4BAz430g.ChxG7g.il4100b0kVSRfZPAreYIbbqPFKI',
			//     'expire' => '86500', //time in sec
			//     'domain' => 'http://localhost/Cloud/',
			//     'path'   => '/',
			//     'prefix' => 'myprefix_',
			//     'secure' => TRUE
			// );
			// $this->input->set_cookie($cookie);
			// $a=$this->input->cookie();
			// var_dump($a);

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



}