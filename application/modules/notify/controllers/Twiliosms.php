<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Twiliosms extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function sms($to, $message)
	{
		$this->load->library('twilio');
		$from = '+12014740491';

		// $response = $this->twilio->sms($from, $to, $message);

		return $this->twilio->sms($from, $to, $message);

		// if($response->IsError)
		// {
		// 	return $response->ErrorMessage;
		// }
		// else
		// {
		// 	return $sms_to;
		// }
		
	}

}

/* End of file twilio_demo.php */