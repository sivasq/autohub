<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuotReq extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Quotreq_model');
	}


	public function add_item_post()
	{
		$user_id = $this->get_path_variable('user-id');
		$quotreq_model_data = $this->Quotreq_model->build_generic_model_array($this->httpRequest, array("userId" => $user_id, "cartType" => "quotreq"));
		$this->response($this->Quotreq_model->insert_batch($quotreq_model_data, '', 'Request sent for Quotation'));
		//Get the cartItem list
		//$this->response($this->Quotreq_model->list_by_userId($user_id, 'Quotation Request Success'));
	}

	public function list_items_get()
	{
		$userId = $this->get_path_variable('user-id');
		$this->response($this->Quotreq_model->list_by_userId($userId));
	}

	public function get_reqs_get()
	{
		$this->response($this->Quotreq_model->list_quote_reqs());
	}

	public function delete_items_post()
	{
		$userId = $this->get_path_variable('user-id');
		$this->Quotreq_model->delete($this->httpRequest->quotReqIds);

		//Get the cartItem list
		$this->response($this->Quotreq_model->list_by_userId($userId, 'Quotation Request Deleted'));
	}

	public function delete_delete()
	{
		$quotReqId = $this->get_path_variable('quotreq-id');
		$this->response($this->Quotreq_model->delete($quotReqId));
	}
}