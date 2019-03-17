<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function create_shipping_address_by_user_id_post()
    {
        $response = $this->User_model->create_shipping_address($this->httpRequest);
        return $this->response($response, REST_Controller::HTTP_OK);
    }

    public function update_shipping_address_by_shipping_id_put()
    {
        $shippingId = $this->get_path_variable('id');
        $this->validateVariable($shippingId);
        $updatedShippingData = $this->User_model->update_shipping_address($this->httpRequest, $shippingId);
        return $this->response($updatedShippingData, REST_Controller::HTTP_OK);
    }

    public function get_shipping_address_by_user_id_get()
    {
        $userId = $this->get_path_variable('user-id');
        $this->validateVariable($userId);
        $responseData = $this->User_model->list_shipping_address($userId);
        return $this->response($responseData, REST_Controller::HTTP_OK);
    }

}