<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'models/dto/vehicle/VehicleDTO.php';
require APPPATH . 'models/dto/vehicle/CommercialDataDTO.php';
require APPPATH . 'models/dto/vehicle/CompanyDataDTO.php';
require APPPATH . 'models/dto/vehicle/DriverDTO.php';

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
     * Vehicles
     * */
    public function create_vehicle_post()
    {
        return $this->response($this->Vehicle_model->insert($this->Vehicle_model->build_generic_model_data($this->httpRequest)));
    }

    public function update_vehicle_put()
    {
        $vehicleId = $this->get_path_variable('id');
        $model_data = $this->Vehicle_model->build_generic_model_data($this->httpRequest);
        return $this->response($this->Vehicle_model->update($model_data, $vehicleId));
    }

    public function list_user_vehicles_get()
    {
        $userId = $this->get_path_variable('user-id');
        return $this->response($this->Vehicle_model->list_vehicles_by_user_id($userId));

    }


    /*
 * Vehicle Companies
 * */
    public function create_vehicle_company_post()
    {
        $model_data = $this->Company_model->build_generic_model_data($this->httpRequest);
        return $this->response($this->Company_model->insert($model_data));
    }

    public function update_vehicle_company_put()
    {
        $company_id = $this->get_path_variable('id');
        $model_data = $this->Company_model->build_generic_model_data($this->httpRequest);
        return $this->response($this->Company_model->update($model_data, $company_id));
    }

    public function get_all_user_companies_get()
    {
        return $this->response($this->Company_model->list_by_field("userId", (int)$this->get_path_variable('user-id')));
    }


    /*
     * Vehicle Drivers
     * */
    public function create_vehicle_driver_post()
    {
        $model_data = $this->Driver_model->build_generic_model_data($this->httpRequest);
        return $this->response($this->Driver_model->insert($model_data));
    }

    public function update_vehicle_driver_put()
    {
        $driver_id = $this->get_path_variable('id');
        $model_data = $this->Driver_model->build_generic_model_data($this->httpRequest);
        return $this->response($this->Driver_model->update($model_data, $driver_id));
    }

    public function get_all_user_drivers_get()
    {
        return $this->response($this->Driver_model->list_by_field("companyId", (int)$this->get_path_variable('company-id')));
    }


    //Business types
    public function list_business_types_get()
    {
        return $this->response($this->Businesstype_model->list_all());
    }

    //vehicle types
    public function list_vehicle_types_get()
    {
        return $this->response($this->Vehicletype_model->list_all());
    }

    //Data table

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