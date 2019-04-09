<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//use Kreait\Firebase\Factory;
//use Kreait\Firebase\Messaging\CloudMessage;
//use Kreait\Firebase\ServiceAccount;

class Fcm1 extends User_Controller
{
	public $firebase;

	function __construct()
	{
		parent::__construct();
//		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/google-service-account.json');
//
//		$this->firebase = (new Factory)
//			->withServiceAccount($serviceAccount)
//			->create();
		$params = array('type' => 'large', 'color' => 'red');
		$this->load->library('FCM_Message', $params, 'fcm');
	}

	public function index()
	{
		$this->fcm->send();
//		$messaging = $this->firebase->getMessaging();
//
//		$message = "lol whatever";
//		$title = "Somebody messaged whatever";
//		$notification = array("body" => $message, "title " => $title);
//
//		$token = "ebfN5oHk_jQ:APA91bGmDlLX-vFYqIY86rxkD8kdsP5LZf33KCkvruP2oD5R_toilqrOcOYclIT3AUbrie-zMa-tcdn-9YmXi_xVaOgCe5hr3S9EFWrKzRDIO-6Vt3aU5OkviJQB5YJPWuV7CkURS7nY";
//
//		$data = [
//			'first_key' => 'First Value',
//			'second_key' => 'Second Value',
//		];
//		$message = CloudMessage::fromArray([
//			'token' => $token,
//			'notification' => $notification, // optional
//		]);
//
//		try {
//			print_r($messaging->send($message));
//		} catch (Exception $e) {
//			print_r($e->getMessage());
//		}
	}
}
