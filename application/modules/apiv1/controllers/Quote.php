<?php

 use Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Quote_model');
	}

	public function create_quote_post()
	{
		$response = $this->Quote_model->create( $this->httpRequest);
		$this->response($response);
	}

	public function list_user_quotes_get()
	{
		$user_id = $this->get_path_variable('user-id');
		$response = $this->Quote_model->get_quotes_by_userId($user_id);
		return $this->response($response);
	}

	public function get_quote_by_id_get()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->get_quote_by_id($quoteId);
		return $this->response($response);
	}

	public function add_item_to_quote_post()
	{
		$response = $this->Quote_model->add_item( $this->httpRequest);
		$this->response($response);
	}

	public function remove_item_from_quote_post()
	{
		$response = $this->Quote_model->remove_item( $this->httpRequest);
		$this->response($response);
	}

	public function update_price_for_quote_item_post()
	{
		$response = $this->Quote_model->update_quote_price( $this->httpRequest);
		$this->response($response);
	}

	public function update_quote_status_put()
	{
		$quoteId = $this->get_path_variable('quote-id');

		$response = $this->Quote_model->update_status( $this->httpRequest,$quoteId);
		if ($response) {
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function update_quote_shipping_post()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->update_quote_shipping( $this->httpRequest,$quoteId);
		$this->response($response);
	}

	public function convert_to_order_post()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->convert_to_order($quoteId);
		$this->response($response);
	}




	public function update_order_put()
	{
		$orderId = $this->get_path_variable('id');
		$response = $this->Quote_model->update_order($this->httpRequest, $orderId);
		return $this->response($response);
	}

	public function create_shipping_address_by_user_id_post()
	{
		$userId = $this->get_path_variable('user-id');
		$this->validateVariable($userId);
		$this->Quote_model->create_shipping_address($this->httpRequest);
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


	public function delete_order_delete()
	{
		$id = $this->uri->segment(3);
		$data = $this->Quote_model->delete($id);
	}

	/*public function get_order_get()
	{
		$order_list = $this->Quote_model->get_orders();
		return $this->response($order_list, REST_Controller::HTTP_OK);
	}*/

	public function get_cart_items_by_order_id_get()
	{
		$orderId = $this->get_path_variable('order-id');
		$cart_items = $this->Quote_model->get_cart_items($orderId);
		return $this->response($cart_items);
	}

	//Order shippings
	public function get_all_shipping_methods_get()
	{
		$shipping_method_list = $this->Quote_model->list_shipping_methods();
		return $this->response($shipping_method_list);
	}

	public function create_order_message_post()
	{
		return $this->response($this->Quote_model->create_order_message($this->httpRequest));
	}

	public function list_order_message_get()
	{
		$orderId = $this->get_path_variable('order-id');
		return $this->response($this->Quote_model->get_order_messages($orderId));
	}

	public function get_orders_get()
	{
		return $this->response($this->Quote_model->get_orders());
	}

	public function get_orders_by_orderId_get()
	{
		$orderId = $this->get_path_variable('order-id');
		return $this->response($this->Quote_model->get_order_details_by_id($orderId));
	}

	public function update_items_price_put()
	{
		return $this->response($this->Quote_model->update_order_items_price($this->httpRequest));
	}

	public function update_status_put()
	{
		$updateData = $this->httpRequest;
		$orderId = $updateData->ord_id;
		$orderStatusId = $updateData->ord_statusId;
		if ($orderStatusId == 3) {
			$updateData->ord_orderId = $this->Quote_model->generate_order_number($orderId);
		}
		unset($updateData->ord_id);
		return $this->response($this->Quote_model->update($updateData, $orderId));
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