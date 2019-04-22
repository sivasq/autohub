<?php

require_once APPPATH . 'core/Generic_model.php';

class Payment_model extends Generic_model
{
	var $tbl_payment_methods = "payment_methods";
	var $tbl_payment_banks = "payment_banks";
	var $tbl_order_payment = "order_payments";
	var $prfx_order_payments = "orp_";

	var $prfx_payment_banks = "bnk_";

	public function __construct()
	{
		parent::__construct($this->tbl_order_payment, $this->prfx_payment_banks);
		$this->load->helper('inflector');
		$this->load->model('apiv1/Quote_model');
	}

	public function create_bank($bank_data)
	{
		$this->db->insert($this->tbl_payment_banks, $this->build_model_data($bank_data, $this->prfx_payment_banks));
		$bank_id = $this->db->insert_id();
		return $this->model_response(true, 202, array("bankId" => $bank_id));
	}

	public function list_banks()
	{
		$this->db->from($this->tbl_payment_banks);
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
		return $this->model_response(true, 200, array('banks' => $response_data));
	}

	public function list_methods()
	{
		$this->db->from($this->tbl_payment_methods);
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function create_payment($order_payment)
	{
		//Check Payment Status for quote
		$quotStatus = $this->Quote_model->get_quote_status_by_quot_id($order_payment->orderId);

		//If already payment Done
		if ($quotStatus->ord_quotStatusId == 5) {
			return $this->model_response(true, 200, array(), 'Already Payment Made for this Quote');
		} elseif ($quotStatus->ord_quotStatusId == 3) {
			$this->db->insert($this->tbl_order_payment, $this->build_model_data($order_payment, $this->prfx_order_payments));
			$payment_id = $this->db->insert_id();
			
			// $status = new stdClass();
			// $status->statusId = 5;
			// $this->quote_model->update_status($status, $order_payment->orderId);
			return $this->model_response(true, 200, array("paymentId" => $payment_id), 'Txn Details Updated.');
		} elseif ($quotStatus->ord_quotStatusId == 6) {
			return $this->model_response(true, 200, array(), "You can't process For This Quote");
		}
	}
}