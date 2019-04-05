<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends User_Controller
{

	public function __construct()
	{
		parent:: __construct();
	}


	public function index()
	{
		$data['page_name'] = 'Dashboard';
		$this->load->view('admin/dashboard', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/auth');
	}

	public function products()
	{
		$data['page_name'] = 'Products';
		$this->load->view('admin/product', $data);
	}
}