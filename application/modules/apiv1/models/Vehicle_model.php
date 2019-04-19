<?php
require_once APPPATH . 'core/Generic_model.php';

class Vehicle_model extends Generic_model
{
	var $tbl_vehicle = "vehicles";
	var $prfx_vehicle = "vhl_";
	var $tbl_vehicle_type = "vehicle_types";
	var $tbl_vehicle_company = 'vehicle_companies';
	var $prefix_vehicle_company = 'vcm_';
	var $tbl_users = 'users';

	var $tbl_vehicle_driver = "vehicle_drivers";
	var $tbl_business_type = "vehicle_business_type";
	var $prfx_business_type = "vbt_";
	var $prefix_vehicle_driver = 'vdr_';
	var $prfx_vehicle_type = "vtyp_";

	public function __construct()
	{
		parent::__construct($this->tbl_vehicle, $this->prfx_vehicle);
		$this->load->helper('inflector');
	}

	public function list_vehicles_by_user_id($userId)
	{
		$this->db->select($this->tbl_vehicle . ".*, " . $this->prfx_vehicle_type . "name as vehicleType, " . $this->prfx_business_type . "name as businessType, " . $this->prefix_vehicle_company . "companyName , " . $this->prefix_vehicle_driver . "firstName as driverName, " . $this->tbl_users . ".country");
		$this->db->from($this->tbl_vehicle);
		$this->db->join($this->tbl_vehicle_type, $this->prfx_vehicle_type . "id = " . $this->prfx_vehicle . "vehicleTypeId", "left");
		$this->db->join($this->tbl_business_type, $this->prfx_business_type . "id = " . $this->prfx_vehicle . "businessTypeId", "left");
		$this->db->join($this->tbl_vehicle_company, $this->prefix_vehicle_company . "id = " . $this->prfx_vehicle . "companyId", "left");
		$this->db->join($this->tbl_vehicle_driver, $this->prefix_vehicle_driver . "id = " . $this->prfx_vehicle . "driverId", "left");
		$this->db->join($this->tbl_users, "user_id = vhl_userId", "left");
		$this->db->where($this->prfx_vehicle . "userId", $userId);
		$this->db->order_by('vhl_createdAt', 'DESC');
		$result = $this->build_response_array($this->db->get()->result_array());
		return $this->model_response(true, 200, array('vehicles' => $result));
	}

	public function get_vehicle_count($userId, $vehicleBusinessTypeId)
	{
		return $this->db->where(array('vhl_userId' => $userId, 'vhl_businessTypeId' => $vehicleBusinessTypeId))->count_all_results($this->tbl_vehicle);
	}

	public function get_vehicle_joins(&$db, $relation_field)
	{
		$db->join($this->tbl_vehicle, $this->prfx_vehicle . "id = " . $relation_field, "left");
		$db->join($this->tbl_vehicle_type, $this->prfx_vehicle_type . "id = " . $this->prfx_vehicle . "vehicleTypeId", "left");
		$db->join($this->tbl_business_type, $this->prfx_business_type . "id = " . $this->prfx_vehicle . "businessTypeId", "left");
		$db->join($this->tbl_vehicle_company, $this->prefix_vehicle_company . "id = " . $this->prfx_vehicle . "companyId", "left");
		$db->join($this->tbl_vehicle_driver, $this->prefix_vehicle_driver . "id = " . $this->prfx_vehicle . "driverId", "left");
	}

	public function get_vehicle_select_items()
	{
		return $this->prfx_vehicle . "id as vehicleId, " .
			$this->prfx_vehicle . "vin as vehicleVin, " .
			$this->prfx_vehicle . "year as vehicleYear, " .
			$this->prfx_vehicle . "make as vehicleMake, " .
			$this->prfx_vehicle . "model as vehicleModel, " .
			$this->prfx_vehicle . "trim as vehicleTrim, " .
			$this->prfx_vehicle . "actualMileage as vehicleActualMileage, " .
			$this->prfx_vehicle . "image as vehicleImage, " .
			$this->prfx_vehicle_type . "name as vehicleType, " .
			$this->prfx_business_type . "name as businessType, " .
			$this->prefix_vehicle_company . "companyName , " .
			$this->prefix_vehicle_driver . "firstName as driverName";
	}

	public function select_vehicle_fields_for_quot_list()
	{
		return $this->prfx_vehicle . "id as vehicleId, " .
			$this->prfx_vehicle . "vin as vehicleVin, " .
			$this->prfx_vehicle . "year as vehicleYear, " .
			$this->prfx_vehicle . "make as vehicleMake, " .
			$this->prfx_vehicle . "model as vehicleModel, " .
			$this->prfx_vehicle . "image as vehicleImage";
	}

	// For Admin panel
	public function get_vehicles_data()
	{
		$this->db->select($this->tbl_vehicle . ".*, " . $this->prfx_vehicle_type . "name as vehicleType, " . $this->prfx_business_type . "name as businessType, " . $this->prefix_vehicle_company . "companyName ,concat(vhl_make,' ',vhl_model,' ',vhl_year) as vehicleInfo, concat(first_name,' ',last_name) as user");
		$this->db->from($this->tbl_vehicle);
		$this->db->join($this->tbl_vehicle_type, $this->prfx_vehicle_type . "id = " . $this->prfx_vehicle . "vehicleTypeId", "left");
		$this->db->join($this->tbl_business_type, $this->prfx_business_type . "id = " . $this->prfx_vehicle . "businessTypeId", "left");
		$this->db->join($this->tbl_vehicle_company, $this->prefix_vehicle_company . "id = " . $this->prfx_vehicle . "companyId", "left");
		$this->db->join($this->tbl_users, "user_id = " . $this->prfx_vehicle . "userId", "left");
		$result = $this->build_response_array($this->db->get()->result_array(), NULL, array("createdAt"));
		return $this->model_response(true, 200, $result);
	}

