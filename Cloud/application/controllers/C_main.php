<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller 
{
	public function index()
	{
		$data = json_decode(file_get_contents('http://localhost:8888/main'),true);
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

		$data['head'] = json_decode(file_get_contents('http://localhost:8888/main'),true);
		$this->load->view('user/header', $data['head']);
		$this->load->view('user/upload');

		// $curl = curl_init();
		// $nama = $this->input->post('nama_put');
		// $type = $this->input->post('type_put');

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
		 $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'txt|pdf';
        $config['max_size']    = '100';

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_file_view', $upload_error);
        }
        else
        {
            // case - success
            $upload_data = $this->upload->data();
            $data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
            $this->load->view('upload_file_view', $data);
        }
    }
		// if(isset($_FILES['fileUpload']))
		//  {
		//       $errors= array();
		//       $file_name = $_FILES['fileUpload']['name'];
		//       $file_size =$_FILES['fileUpload']['size'];
		//       $file_tmp =$_FILES['fileUpload']['tmp_name'];
		//       $file_type=$_FILES['fileUpload']['type'];
		//       $file_ext=strtolower(end(explode('.',$_FILES['fileUpload']['name'])));
		      
		//       echo $file_name;
		//       echo $file_type;
	 //   	}
	 //   	else 
	 //   	{
	 //   		echo "Salah";
	 //   	}
	

	public function my_files()
	{
		// $current_user = json_decode(file_get_contents('http://localhost:8888/main'),true);
		$data['head'] = json_decode(file_get_contents('http://localhost:8888/main'),true);
		$data['files'] = json_decode(file_get_contents('http://localhost:8888/files'),true);

		// var_dump($data);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/my-files',$data);
	}

	public function shared_files()
	{
		$data['files'] = json_decode(file_get_contents('http://localhost:8888/AllFiles'),true);
		$data['head'] = json_decode(file_get_contents('http://localhost:8888/main'),true);
		$this->load->view('user/header',$data['head']);
		$this->load->view('user/sharing-files',$data);
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
		

}
