<?php

/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 28-03-2019 028
 * Time: 12:34
 */
class Base_Controller extends MX_Controller
{

	/**
	 * Base_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();

//		header('Access-Control-Allow-Origin: *');
//		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		$this->load->library('session');
		$this->load->library('cloudinarylib');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'date', 'custom'));
		$this->load->database();
		$this->load->model('admin_model');

//        if (!$this->session->userdata('admin_user_id')) {
//            redirect('admin/index');
//        }
		$this->session->set_userdata("username", "Admin");
	}
}