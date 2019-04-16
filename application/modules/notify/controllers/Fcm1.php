<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//use Kreait\Firebase\Factory;
//use Kreait\Firebase\Messaging\CloudMessage;
//use Kreait\Firebase\ServiceAccount;

class Fcm1 extends User_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('FCM_Message', 'fcm');
	}

	public function index()
	{
		$this->fcm->send();
	}
}
