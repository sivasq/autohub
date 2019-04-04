<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends User_Controller
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('apiv1/Vehicle_model');
    }

    public function index()
    {
        $data['page_name'] = 'Vehicle';
        $this->load->view('admin/vehicle/VehicleData', $data);
    }

    public function detail_view()
    {
        $vehicleId = $this->get_path_variable('vehicle-id');
        $data = new stdClass();
        $vehicleDetails = $this->Vehicle_model->get_vehicle_details_by_vehicle_id($vehicleId);
        $data->itemData = $vehicleDetails;
        if($vehicleDetails["businessTypeId"]==2) {
            $data->driverData = $this->Vehicle_model->get_driver_details_by_company_id($vehicleDetails['companyId']);
            $data->companyData = $this->Vehicle_model->get_company_details_by_company_id($vehicleDetails['companyId']);
        }
        $this->load->view('admin/vehicle/VehicleDetails', $data);
    }

    public function business_type()
    {
        $data['page_name'] = 'BusinessType';
        $this->load->view('admin/vehicle/BusinessType', $data);
    }

    public function type()
    {
        $data['page_name'] = 'type';
        $this->load->view('admin/vehicle/type', $data);
    }

    public function get_path_variable($path)
    {
        $data = $this->uri->uri_to_assoc();
        // echo json_encode($data);die;
        $code = $data[$path];
        return $code;
    }


}