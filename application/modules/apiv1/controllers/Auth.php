<?php

use Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends My_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Auth_model');
	}

	/*
	 * Format : {"email": "siva@sqindia.net"}
	 */
	public function email_validate_post()
	{
		$availability = $this->Auth_model->email_availability($this->httpRequest);

		if ($availability) {
			$response['status'] = false;
			$response['msg'] = 'Already have this email';
		} else {
			$response['status'] = true;
			$response['msg'] = 'Email not found';
		}
		echo json_encode($response);
	}

	/*
	 * Format : {"first_name": "abc","last_name": "def","email": "guna@sqindia.net","password": "string","phone": "999999999","country": "India","ref_code": "string"}
	 */
	public function user_registration_post()
	{
		if ($this->Auth_model->email_availability($this->httpRequest))
			$this->response(array(false, 202, "This Email Already Registered"), REST_Controller::HTTP_OK);

		$response = $this->Auth_model->user_reg($this->httpRequest);
		if ($response[0]) {
			$otp = $response[3]['otp'];
			$firstName = $response[3]['first_name'];
			$lastName = $response[3]['last_name'];

			$message = 'Welcome to Autohub!.' . "<br>" . ' Hai ' . " " . $firstName . ' ' . $lastName . " " . 'Your OTP is :' . $otp . "<br>";
			$email = $response[3]['email'];
			$subject = "AutoHub OTP";

			$this->sendEmail($message, $email, $subject);
		}
		$extract_data['username'] = $response[3]['first_name'] . ' ' . $response[3]['last_name'];
		$extract_data['email'] = $response[3]['email'];
		unset($response[3]);
		$response[3] = $extract_data;
		$this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * Format :{"email": "siva@sqindia.net"}
	 */
	public function send_otp_post()
	{
		$response = $this->Auth_model->send_otp($this->httpRequest);

		if ($response[0]) {
			$otp = $response[3]['otp'];
			$firstName = $response[3]['first_name'];
			$lastName = $response[3]['last_name'];

			$message = 'Welcome to !.' . "<br>" . ' Hai ' . " " . $firstName . ' ' . $lastName . " " . 'Your OTP is :' . $otp . "<br>";
			$email = $response[3]['email'];
			$subject = "AutoHub OTP";

			$this->sendEmail($message, $email, $subject);
		}
		unset($response[3]);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * Format : {"email": "siva@sqindia.net","otp": 9212}
	 */
	public function otp_verify_post()
	{
		$response = $this->Auth_model->verify_otp($this->httpRequest);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * Deprecated function
	 */
	public function user_login_auth1_post()
	{
		$response = $this->Auth_model->login_auth($this->httpRequest);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * Format : {"email": "siva@sqindia.net","password": "string"}
	 */
	public function user_login_auth_post()
	{
		if (!$this->Auth_model->is_email_verified($this->httpRequest))
			$this->response($this->Auth_model->model_response(true, 202, array(), "Email Not Verified"), REST_Controller::HTTP_OK);

		$response_query = $this->Auth_model->login_auth($this->httpRequest);
		$response = array();
		if ($response_query->num_rows() > 0) {
			$userData = $response_query->row();

			$key = $this->_generate_key();

			$apiKey_data = array(
				'user_id' => $userData->user_id,
				'level' => 1,
				'ignore_limits' => 1,
				'ip_addresses' => $this->input->ip_address()
			);

			$insert_token = $this->_insert_key($key, $apiKey_data);

			if ($insert_token) {
				$response['api_key'] = $key;
				$response['email'] = $userData->email;
				$response['user_id'] = $userData->user_id;
				$response['username'] = $userData->first_name . ' ' . $userData->last_name;
			}

			if (!empty($db_error)) {
				$this->response($this->Auth_model->model_response(false, 500, array(), "Error on Login"), REST_Controller::HTTP_OK);
			}
		} else {
			$this->response($this->Auth_model->model_response(false, 202, array(), "Invalid Login Credentials"), REST_Controller::HTTP_OK);
		}
		$this->response($this->Auth_model->model_response(true, 202, $response, "Login Success"), REST_Controller::HTTP_OK);
	}

	private function _generate_key()
	{
		do {
			// Generate a random salt
			$salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);

			// If an error occurred, then fall back to the previous method
			if ($salt === FALSE) {
				$salt = hash('sha256', time() . mt_rand());
			}

			$new_key = substr($salt, 0, config_item('rest_key_length'));
		} while ($this->_key_exists($new_key));

		return $new_key;
	}

	/*
	 * No Body
	 */

	private function _key_exists($key)
	{
		return $this->rest->db
				->where(config_item('rest_key_column'), $key)
				->count_all_results(config_item('rest_keys_table')) > 0;
	}

	//storing token in database

	private function _insert_key($key, $data)
	{
		$data[config_item('rest_key_column')] = $key;
		// $data['date_created'] = function_exists('now') ? now() : time();
		$data['date_created'] = date('Y-m-d H:i:s');

		return $this->rest->db
			->set($data)
			->insert(config_item('rest_keys_table'));
	}

	/* Helper Methods */

	public function change_password_post()
	{
		if (!$this->Auth_model->email_availability($this->httpRequest)) {
			$this->response($this->Auth_model->model_response(false, 500, array(), "This Email Not Registered"), REST_Controller::HTTP_OK);
		}

		if (!$this->Auth_model->is_email_verified($this->httpRequest))
			$this->response($this->Auth_model->model_response(true, 202, array(), "Email Not Verified"), REST_Controller::HTTP_OK);

		$response = $this->Auth_model->update_password($this->httpRequest);

		$this->response($response, REST_Controller::HTTP_OK);
	}

	/* Private Data Methods */

	public function logout_post()
	{
		$key = $this->_head_args['x-api-key'];

		// Does this key exist?
		if (!$this->_key_exists($key)) {
			// It doesn't appear the key exists
			$this->response($this->Auth_model->model_response(false, 400, array(), "Invalid API key"), REST_Controller::HTTP_BAD_REQUEST);
		}

		// Destroy it
		$this->_delete_key($key);

		// Respond that the key was destroyed
		$this->response($this->Auth_model->model_response(true, 294, array(), "Logout success"), REST_Controller::HTTP_OK);
	}

	private function _delete_key($key)
	{
		return $this->rest->db
			->where(config_item('rest_key_column'), $key)
			->delete(config_item('rest_keys_table'));
	}

	public function registerDevice()
	{
		if (!$this->Auth_model->email_availability($this->httpRequest)) {
			if ($this->Auth_model->registerNewDevice($this->httpRequest)) {
				$this->response(array(), 200);
			} else {
				$this->response(array(), 202);
			}
		} else {
			$this->response(array(false, 202, "Device already registered"), REST_Controller::HTTP_OK);
		}
	}

	public function timezone_get()
	{
		$date = new DateTime();
		$timeZone = $date->getTimezone();
		echo $timeZone->getName();
		print_r(ini_get('date.timezone'));
	}

	private function _get_key($key)
	{
		return $this->rest->db
			->where(config_item('rest_key_column'), $key)
			->get(config_item('rest_keys_table'))
			->row();
	}

	private function _update_key($key, $data)
	{
		return $this->rest->db
			->where(config_item('rest_key_column'), $key)
			->update(config_item('rest_keys_table'), $data);
	}
}