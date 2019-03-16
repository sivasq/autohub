<?php

//require APPPATH . 'libraries/REST_Controller.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends My_Controller
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Auth_model');
	}

	/*
	 * Format : {"email": "guna@sqindia.net"}
	 */
	public function email_validate_post()
	{
		$availability = $this->Auth_model->email_availability();

		if ($availability) {
			$response['status'] = 'failed';
			$response['msg'] = 'Already have this email ';
		} else {
			$response['status'] = 'success';
			$response['msg'] = 'Email not found';
		}
		echo json_encode($response);
	}

	public function user_registration_post()
	{
		$response = $this->Auth_model->user_reg();

		if ($response[0]) {
			$otp = $response[3]['otp'];
			$firstName = $response[3]['first_name'];
			$lastName = $response[3]['last_name'];

			$message = 'Welcome to Autohubb!.' . "<br>" . ' Hai ' . " " . $firstName . ' ' . $lastName . " " . 'Your OTP is :' . $otp . "<br>";
			$email = $response[3]['email'];
			$subject = "AutoHubb OTP";

			$this->sendEmail($message, $email, $subject);
		}
		unset($response[3]);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function send_otp_post()
	{
		$response = $this->Auth_model->send_otp();

		if ($response[0]) {
			$otp = $response[3]['otp'];
			$firstName = $response[3]['first_name'];
			$lastName = $response[3]['last_name'];

			$message = 'Welcome to Autohubb!.' . "<br>" . ' Hai ' . " " . $firstName . ' ' . $lastName . " " . 'Your OTP is :' . $otp . "<br>";
			$email = $response[3]['email'];
			$subject = "AutoHubb OTP";

			$this->sendEmail($message, $email, $subject);
		}
		unset($response[3]);
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function otp_verify_post()
	{
		$response = $this->Auth_model->verify_otp();

		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function user_login_auth_post()
	{
		$response = $this->Auth_model->login_auth();

		$this->response($response, REST_Controller::HTTP_OK);
	}

	// data send to body
	public function check_input_body($data_var)
	{
		if ($data = ($data_var !== null) ? $data_var : 'NULL') {
			return $data;
		}
	}

}