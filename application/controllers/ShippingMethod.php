<?php

 use Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class ShippingMethod extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
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