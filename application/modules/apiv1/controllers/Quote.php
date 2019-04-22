<?php

use Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Quote extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Quote_model');
		$this->load->library('FCM_Message', NULL, 'fcm');
	}

	/*
	 * Format : { "userId": 1, "quoteItems": [ { "id": 42, "price": 450, "discount": 10, "total": 890, "quantity": 2 }, { "id": 43, "quantity": 2 } ] }
	 */
	public function create_quote_post()
	{
		$response = $this->Quote_model->create($this->httpRequest);
		$this->response($response);
	}

	/*
	 * No Body
	 */
	public function list_user_quotes_get()
	{
		$user_id = $this->get_path_variable('user-id');
		$response = $this->Quote_model->get_quotes_by_userId($user_id);
		return $this->response($response);
	}

	/*
	 * No Body
	 */
	public function get_quote_by_id_get()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->get_quote_by_id($quoteId);
		return $this->response($response);
	}

	/*
	 * Format : { "shippingAddressId": 2, "shippingMethodId": 3, "shippingTotal": 500 }
	 */
	public function accept_quote_post()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->update_quote_shipping($this->httpRequest, $quoteId);

		if($response[0]) {
			$acceptObject = new stdClass();
			$acceptObject->statusId = 3;

			$response = $this->Quote_model->update_status($acceptObject, $quoteId);
			if ($response) {
				$this->response($response, REST_Controller::HTTP_OK);
			} else {
				$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	/*
    * No Body
    */
	public function decline_quote_put()
	{
		$quoteId = $this->get_path_variable('quote-id');

		$declineObject = new stdClass();
		$declineObject->statusId = 4;

		$response = $this->Quote_model->update_status($declineObject, $quoteId);
		if ($response) {
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
		}
	}


	//For Admin Panel
	/*
	 * Format :
	 */
	public function get_quotes_get()
	{
		return $this->response($this->Quote_model->get_quotes());
	}

	public function update_items_price_put()
	{
		$orderId = $this->httpRequest[0]->orderId;
		$response = $this->Quote_model->update_quote_items_price($this->httpRequest);

		if ($response[0]) {
			$this->response($response, 200, TRUE);
		} else {
			$this->response($response, 200, FALSE);
		}

		$quoteDetail = $this->Quote_model->get_quote_detail_by_quote_id($orderId);
		$userDetail = $this->Quote_model->get_user_detail_by_user_id($quoteDetail->ord_userId);
		$deviceData = $this->Quote_model->get_device_token_by_email($userDetail->email);

		//Build For Push Notification
		$title = "Quote Update";
		$message = "Quote Price updated for " . $quoteDetail->ord_quoteId;
		$notification = array("body" => $message, "title" => $title);
		$token = $deviceData->token;

		$this->fcm->send($token, $notification);

		//Build For Mail
		$subject = "Quote Update Alert";
		$message = "Hi ";
		$message .= $userDetail->first_name . " " . $userDetail->last_name . ",<br/><br/>";
		$message .= "we have updated price for quotation ";
		$message .= "<b>".$quoteDetail->ord_quoteId."</b>";

		$this->sendEmail($message, $userDetail->email, $subject);
	}

	public function update_status_put()
	{
		$updateData = $this->httpRequest;
		$quoteId = $updateData->ord_id;
		unset($updateData->ord_id);

		return $this->response($this->Quote_model->update_status($updateData, $quoteId));
	}

	public function update_payment_status_put()
	{
		$updateData = $this->httpRequest;
		$orderId = $updateData->orp_orderId;
		unset($updateData->orp_orderId);

		return $this->response($this->Quote_model->update_payment_status($updateData, $orderId));
	}

	/*
	 * Format : { "statusId": 2 }
	 */
	public function update_quote_status_put()
	{
		$quoteId = $this->get_path_variable('quote-id');

		$response = $this->Quote_model->update_status($this->httpRequest, $quoteId);
		if ($response) {
			$this->response($response, REST_Controller::HTTP_OK);
		} else {
			$this->response($response, REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	/*
	 * No Body
	 */
	public function convert_to_order_post()
	{
		$quoteId = $this->get_path_variable('quote-id');
		$response = $this->Quote_model->convert_to_order($quoteId);
		$this->response($response);
	}

	/*
	* Deprecated Functions, But we need in future
	*/

	/*	 
	 * Format : { "userId": 2, "quoteId": 76, "quoteItems": [ { "id": 34, "price": 250, "discount": 0, "total": 210 }, { "id": 37, "price": 400, "discount": 0, "total": 100 } ] }
	 */
	public function add_item_to_quote_post()
	{
		$response = $this->Quote_model->add_item($this->httpRequest);
		$this->response($response);
	}

	/*
	 * Format : { "userId": 1, "quoteId": 79, "quoteItemId": 84 }
	 */
	public function remove_item_from_quote_post()
	{
		$response = $this->Quote_model->remove_item($this->httpRequest);
		$this->response($response);
	}

	/*
	 * Format : { "userId": 1, "quoteId": 76, "quoteItems": [ { "id": 75, "price": 280, "discount": 0, "total": 280 } ] }
	 */
	public function update_price_for_quote_item_post()
	{
		$response = $this->Quote_model->update_quote_price($this->httpRequest);
		$this->response($response);
	}
}