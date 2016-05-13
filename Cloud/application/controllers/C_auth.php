<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function daftar()
	{
		$this->load->view('daftar');
	}
}
