<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }

    public function create_order_post()
    {
        $request = json_decode(file_get_contents('php://input'));
//        $mapper = new JsonMapper();
//        $data = $mapper->map($request, new VehicleDTO());
//        print_r($data);
//        die();
        $response = $this->Order_model->create($request);
        $this->response($response);
    }

    public function update_order_put()
    {
        $orderId = $this->get_path_variable('id');
        $response = $this->Order_model->update_order($this->httpRequest, $orderId);
        return $this->response($response);
    }

    public function get_order_get()
    {

        $orderId = $this->get_path_variable('id');
        $response = $this->Order_model->get_order_by_id($orderId);
        return $this->response($response);

    }

    public function list_all_user_order_get()
    {
        $user_id = $this->get_path_variable('user-id');
        $response = $this->Order_model->get_orders_by_userId($user_id);
        return $this->response($response);
    }

    public function create_shipping_address_by_user_id_post()
    {
        $userId = $this->get_path_variable('user-id');
        $this->validateVariable($userId);
        $this->Order_model->create_shipping_address($this->httpRequest);
    }

    public function update_shipping_address_by_user_id_put()
    {
        $userId = $this->get_path_variable('user-id');
        $this->validateVariable($userId);
    }

    public function get_shipping_address_by_user_id_get()
    {
        $userId = $this->get_path_variable('user-id');
        $this->validateVariable($userId);
    }


    public function update_order_status_put()
    {
        $orderId = $this->get_path_variable('orderId');

        $data = $this->Order_model->update_status($this->httpRequest, $orderId);
        if ($data) {
            return $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        } else {
            return $this->response(array('status' => 'failed'), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function delete_order_delete()
    {
        $id = $this->uri->segment(3);
        $data = $this->Order_model->delete($id);
    }

    /*public function get_order_get()
    {
        $order_list = $this->Order_model->get_orders();
        return $this->response($order_list, REST_Controller::HTTP_OK);
    }*/

    public function get_cart_items_by_order_id_get()
    {
        $orderId = $this->get_path_variable('order-id');
        $cart_items = $this->Order_model->get_cart_items($orderId);
        return $this->response($cart_items);
    }

    ///Order shippings
    public function get_all_shipping_methods_get()
    {

        $shipping_method_list = $this->Order_model->list_shipping_methods();
        return $this->response($shipping_method_list);

    }

    public function create_order_message_post()
    {
        return $this->response($this->Order_model->create_order_message($this->httpRequest));
    }

    public function list_order_message_get()
    {
        $orderId = $this->get_path_variable('order-id');
        return $this->response($this->Order_model->get_order_messages($orderId));
    }

    public function get_orders_get()
    {
        return $this->response($this->Order_model->get_orders());
    }

    public function get_orders_by_orderId_get()
    {
        $orderId = $this->get_path_variable('order-id');
        return $this->response($this->Order_model->get_order_details_by_id($orderId));
    }

    public function update_items_price_put()
    {
        return $this->response($this->Order_model->update_order_items_price($this->httpRequest));
    }

    public function update_status_put()
    {
        $updateData = $this->httpRequest;
        $orderId = $updateData->ord_id;
        $orderStatusId = $updateData->ord_statusId;
        if ($orderStatusId == 3) {
            $updateData->ord_orderId = $this->Order_model->generate_order_number($orderId);
        }
        unset($updateData->ord_id);
        return $this->response($this->Order_model->update($updateData, $orderId));
    }

//    private function send_notification($orderStatusId)
//    {
//
//        switch ($orderStatusId) {
//            case 2:
//                $message = "price added";
//                break;
//            case 3:
//                $message = "price addeed";
//                break;
//            case 4:
//                $message = "price addeed";
//                break;
//            case 5:
//                $message = "price addeed";
//                break;
//
//        }
//    }

}