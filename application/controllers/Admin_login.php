<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		
		parent:: __construct();

		$this->load->library('session'); 
		$this->load->helper(array('form','url','date'));		 
		$this->load->database();
		$this->load->model('admin_model');
		
	}


	public function index()
	{
		$this->load->view('admin/login');
	}

	public function admin_login_auth()
	{		
		
		$response = array();

		 		
	    if($this->admin_model->login_auth())
			{		 	
				$response['status'] = 'success';	
			}
			else 
			{	
				$response['status'] = 'failed';
			}

		echo json_encode($response); 

	}

	public function logout()
	{
		 $this->session->sess_destroy();
       	 redirect('Admin_login/index');
	}


}