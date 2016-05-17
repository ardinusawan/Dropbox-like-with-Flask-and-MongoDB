<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller 
{
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

		// $curl = curl_init();
		$nama = $this->input->post('nama_put');
		$type = $this->input->post('type_put');
		echo $nama;
		echo $type;
		// curl_setopt_array($curl, array(
		//   CURLOPT_PORT => "8888",
		//   CURLOPT_URL => "http://localhost:8888/upload/".$nama.','.$type."",
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => "",
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 30,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => "PUT",
		//   CURLOPT_HTTPHEADER => array(
		//     "cache-control: no-cache",
		//     "postman-token: e12b8a7d-eee6-be17-619c-386c0c69d4dc"
		//   ),
		// ));

		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);

		// if ($err) {
		//   echo "cURL Error #:" . $err;
		// } else {
		//   echo $response;
		// }	
	}

	public function upload_function()
	{
		$curl = curl_init();
		$data['nama_file'] = $this->input->post('nama_file');
		$data['tipe_file'] = $this->input->post('tipe_file');
		
		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/upload/".$data['nama_file'].",".$data['tipe_file']."",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "PUT",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "postman-token: a61cff45-212b-ba5f-198c-f647dfd4ed51"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}

    }

    public function upload_function2(){
    	var_dump($_FILES);
    	// $data['nama_file'] = $this->input->post('nama_file');
		// $data['tipe_file'] = $this->input->post('tipe_file');
		// $url = IP_Middleware."/upload/".$data['nama_file'].",".$data['tipe_file']."";
		// $header = array('Content-Type: multipart/form-data');
		// $fields = array('file' => '@' . $_FILES['file']['tmp_name'][0]);
		// $token = 'NfxoS9oGjA6MiArPtwg4aR3Cp4ygAbNA2uv6Gg4m';
		 
		// $resource = curl_init();
		// curl_setopt($resource, CURLOPT_URL, $url);
		// curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
		// curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($resource, CURLOPT_POST, 1);
		// curl_setopt($resource, CURLOPT_POSTFIELDS, $fields);
		// // curl_setopt($resource, CURLOPT_COOKIE, 'apiToken=' . $token);
		// $result = json_decode(curl_exec($resource));
		// curl_close($resource);
//
		$curl = curl_init();
		$data['nama_file'] = $this->input->post('nama_file');
		$data['tipe_file'] = $this->input->post('tipe_file');
		$fields = array('file' => '@' . $_FILES['file']['tmp_name'][0]);
		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8888",
		  CURLOPT_URL => IP_Middleware."/upload/".$data['nama_file'].",".$data['tipe_file']."",
		  CURLOPT_POSTFIELDS => $fields,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "PUT",
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: multipart/form-data'
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		  // redirect('C_main/my_files','refresh');
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
		$link['gambar']  = "http://localhost:8888/files/".$id;
		// var_dump($link);
		$this->load->view('user/view-img',$link);
	}

	public function delete($id){
		$link['delete']  = "http://localhost:8888/delete/".$id;
		$flag = json_decode(file_get_contents($link['delete']),true);
		if($flag['flag']==1){
			redirect('C_main/my_files','refresh');
		}

	}

	public function set_flag_share($id){
		$link['flag']  = "http://localhost:8888/share/".$id;
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
		  CURLOPT_URL => "http://localhost:8888/settings",
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

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
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
