<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function auth()
	{
		$this->load->model('Login_m');
     	$u = $this->input->post('username_txt');
		$p = $this->input->post('password_txt');
		$this->Login_m->log($u,$p);	
	}

}
