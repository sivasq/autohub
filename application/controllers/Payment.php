<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
    }

    public function create_payment_bank_post()
    {

        return $this->response($this->Payment_model->create_bank($this->httpRequest));
    }

    public function list_payment_bank_get()
    {

        return $this->response($this->Payment_model->list_banks());
    }

    public function list_payment_method_get()
    {

        return $this->response($this->Payment_model->list_methods());
    }


    public function create_order_payment_post()
    {
        return $this->response($this->Payment_model->create_payment($this->httpRequest));
    }


}