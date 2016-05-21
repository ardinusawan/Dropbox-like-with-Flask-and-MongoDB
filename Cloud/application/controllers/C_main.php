<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller 
{



	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data = json_decode(file_get_contents(IP_Middleware.'/main'),true);
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

		$data['head'] = json_decode(file_get_contents(IP_Middleware.'/main'),true);
		$this->load->view('user/header', $data['head']);
		$this->load->view('user/upload');

	}

    public function upload_function3(){
		$config['upload_path'] = '/opt/lampp/htdocs/Cloud/assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());

			// $this->load->view('form_upload', $error);
			var_dump($error);
		}
		else{
			$data = array('upload_data' => $this->upload->data());

			// $this->load->view('sukses', $data);
			// var_dump($data);

			$localFile = $data['upload_data']['full_path']; 

			$fp = fopen($localFile, 'r');

			// Connecting to website.
			$ch = curl_init();

			// curl_setopt($ch, CURLOPT_USERPWD, "email@email.org:password");
			curl_setopt($ch, CURLOPT_URL, IP_Middleware."/upload/".$data['upload_data']['file_name'].",".$data['upload_data']['image_type']."");
			curl_setopt($ch, CURLOPT_UPLOAD, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 86400); // 1 Day Timeout
			curl_setopt($ch, CURLOPT_INFILE, $fp);
			curl_setopt($ch, CURLOPT_NOPROGRESS, false);
			curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);
			curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localFile));
			$response = curl_exec($ch);
			if (curl_errno($ch)) {

			    // $msg = curl_error($ch);
			}
			else {

			    $msg = 'File uploaded successfully.';
			}

			curl_close ($ch);

			// $return = array('msg' => $msg);

			// $pesan = json_encode($response);
			echo "<script>alert(
			'Sukses Upload!'
			);</script>";
			redirect('C_main/my_files','refresh');


		}
	

    }



		

	public function my_files()
	{
		// $current_user = json_decode(file_get_contents('http://localhost:8888/main'),true);
		$data['head'] = json_decode(file_get_contents(IP_Middleware.'/main'),true);
		$data['files'] = json_decode(file_get_contents(IP_Middleware.'/files'),true);

		// var_dump($data);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/my-files',$data);
	}

	public function shared_files()
	{
		$data['files'] = json_decode(file_get_contents(IP_Middleware.'/AllFiles'),true);
		$data['head'] = json_decode(file_get_contents(IP_Middleware.'/main'),true);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/sharing-files',$data);
	}

	public function refill()
	{
		$data['head'] = json_decode(file_get_contents(IP_Middleware.'/main'),true);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/refill');
	}

	public function setting()
	{
		$data['head'] = json_decode(file_get_contents(IP_Middleware.'/main'),true);
		$data['setting'] = json_decode(file_get_contents(IP_Middleware.'/settings'),true);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/setting', $data);
		//var_dump($data['setting']);
	}

	public function view($id){
		$link['gambar']  = IP_Middleware."/files/".$id;
		// var_dump($link);
		$this->load->view('user/view-img',$link);
	}

	public function delete($id){
		$link['delete']  = IP_Middleware."/delete/".$id;
		$flag = json_decode(file_get_contents($link['delete']),true);
		if($flag['flag']==1){
			redirect('C_main/my_files','refresh');
		}

	}

	public function set_flag_share($id){
		$link['flag']  = IP_Middleware."/share/".$id;
		$flag = json_decode(file_get_contents($link['flag']),true);
		if($flag['status']==1){
			redirect('C_main/shared_files','refresh');
		}
		var_dump($flag);
	}

	public function add_limit10K()
	{
		
		//echo "halo";
		$curl = curl_init();

		$data['value'] = $this->input->post('1 MB = 10K');
		#echo "halo";

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/settings",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n1 MB = 10K\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: a684bfa8-5f1a-0964-b9a6-5f7ed1f4fc40"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  redirect('C_main/setting','refresh');
		}

	}


	public function add_limit50K()
	{
	
		//echo "halo";
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/settings",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n5 MB = 50K\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: a684bfa8-5f1a-0964-b9a6-5f7ed1f4fc40"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  redirect('C_main/setting','refresh');
		}

	}	

	public function add_limit100K()
	{
		
		//echo "halo";
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/settings",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n10 MB = 100K\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: a684bfa8-5f1a-0964-b9a6-5f7ed1f4fc40"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		// var_dump($response);
		$pesan = json_decode($response);
		// var_dump($pesan);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			echo "<script>alert(
			'Saldo Kurang'
			);</script>";
		  redirect('C_main/setting','refresh');
		}

	}

	public function add_limit150K()
	{
		//echo "halo";
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/settings",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n15 MB = 150K\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: a684bfa8-5f1a-0964-b9a6-5f7ed1f4fc40"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  redirect('C_main/setting','refresh');
		}

	}

	public function refill_100k()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/refill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n100K\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"\"\r\n\r\n\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: c926c1b5-be90-edd2-9c02-2520cb087ed8"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} else 
		{
		  // echo $response;
			redirect('C_main/setting', 'refresh');
		}
	}

	public function refill_200k()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/refill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n200K\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"\"\r\n\r\n\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: c926c1b5-be90-edd2-9c02-2520cb087ed8"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} else 
		{
		  // echo $response;
			redirect('C_main/setting', 'refresh');
		}
	}

	public function refill_300k()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/refill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n300K\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"\"\r\n\r\n\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: c926c1b5-be90-edd2-9c02-2520cb087ed8"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} else 
		{
		  // echo $response;
			redirect('C_main/setting', 'refresh');
		}
	}

	public function refill_400k()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/refill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"submit\"\r\n\r\n400K\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"\"\r\n\r\n\r\n-----011000010111000001101001--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=---011000010111000001101001",
		    "postman-token: c926c1b5-be90-edd2-9c02-2520cb087ed8"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
		  echo "cURL Error #:" . $err;
		} else 
		{
		  // echo $response;
			redirect('C_main/setting', 'refresh');
		}
	}
		

}
