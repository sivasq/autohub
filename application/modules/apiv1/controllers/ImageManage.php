<?php
/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 22-03-2019 022
 * Time: 14:43
 */
 use Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageManage extends MY_Controller
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->library('cloudinarylib');
	}


	// insert commercial car
	public function upload_post()
	{
		if (($_FILES['cloudImage']['size']) > 0) {
			$img = $_FILES['cloudImage']['name'];
			$file_temp = $_FILES['cloudImage']['tmp_name'];

			$uploadImage = \Cloudinary\Uploader::upload($file_temp);

			$this->response(array(true, 200, "image uploaded", array("imageUrl" =>$uploadImage['secure_url'])), REST_Controller::HTTP_OK);
		}else{
			$this->response(array(false, 200, "image upload Failed", array()), REST_Controller::HTTP_OK);
		}
	}
}