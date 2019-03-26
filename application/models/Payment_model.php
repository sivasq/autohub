<?php
/**
 * Created by PhpStorm.
 * User: enginef
 * Date: 3/2/19
 * Time: 7:46 PM
 */
require APPPATH . 'core/Generic_model.php';

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
		return $this->model_response(true, 200, $response_data);
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
		$this->db->insert($this->tbl_order_payment, $this->build_model_data($order_payment, $this->prfx_order_payments));
		$payment_id = $this->db->insert_id();
		return $this->model_response(true, 200, array("paymentId" => $payment_id));
	}
}