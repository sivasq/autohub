<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Policy extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('apiv1/Policy_model');
    }

    public function get_policies_get()
    {
        $data['product_poliy']  = $this->Policy_model->get_policy_by_id(1)[3];
        $data['shipping_poliy']  = $this->Policy_model->get_policy_by_id(2)[3];
        $data['return_poliy']  = $this->Policy_model->get_policy_by_id(3)[3];
        return $this->response(array(true, 200, 'Policies', $data));
    }
}
