<?php

 use Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');

		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		$method = $_SERVER['REQUEST_METHOD'];

		if ($method == "OPTIONS") {
			die();
		}

		parent:: __construct();

		// $this->load->library('session'); 
		// $this->load->helper(array('form','url','date'));		 
		$this->load->library('cloudinarylib');
	}

	
	// insert commercial car 
	public function imageupload_post()
	{
		$img = $_FILES['img_url']['name'];
		$file_temp = $_FILES['img_url']['tmp_name'];

    //    $image = \Cloudinary\Uploader::add_tag('animals', array('vz6nlf6jwsx4d0gqcq4g'));

  

		$image = \Cloudinary\Uploader :: $api->resources_by_tag("animal");


        // $image = \Cloudinary\Uploader::upload($file_temp, array("tags" => "animal"));
        // $image = \Cloudinary\Uploader::destroy('uvdu43twer0baqjn7iqb');
            
		// $car_img_url = $image['secure_url'];

        // $this->response($car_img_url, REST_Controller::HTTP_OK);
        print_r($image);
        // print_r($car_img_url);
	}

}