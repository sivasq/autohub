<?php

use Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	/*
	 * Format : { "userId":1, "firstName":"Ebin", "lastName":"Chandy", "addressLine1":"trivandrum", "addressLine2":"Kazhakuttam", "city":"Thrissur", "state":"Kerala", "country":"India", "postCode":"680671", "phone":"8788787", "email":"mufeed@dfsd.com" }
	 */
	public function create_shipping_address_by_user_id_post()
	{
		$response = $this->User_model->create_shipping_address($this->httpRequest);
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * No body
	 */
	public function get_shipping_address_by_user_id_get()
	{
		$userId = $this->get_path_variable('user-id');
		$this->validateVariable($userId);
		$responseData = $this->User_model->list_shipping_address($userId);
		return $this->response($responseData, REST_Controller::HTTP_OK);
	}

	/*
	 * Format : { "userId":1, "firstName":"Ebin---aE", "lastName":"Chandy", "addressLine1":"trivandrum", "addressLine2":"Kazhakuttam", "city":"Thrissur", "state":"Kerala", "country":"India", "postCode":"680671", "phone":"8788787", "email":"mufeed@dfsd.com" }
	 */
	public function update_shipping_address_by_shipping_id_put()
	{
		$shippingId = $this->get_path_variable('shipping-address-id');
		$this->validateVariable($shippingId);
		$updatedShippingData = $this->User_model->update_shipping_address($this->httpRequest, $shippingId);
		return $this->response($updatedShippingData, REST_Controller::HTTP_OK);
	}

	/*
	 * No body
	 */
	public function delete_shipping_address_by_shipping_id_delete()
	{
		$shippingAddressId = $this->get_path_variable('shipping-address-id');
		$this->response($this->User_model->delete($shippingAddressId));
	}

	/*
	 * No body
	 */
	public function get_shipping_address_by_shipping_id_get()
	{
		$shippingAddressId = $this->get_path_variable('shipping-address-id');
		$this->validateVariable($shippingAddressId);
		$responseData = $this->User_model->get_shipping_address($shippingAddressId);
		return $this->response($responseData, REST_Controller::HTTP_OK);
	}
}