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


	public function get_nigeria_buyer_list()
	{
		$this->db->select('*');
		$this->db->from('commercial_car');
		$this->db->join('car_images', 'car_images.commercial_id = commercial_car.commercial_id', 'left');
		// $this->db->join('users', 'users.user_id = commercial_car.commercial_id', 'left');
		$this->db->where('commercial_car.car_type', 'commercial');
		// $this->db->where('users.country','Nigeria');

		$data['user'] = $this->db->get()->result();

		return $data['user'];
	}


}