	public function get_vehicle_details_by_vehicle_id($vehicle_id)
	{
		$this->db->select($this->tbl_vehicle . ".*, " . $this->prfx_vehicle_type . "name as vehicleType, " . $this->prfx_business_type . "name as businessType, " . $this->prefix_vehicle_company . "companyName ,concat(vhl_make,' ',vhl_model,' ',vhl_year) as vehicleInfo, vcm_companyName as companyName,concat(first_name, ' ', last_name) as userName");
		$this->db->from($this->tbl_vehicle);
		$this->db->join($this->tbl_vehicle_type, $this->prfx_vehicle_type . "id = " . $this->prfx_vehicle . "vehicleTypeId", "left");
		$this->db->join($this->tbl_business_type, $this->prfx_business_type . "id = " . $this->prfx_vehicle . "businessTypeId", "left");
		$this->db->join($this->tbl_vehicle_company, $this->prefix_vehicle_company . "id = " . $this->prfx_vehicle . "companyId", "left");
		$this->db->join($this->tbl_users, "user_id = vhl_userId", "left");
		$this->db->where('vhl_id', $vehicle_id);
		$result = $this->build_response_array($this->db->get()->result_array(), NULL, array("createdAt"));
		return $result[0];
	}

	public function get_driver_details_by_company_id($company_id)
	{
		$this->db->select($this->tbl_vehicle_driver . ".*, " . "concat(vdr_firstName,' ',vdr_lastName) as driverName");
		$this->db->from($this->tbl_vehicle_driver);
		$this->db->where('vdr_companyId', $company_id);
		$result = $this->build_response_array($this->db->get()->result_array(), NULL, array("createdAt"));
		return $result;
	}

	public function get_company_details_by_company_id($company_id)
	{
		$this->db->select($this->tbl_vehicle_company . ".*, " . "concat(vcm_address1,' ',vcm_address2) as address");
		$this->db->from($this->tbl_vehicle_company);
		$this->db->where('vcm_id', $company_id);
		$result = $this->build_response_array($this->db->get()->result_array(), NULL, array("createdAt"));
		return $result[0];
	}


	/*
	 * Deprecated Functions
	 */
	public function create_vehicle_company($company_data)
	{
		$this->db->insert($this->tbl_vehicle_company, $this->build_model_data($company_data, $this->prefix_vehicle_company));
		$company_id = $this->db->insert_id();
		return $this->model_response(true, 202, array("companyId" => $company_id));
	}

	public function update_vehicle_company($company_data, $company_id)
	{
		$this->db->where($this->prefix_vehicle_company . "id", $company_id);
		$this->db->update($this->tbl_vehicle_company, $this->build_model_data($company_data, $this->prefix_vehicle_company));
		return $this->model_response(true, 200);
	}

	public function list_vehicle_company_by_userId($user_id)
	{
		$this->db->from($this->tbl_vehicle_company);
		$this->db->where($this->prefix_vehicle_company . "userId", $user_id);
		$result = $this->build_response_array($this->db->get()->result_array());
		return $this->model_response(true, 200, $result);
	}

	public function create_vehicle_driver($driver_data)
	{
		$this->db->insert($this->tbl_vehicle_driver, $this->build_model_data($driver_data, $this->prefix_vehicle_driver));
		$driver_id = $this->db->insert_id();
		return $this->model_response(true, 202, array("driverId" => $driver_id));
	}

	public function update_vehicle_driver($driver_data, $driver_id)
	{
		$this->db->where($this->prefix_vehicle_driver . "id", $driver_id);
		$this->db->update($this->tbl_vehicle_driver, $this->build_model_data($driver_data, $this->prefix_vehicle_driver));
		return $this->model_response(true, 200);
	}

	public function list_vehicle_drivers_by_userId($company_id)
	{
		$this->db->from($this->tbl_vehicle_driver);
		$this->db->where($this->prefix_vehicle_driver . "companyId", $company_id);
		$result = $this->build_response_array($this->db->get()->result_array());
		return $this->model_response(true, 200, $result);
	}

	private function save_drivers($driverData, $companyId, $vehicleId)
	{
		try {
			$carDrivers = array();
			foreach ($driverData as $driver) {
				array_push(
					$carDrivers,
					array(
						'vehicle_id' => $vehicleId,
						'cmp_id' => $companyId,
						'driver_fname' => $this->check_input_body($driver->firstName),
						'driver_lname' => $this->check_input_body($driver->lastName),
						'driver_phone' => $this->check_input_body($driver->phoneNumber),
						'driver_email' => $this->check_input_body($driver->email),
						'driver_city' => $this->check_input_body($driver->city),
						'driver_state' => $this->check_input_body($driver->state),
						'driver_image' => $this->check_input_body($driver->image)
					)
				);
			}
			$this->db->insert_batch('driver', $carDrivers);
		} catch (Exception $e) {
			echo 'Message: ' . $e->getMessage();
		}
	}
}