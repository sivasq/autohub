<?php
require_once APPPATH . 'core/Generic_model.php';

class Auth_model extends Generic_model
{
	var $table = 'users';
	var $table_api_key = 'apikeys';
	var $prfx = '';

	function __construct()
	{
		parent::__construct($this->table, $this->prfx);
	}

	public function email_availability($httpRequest)
	{
		$this->db->where('email', $httpRequest->email);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function is_email_verified($httpRequest)
	{
		$this->db->where(array('email' => $httpRequest->email, 'is_email_verified' => 1));
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function user_reg($httpRequest)
	{
		$userData = $this->build_model_data($httpRequest, $this->prfx, array("otp" => rand(1000, 9999), 'otp_is_expired' => 0, 'is_email_verified' => 0, 'created_at' => date('Y-m-d H:i:s'), 'otp_created_at' => date('Y-m-d H:i:s')));
		$this->db->insert($this->table, (array)$userData);

		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on registering user");
		}
		return $this->model_response(true, 202, $userData, "User Registered Successfully! Gohead...");
	}

	public function send_otp($httpRequest)
	{
		if (!$this->email_availability( $httpRequest)) {
			return $this->model_response(false, 500, array(), "Invalid Email");
		}

		if ($this->is_email_verified( $httpRequest)) {
			return $this->model_response(true, 500, array(), "This Email Already Verified");
		}

		$otpData = $this->build_model_data($httpRequest, $this->prfx, array("otp" => rand(1000, 9999), 'otp_is_expired' => 0, 'is_email_verified' => 0, 'otp_created_at' => date('Y-m-d H:i:s')));

		unset($otpData['email']);
		$this->db->where('email', $httpRequest->email);
		$this->db->update($this->table, $otpData);

		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on Generating OTP");
		}

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('email', $httpRequest->email);
		$userData = $this->db->get()->row();

		return $this->model_response(true, 202, json_decode(json_encode($userData), True), "success on OTP Generation");
	}

	public function verify_otp($httpRequest)
	{
		if (!$this->email_availability( $httpRequest)) {
			return $this->model_response(false, 500, array(), "Email not exists!");
		}

		if ($this->is_email_verified( $httpRequest)) {
			return $this->model_response(true, 500, array(), "This Email Already Verified");
		}

		$this->db->where("email='" . $httpRequest->email . "' AND otp='" . $httpRequest->otp . "' AND otp_is_expired = 0 AND DATE_ADD(otp_created_at, INTERVAL 5 MINUTE) >= NOW()");
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			$otpData = $this->build_model_data($httpRequest, $this->prfx, array('otp_is_expired' => 1, 'is_email_verified' => 1));

			$this->db->where(array('email' => $httpRequest->email, 'otp' => $httpRequest->otp));
			$this->db->update($this->table, $otpData);
		} else {
			return $this->model_response(false, 202, array(), "Invalid OTP / OTP Expired");
		}

		return $this->model_response(true, 202, array(), "OTP Verified");
	}

	public function login_auth1($httpRequest)
	{
		$this->db->where(array('email' => $httpRequest->email, 'password' => $httpRequest->password));
		$query = $this->db->get($this->table);
		$response = array();
		if ($query->num_rows() > 0) {
			$userData = $query->row();
			$apiKey_data = array(
				'user_id' => $userData->user_id,
				'apikey' => random_string('alnum', 24),
				'level' => 1,
				'date_created' => date("Y-m-d H:i:s"),
			);

			$generate_token = $this->db->insert($this->table_api_key, $apiKey_data);

			if ($generate_token) {
				$response['api_key'] = $apiKey_data['apikey'];
				$response['email'] = $userData->email;
				$response['user_id'] = $userData->user_id;
				$response['username'] = $userData->first_name . ' ' . $userData->last_name;
			}

			if (!empty($db_error)) {
				return $this->model_response(false, 500, array(), "Error on Login");
			}
		} else {
			return $this->model_response(false, 202, array(), "Invalid Login Credentials");
		}

		return $this->model_response(true, 202, $response, "Login Success");
	}

	public function login_auth( $httpRequest)
	{
		$this->db->where(array('email' => $httpRequest->email, 'password' => $httpRequest->password));
		$query = $this->db->get($this->table);
		return $query;
	}

	public function create_response($message)
	{
		return $this->model_response(true, 294, array(), $message);
	}
}