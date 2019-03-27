<?php

require APPPATH . 'libraries/REST_Controller.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends REST_Controller {

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

		$this->load->library('session'); 
		$this->load->helper(array('form','url','date'));		 
		$this->load->database();
		$this->load->library('cloudinarylib');
	}

	
	// insert commercial car 
	public function insert_commercial_car_post()
	{
		
		$now = date('Y-m-d H:i:s');

		$data = array(  'user_id'       => $this->check_input('user_id'),	
						'car_type'      => $this->check_input('car_type'),
						'com_name'      => $this->check_input('company_name'),
						'com_email'    	=> $this->check_input('company_email'),
						'com_phone'    	=> $this->check_input('company_phone'),
						'address1'    	=> $this->check_input('address1'),
						'address2' 		=> $this->check_input('address2'),
						'city'    		=> $this->check_input('city'),
						'contact_name'  => $this->check_input('contact_name'),
						'contact_phone' => $this->check_input('contact_phone'),
						'truck_type'   	=> $this->check_input('truck_type'),
						'vin_number'   	=> $this->check_input('vin_number'),
						'car_make'   	=> $this->check_input('car_make'),
						'car_model'   	=> $this->check_input('car_model'),
						'car_year'   	=> $this->check_input('car_year'),
						'car_trim'   	=> $this->check_input('car_trim'),
						'mileage_range' => $this->check_input('mileage_range'),
						'actual_mileage'=> $this->check_input('actual_mileage'),						
						'created_at'	=> $now
					);

	 	$query = $this->db->insert('commercial_car',$data);

			if($query == true)
			{		 	
				$commercial_id = $this->db->insert_id();
				// $count = count($_FILES['img_url']['name']);

				// for($i = 0; $i < $count; $i++) {

					$img       =  $_FILES['img_url']['name'];
					$file_temp =  $_FILES['img_url']['tmp_name'];

					$image = \Cloudinary\Uploader::upload($file_temp);
					$car_img_url = $image['secure_url'];

					$img_data = array(	'commercial_id'	=> 	$commercial_id,
										'img_url' 		=>  $car_img_url,
										'created_at'	=> 	$now
									);

					$this->db->insert('car_images',$img_data);
				// }
				
				$response['status'] = 'success';
				$response['commercial_id'] = $commercial_id;

			}

			else
			{
				$response['status'] = 'failed';
			}
		
		$this->response($response, REST_Controller::HTTP_OK);
	}

	public function insert_driver_info_post()
	{
		$now = date('Y-m-d H:i:s');
		
		$get_vals = json_decode(file_get_contents('php://input'));

		$add_info = array();
		
				foreach ($get_vals as $get_val) 
				{
					array_push($add_info, 
					array('commercial_id'	=> $this->check_input_body($get_val->commercial_id),
							'f_name'		=> $this->check_input_body($get_val->f_name),
							'l_name'		=> $this->check_input_body($get_val->l_name),	
							'phone'			=> $this->check_input_body($get_val->phone),	
							'email'			=> $this->check_input_body($get_val->email),	
							'city'			=> $this->check_input_body($get_val->city),	
							'state'			=> $this->check_input_body($get_val->state),												
							'created_at'	=> $now
						));
				}

		if(count($add_info) > 0)
		{

			$query = $this->db->insert_batch('driver_info',$add_info);

			if($query == true)
			{		 	
				$response['status'] = 'success';
			}
			else
			{
				$response['status'] = 'failed';
			}
		}
		else{

			$response['msg'] = 'Please update driver info..';
		}

		
		$this->response($response, REST_Controller::HTTP_OK);
		
	}

	public function test_img_post()
	{
		$state	= $this->input->post('demo');

		print_r(json_decode($state));
	}

	// insert order part 
	public function insert_order_part_post()
	{
		
		$now = date('Y-m-d H:i:s');

		$data = array( 	
						'car_id'      	=> $this->check_input('car_id'),
						'user_id'    	=> $this->check_input('user_id'),
						'engine_part'   => $this->check_input('engine_part'),
						'part_type'    	=> $this->check_input('part_type'),
						'comments' 		=> $this->check_input('comments'),												
						'created_at'	=> $now
					);

					$img       =  $_FILES['img_url']['name'];
					$file_temp =  $_FILES['img_url']['tmp_name'];

					$image = \Cloudinary\Uploader::upload($file_temp);
					$part_img_url = $image['secure_url'];

					$img_data = array('part_img' =>  $part_img_url);
										
				$query = $this->db->insert('car_images',$img_data);
				
			if($query ==  true)
			{
				$response['status'] = 'success';
			}

			else
			{
				$response['status'] = 'failed';
			}
		
		$this->response($response, REST_Controller::HTTP_OK);
	}

	// get car details private and commercial
	public function get_car_details_post()
	{
		$this->data = json_decode(file_get_contents('php://input'));

		$user_id = $this->data->user_id;

		$this->db->select('*');
		$this->db->from('commercial_car');		
		$this->db->join('car_images', 'car_images.commercial_id = commercial_car.commercial_id', 'left');
		$this->db->where('commercial_car.user_id',$user_id);
		
		$query = $this->db->get()->result();
		
		$response['status'] = "success";		
		$response['car_detail'] = $query;

		$this->response($response, REST_Controller::HTTP_OK);
		
	}

	// get driver_info
	public function get_driver_info_post()
	{
		$this->data = json_decode(file_get_contents('php://input'));

		$commercial_id = $this->data->commercial_id;

		$this->db->select('*');
		$this->db->from('driver_info');
		$this->db->where('driver_info.commercial_id',$commercial_id);

		$data['driver_detail'] = $this->db->get()->result();		

		$response['status'] = "success";
		$response['driver_detail'] = $data['driver_detail'];
		
		$this->response($response, REST_Controller::HTTP_OK);
		
	}

	// get  private and commercial count
	public function get_car_details_count_post()
	{
		$this->data = json_decode(file_get_contents('php://input'));

		$user_id = $this->data->user_id;
		
		$sql = "select count(*) from commercial_car where user_id = '$user_id' and car_type='private' ";
		$data['private_car'] = $this->db->query($sql)->result(); 

		$com_car = "select count(*) from commercial_car where user_id = '$user_id' and car_type='commercial' ";
		$data['com_car'] = $this->db->query($com_car)->result();
		
		$response['status'] = "success";
		$response['private_car'] = $data['private_car'] ;
		$response['com_car'] = $data['com_car'];
		
		$this->response($response, REST_Controller::HTTP_OK);
		
	}

	// order service pack 
	// public function order_service_pack_post()
	// {
		
	// 	$now = date('Y-m-d H:i:s');

	// 	$data = array(  'user_id'       	=> $this->check_input('user_id'),
	// 					'car_id'       		=> $this->check_input('car_id'),	
	// 					'current_mileage'   => $this->check_input('current_mileage'),
	// 					'comments'    		=> $this->check_input('comments'),
	// 					'f_name'    		=> $this->check_input('f_name'),
	// 					'l_name'    		=> $this->check_input('l_name'),
	// 					'address1' 			=> $this->check_input('address1'),
	// 					'address2'    		=> $this->check_input('address2'),
	// 					'country'  			=> $this->check_input('country'),
	// 					'state' 			=> $this->check_input('state'),
	// 					'city'   			=> $this->check_input('city'),
	// 					'phone'   			=> $this->check_input('phone'),
	// 					'email'   			=> $this->check_input('email'),												
	// 					'created_at'		=> $now
	// 				);

	//  	$query = $this->db->insert('commercial_car',$data);

	// 		if($query == true)
	// 		{		 	
	// 			$commercial_id = $this->db->insert_id();
	// 			// $count = count($_FILES['img_url']['name']);

	// 			// for($i = 0; $i < $count; $i++) {

	// 				$img       =  $_FILES['img_url']['name'];
	// 				$file_temp =  $_FILES['img_url']['tmp_name'];

	// 				$image = \Cloudinary\Uploader::upload($file_temp);
	// 				$car_img_url = $image['secure_url'];

	// 				$img_data = array(	'commercial_id'	=> 	$commercial_id,
	// 									'img_url' 		=>  $car_img_url,
	// 									'created_at'	=> 	$now
	// 								);

	// 				$this->db->insert('car_images',$img_data);
	// 			// }
				
	// 			$response['status'] = 'success';
	// 			$response['commercial_id'] = $commercial_id;

	// 		}

	// 		else
	// 		{
	// 			$response['status'] = 'failed';
	// 		}
		
	// 	$this->response($response, REST_Controller::HTTP_OK);
	// }



	// send data from header
	public function check_input($data_var)
	{

		if ($data = ($this->input->server(strtoupper('http_'.$data_var)) !== null) ? $this->input->server(strtoupper('http_'.$data_var)) : 'NULL') 
		{
			return $data;
		}
	}

	// data send to body
	public function check_input_body($data_var)
	{
		if ($data = ($data_var !== null) ? $data_var : 'NULL') 
		{
			return $data;
		}
	}
}