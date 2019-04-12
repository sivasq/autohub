<?php

use Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

//require APPPATH . 'models/dto/vehicle/VehicleDTO.php';
//require APPPATH . 'models/dto/vehicle/CommercialDataDTO.php';
//require APPPATH . 'models/dto/vehicle/CompanyDataDTO.php';
//require APPPATH . 'models/dto/vehicle/DriverDTO.php';

class Vehicle extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Vehicle_model');
		$this->load->model('Company_model');
		$this->load->model('Driver_model');
		$this->load->model('Businesstype_model');
		$this->load->model('Vehicletype_model');
	}

	/*
	* Vehicle Companies
	*/

	/*
	 * Format : { "userId":1, "companyName":"Broadtech123", "email":"bradmin@gmail.com", "phone":"1232321321", "address1":"jhdgfjhgsd", "address2":"ewrrewe", "city":"trivandrum" }
	 */
	public function create_vehicle_company_post()
	{
		$model_data = $this->Company_model->build_generic_model_data($this->httpRequest, array('createdAt' => date('Y-m-d H:i:s')));
		return $this->response($this->Company_model->insert($model_data, '', 'companyId', 'Company Created Successfully'));
	}

	/*
	 * Format : { "userId":1, "companyName":"BRTech", "email":"test@gmail.com", "phone":"1232321321", "address1":"jhdgfjhgsd", "address2":"ewrrewe", "city":"trivandrum" }
	 */
	public function update_vehicle_company_put()
	{
		$company_id = $this->get_path_variable('company-id');
		$model_data = $this->Company_model->build_generic_model_data($this->httpRequest);
		return $this->response($this->Company_model->update($model_data, $company_id, '', '', 'Company Updated Successfully'));
	}

	/*
	 * No body
	 */
	public function get_all_companies_by_user_get()
	{
		return $this->response($this->Company_model->list_by_field("userId", (int)$this->get_path_variable('user-id'), '', '', 'companies'));
	}


	/*
	 * Vehicle Drivers
	 */

	/*
	 * Format : { "companyId":1, "firstName":"Vishnu", "lastName":"thomas", "email":"test@gmail.com", "phone":"1232321321", "city":"trivandrum", "state":"kerala" }
	 */
	public function create_vehicle_driver_post()
	{
		$model_data = $this->Driver_model->build_generic_model_data($this->httpRequest, array('createdAt' => date('Y-m-d H:i:s')));
		return $this->response($this->Driver_model->insert($model_data, '', 'driverId', 'Driver Created Successfully'));
	}

	/*
	 * Format : { "companyId":1, "firstName":"BIN--U-Satish", "lastName":"thomas", "email":"test@gmail.com", "phone":"1232321321", "city":"trivandrum", "state":"Keralaa" }
	 */
	public function update_vehicle_driver_put()
	{
		$driver_id = $this->get_path_variable('driver-id');
		$model_data = $this->Driver_model->build_generic_model_data($this->httpRequest);
		return $this->response($this->Driver_model->update($model_data, $driver_id, '', '', 'Driver Updated Successfully'));
	}

	/*
	 * No Body
	 */
	public function get_all_drivers_by_company_get()
	{
		return $this->response($this->Driver_model->list_by_field("companyId", (int)$this->get_path_variable('company-id'), '', '', 'drivers'));
	}

	/*
    * No Body
    */
	public function get_driver_by_vehicle_get()
	{
		$driver = $this->Driver_model->list_driver_by_vehicle((int)$this->get_path_variable('vehicle-id'));
		return $this->response($driver, 200);
	}

	/*
	* Business types
	*/
	public function list_business_types_get()
	{
		return $this->response($this->Businesstype_model->list_all('', '', '', 'vehicleBusinessTypes'));
	}


	/*
	* vehicle types
	*/
	public function list_vehicle_types_get()
	{
		return $this->response($this->Vehicletype_model->list_all('', '', '', 'vehicleTypes'));
	}

	/*
	* vehicle types
	*/
	public function list_vehicle_types_dt_get()
	{
		return $this->response($this->Vehicletype_model->list_all());
	}

	/*
	 * Vehicles
	 */

	/*
	 * Format : { "userId":1, "vin":123231, "vehicleTypeId":1, "year": "2019", "make": "nissan", "model": "kicks", "trim": "string", "image": "string", "businessTypeId":1, "companyId": 1, "driverId": 1, "mileageRange":"1233", "actualMileage": "130" }
	 */
	public function create_vehicle_post()
	{
		return $this->response($this->Vehicle_model->insert($this->Vehicle_model->build_generic_model_data($this->httpRequest, array('createdAt' => date('Y-m-d H:i:s'))), '', 'vehicleId', 'Vehicle Created Successfully'));
	}

	/*
	 * Format : { "userId":1, "vin":123231, "vehicleTypeId":1, "year": "2019", "make": "Nissan", "model": "Kicks", "trim": "123213", "image": "232131", "businessTypeId":1, "companyId": 1, "driverId": 1, "mileageRange":"1233", "actualMileage": "130" }
	 */
	public function update_vehicle_put()
	{
		$vehicleId = $this->get_path_variable('vehicle-id');
		$model_data = $this->Vehicle_model->build_generic_model_data($this->httpRequest);
		return $this->response($this->Vehicle_model->update($model_data, $vehicleId, '', '', 'Vehicle Updated Successfully'));
	}

	/*
	 * No body
	 */
	public function list_user_vehicles_get()
	{
		$userId = $this->get_path_variable('user-id');
		return $this->response($this->Vehicle_model->list_vehicles_by_user_id($userId));
	}

	/*
	 * No body
	 */
	public function get_vehicle_count_get()
	{
		$userId = $this->get_path_variable('user-id');
		$private = $this->Vehicle_model->get_vehicle_count($userId, 1);
		$commercial = $this->Vehicle_model->get_vehicle_count($userId, 2);
		return $this->response($this->Vehicle_model->model_response(true, 200, array('private' => $private, 'commercial' => $commercial)));
	}

	//=====================================================================
	/*
	* Data table
	*/
	public function get_vehicles_get()
	{
		return $this->response($this->Vehicle_model->get_vehicles_data());
	}

	public function get_vehicles_by_vehicle_id_get()
	{
		$vehicleId = $this->get_path_variable('vehicle-id');
		return $this->response($this->Vehicle_model->get_vehicles_by_vehicle_id($vehicleId));
	}
}
