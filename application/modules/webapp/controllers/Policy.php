<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Policy extends User_Controller
{

    var $viewClass = "admin/policy";
    var $viewPage = "shipping-method";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('apiv1/Policy_model');
    }

    public function policy_view()
    {
        $data['page_name'] = 'Policy';
        $data['product_poliy']  = (object)$this->Policy_model->get_policy_by_id(1)[3];
        $data['shipping_poliy']  = (object)$this->Policy_model->get_policy_by_id(2)[3];
        $data['return_poliy']  = (object)$this->Policy_model->get_policy_by_id(3)[3];
        $data['customer_poliy']  = (object)$this->Policy_model->get_policy_by_id(4)[3];
        $this->load->view('admin/policy/policy_view', $data);
    }

    public function policy_update()
    {
        $product_poliy  = $this->Policy_model->update_policy_by_id($this->input->post());
        redirect('policy/policy-view');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Shippingmethod_model->delete($id);
    }
}
