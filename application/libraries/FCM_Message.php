<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\ServiceAccount;

class FCM_Message
{
	public $firebase;
	public $messaging;
	/**
	 * CodeIgniter instance
	 *
	 * @var object
	 */
	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance();

		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/google-service-account.json');

		$this->firebase = (new Factory)
			->withServiceAccount($serviceAccount)
			->create();

		$this->messaging = $this->firebase->getMessaging();
	}

	public function send($token, $notification, $data = null)
	{
//		$data = [
//			'first_key' => 'First Value',
//			'second_key' => 'Second Value',
//		];

		$message = CloudMessage::fromArray([
			'token' => $token,
			'notification' => $notification, // optional
		]);

		try {
			$this->messaging->send($message);
			//print_r($this->messaging->send($message));
		} catch (Exception $e) {
			$e->getMessage();
			//print_r($e->getMessage());
		}
	}
}
