<?php

use Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('cloudinarylib');
	}


	// insert commercial car 
	public function imageupload_post()
	{
		$img = $_FILES['img_url']['name'];
		$file_temp = $_FILES['img_url']['tmp_name'];

		//    $image = \Cloudinary\Uploader::add_tag('animals', array('vz6nlf6jwsx4d0gqcq4g'));



		$image = \Cloudinary\Uploader::$api->resources_by_tag("animal");


		// $image = \Cloudinary\Uploader::upload($file_temp, array("tags" => "animal"));
		// $image = \Cloudinary\Uploader::destroy('uvdu43twer0baqjn7iqb');

		// $car_img_url = $image['secure_url'];

		// $this->response($car_img_url, REST_Controller::HTTP_OK);
		print_r($image);
		// print_r($car_img_url);
	}

	function demo_post()
	{
		$response = array('true', 200, "message", array());
		$this->response($response, 200, true);

		$myFile = "D:\wamp\www\demo.txt";
		$message = "welcome message";
		if (file_exists($myFile)) {
			$fh = fopen($myFile, 'a');
			fwrite($fh, $message . "\n");
		} else {
			$fh = fopen($myFile, 'w');
			fwrite($fh, $message . "\n");
		}
		fclose($fh);
		
		$response1 = array('false', 200, "message", array());
		$this->response($response1, 200, false);
	}
}
