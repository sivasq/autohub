<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleType extends MX_Controller
{

    var $viewClass = "admin/vehicle/VehicleType";
    var $viewPage = "vehicle/type";
    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Vehicletype_model');
    }

    public function index()
    {
        $data['page_name'] = 'VehicleType';
        $this->load->view($this->viewClass, $data);
    }

    public function create(){

        $data = $this->input->post();
      //  $this->loadFormHelpers();
        $this->validate_form();
        $submitType = $data["create_update"];
        unset($data["create_update"]);
        $id = $data["id"];
        $model_data = $this->Vehicletype_model->build_generic_model_data($data);

        if ($submitType == "Create") {
            if ($this->form_validation->run() === false) {
                $this->load->view($this->viewClass,$data);
            }else {
                if ($this->Vehicletype_model->insert($model_data)) {
                    redirect($this->viewPage);
                }
            }
        }else{

            if ($this->Vehicletype_model->update($model_data, $id)) {
                redirect($this->viewPage);
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Vehicletype_model->delete($id);
    }

    private function validate_form(){

        $this->form_validation->set_rules(array(
            array(
                'field' => 'name',
                'label' => 'Vehicle Type',
                'rules' => 'required|is_unique['.$this->Vehicletype_model->getTable().'.'.$this->Vehicletype_model->getPrfx().'name]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                    'is_unique' => '%s already exists',
                ),
            )
        ));
    }

    private function loadFormHelpers(){

        $this->load->helper('form');
        $this->load->library('form_validation');
    }


}