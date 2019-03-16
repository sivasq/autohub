<?php
require_once APPPATH . 'core/Generic_model.php';

class Auth_model extends Generic_model
{
	var $table = 'register';
	var $table_api_key = 'apikeys';
	var $prfx = '';

	function __construct()
	{
		parent::__construct($this->table, $this->prfx);
	}

	public function email_availability()
	{
		$this->db->where('email', $this->httpRequest->email);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}

	public function user_reg()
	{
		$userData = $this->build_model_data($this->httpRequest, $this->prfx, array("otp" => rand(1000, 9999), 'otp_is_expired' => 0, 'created_at' => date('Y-m-d H:i:s'), 'otp_created_at' => date('Y-m-d H:i:s')));
		$this->db->insert($this->table, (array)$userData);

		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on registering user");
		}
		return $this->model_response(true, 202, $userData, "success on registering user");
	}

	public function send_otp()
	{
		if (!$this->email_availability()) {
			return $this->model_response(false, 500, array(), "Invalid Email");
		}

		$otpData = $this->build_model_data($this->httpRequest, $this->prfx, array("otp" => rand(1000, 9999), 'otp_is_expired' => 0, 'otp_created_at' => date('Y-m-d H:i:s')));

		unset($otpData['email']);
		$this->db->where('email', $this->httpRequest->email);
		$this->db->update($this->table, $otpData);

		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on Generating OTP");
		}

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('email', $this->httpRequest->email);
		$userData = $this->db->get()->row();

		return $this->model_response(true, 202, json_decode(json_encode($userData), True), "success on OTP Generation");
	}

	public function verify_otp()
	{
		if (!$this->email_availability()) {
			return $this->model_response(false, 500, array(), "Email not exists!");
		}

		$this->db->where("email='" . $this->httpRequest->email . "' AND otp='" . $this->httpRequest->otp . "' AND otp_is_expired=0 AND NOW() <= DATE_ADD(otp_created_at, INTERVAL 1 DAY)");
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			$otpData = $this->build_model_data($this->httpRequest, $this->prfx, array('otp_is_expired' => 1));

			$this->db->where(array('email' => $this->httpRequest->email, 'otp' => $this->httpRequest->otp));
			$this->db->update($this->table, $otpData);
		} else {
			return $this->model_response(false, 202, array(), "Invalid OTP");
		}

		return $this->model_response(true, 202, array(), "OTP Verified");
	}

	public function login_auth()
	{
		$this->db->where(array('email' => $this->httpRequest->email, 'password' => $this->httpRequest->password));
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
}