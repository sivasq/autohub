<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function login_auth()
	{
		$user_name = $this->input->post("email");
		$password = $this->input->post("password");
		$user_type = 'super_admin';

		$credential = array('admin_email' => $user_name, 'admin_password' => $password, 'user_type' => $user_type);
		return $this->db->get_where('admin_user', $credential);
	}

}