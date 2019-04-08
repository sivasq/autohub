<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Push_notify extends MY_Controller {

	function __construct()
	{
		parent::__construct();		
	}

	public function send_android_notification()
	{
		// simple loading
		// note: you have to specify API key in config before		
		$this->load->library('gcm');

		// simple adding message. You can also add message in the data,
		// but if you specified it with setMesage() already
		// then setMessage's messages will have bigger priority
		$this->gcm->setMessage('Test message '.date('d.m.Y H:s:i'));
		
		// add recepient or few
		// $this->gcm->addRecepient('fTjMCzdwPiA:APA91bFHMsK4yoSJPkkpa-lsjlzZV7Hhy5MubBbEp0PI3P5KSJ5iq63OFX7TxVGw5qt59eQc2NgzI9fyZ1oANGIy0KAzaH11h2feYwMrs6KFBWX-z2ly8FwGmbwNAqepiBM2bvTk9xJ8');

		// $this->gcm->addRecepient('fTjMCzdwPiA:APA91bFHMsK4yoSJPkkpa-lsjlzZV7Hhy5MubBbEp0PI3P5KSJ5iq63OFX7TxVGw5qt59eQc2NgzI9fyZ1oANGIy0KAzaH11h2feYwMrs6KFBWX-z2ly8FwGmbwNAqepiBM2bvTk9xJ8');
		
		$this->gcm->setRecepients(array('fTjMCzdwPiA:APA91bFHMsK4yoSJPkkpa-lsjlzZV7Hhy5MubBbEp0PI3P5KSJ5iq63OFX7TxVGw5qt59eQc2NgzI9fyZ1oANGIy0KAzaH11h2feYwMrs6KFBWX-z2ly8FwGmbwNAqepiBM2bvTk9xJ8'));
		// then send
		if ($this->gcm->send())
		{
			echo 'Success for all messages';

		}else{

			echo 'Some messages have errors';
		}
	
		// and see responses for more info
		print_r($this->gcm->status);
		print_r($this->gcm->messagesStatuses);
			
		die();
	}

	// "data": {
	// 	"message": "This is a FCM Topic Message!",
	// 	"title": "This is a title title",
	// 	"subtitle": "This is a subtitle",
	// 	"tickersText": "Tickertexthere...Tickertexthere",
	// 	"vibrate": 1,
	// 	"sound": 1,
	// 	"largeIcon": "large_icon",
	// 	"smallIcon": "small_icon"
	// }

}

/* End of file twilio_demo.php */