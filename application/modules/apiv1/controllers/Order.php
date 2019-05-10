<?php

use Libraries\REST_Controller;

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
		$response = $this->Order_model->create($this->httpRequest);
		$this->response($response);
	}

	public function list_user_order_get()
	{
		$user_id = $this->get_path_variable('user-id');
		$response = $this->Order_model->get_orders_by_userId($user_id);
		return $this->response($response);
	}

	public function get_order_by_id_get()
	{
		$orderId = $this->get_path_variable('order-id');
		$res = $this->Order_model->get_order_by_id($orderId);
		return $this->response($res);
//		return $this->response($this->Order_model->get_order_details_by_id($orderId));
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

	public function get_orders_get()
	{
		return $this->response($this->Order_model->get_orders());
	}

	public function update_status_put()
	{
		$updateData = $this->httpRequest;
		$orderId = $updateData->ord_id;

		$orderStatus = new stdClass();
		$orderStatus->ord_statusId = $updateData->ord_statusId;
		$data = $this->Order_model->update_status($orderStatus, $orderId);

		if ($updateData->ord_statusId == 2) {
			$courierDetails = new stdClass();
			$courierDetails->osh_orderId = $updateData->ord_id;
			$courierDetails->osh_courierId = $updateData->courierId;
			$courierDetails->osh_courierTrackId = $updateData->courierTrackingId;
			$data = $this->Order_model->insert_courier_details($courierDetails);
		}
		return $this->response($data);
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

	//Order shippings
	public function get_all_shipping_methods_get()
	{
		$shipping_method_list = $this->Order_model->list_shipping_methods();
		return $this->response($shipping_method_list);
	}

	public function update_payment_status_put()
	{
		$updateData = $this->httpRequest;
		$orderId = $updateData->orp_orderId;
		unset($updateData->orp_orderId);

		return $this->response($this->Order_model->update_payment_status($updateData, $orderId));
	}


	/*
	 * Deprecated
	 */
	public function update_items_price_put()
	{
		return $this->response($this->Order_model->update_order_items_price($this->httpRequest));
	}

	public function get_order_get()
	{
		$orderId = $this->get_path_variable('id');
		$response = $this->Order_model->get_order_by_id($orderId);
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