<?php
require APPPATH . 'core/Generic_model.php';

class User_model extends Generic_model
{

	const TBL_SHIPPING_ADDRESS = 'shipping_addresses';
	const SHA = 'sha_';
	const USER_ID = self::SHA . 'userId';

	public function __construct()
	{
		parent::__construct(self::TBL_SHIPPING_ADDRESS, self::SHA);
	}

	public function create_shipping_address($shippingAddress)
	{
		$shippingAddressData = $this->build_model_data($shippingAddress, self::SHA, array(createdAt => date('Y-m-d H:i:s')));
		$this->db->insert(self::TBL_SHIPPING_ADDRESS, $shippingAddressData);
		return $this->model_response(true, 202, array("shippingAddressId" => $this->db->insert_id()), 'Shipping Address Created Successfully');
	}

	public function update_shipping_address($shippingAddress, $shippingId)
	{
		$shippingAddressData = $this->create_model($shippingAddress, self::SHA);
		$this->db->where("sha_id", $shippingId);
		$this->db->update(self::TBL_SHIPPING_ADDRESS, $shippingAddressData);
		//$this->db->affected_rows()->get();
		return $this->model_response(true, 200,  array(), 'Shipping Address Updated Successfully');
	}

	public function list_shipping_address($userId)
	{
		$this->db->select('*, sha_id as sha_shippingAddressId');
		$this->db->from(self::TBL_SHIPPING_ADDRESS);
		$this->db->where(self::USER_ID, $userId);
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
//		return $this->model_response(true, 200, $response_data);
		return $this->model_response(true, 200, array('shippingAddress' => $response_data));
	}

	public function get_shipping_address($shippingAddressId)
	{
		$this->db->select('*, sha_id as sha_shippingAddressId');
		$this->db->from(self::TBL_SHIPPING_ADDRESS);
		$this->db->where(self::SHA . 'id', $shippingAddressId);
		$result = $this->db->get();
		$response_data = $this->build_response($result->row());
//		return $this->model_response(true, 200, $response_data);
		return $this->model_response(true, 200, array('shippingAddress' => $response_data));
	}

}