<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Base_Controller
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Order_model');
    }

    public function index()
    {
        $this->load->view('admin/order/orderdata');
    }

    public function detail_view()
    {
        $orderId = $this->get_path_variable('order-id');
        $data = new stdClass();
        $data->itemData = $this->Order_model->get_order_items_by_id($orderId);
        $data->statusData = $this->Order_model->get_order_status();
//        echo json_encode($data);
//        die();

        $this->load->view('admin/order/orderdetails', $data);
    }

    public function update_items_price()
    {
        $update_data = json_decode(file_get_contents('php://input'));
        return json_encode($update_data);
    }

    public function get_path_variable($path)
    {
        $data = $this->uri->uri_to_assoc();
        // echo json_encode($data);die;
        $code = $data[$path];
        return $code;
    }

}