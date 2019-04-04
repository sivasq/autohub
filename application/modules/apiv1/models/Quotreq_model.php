<?php
require_once APPPATH . 'core/Generic_model.php';

class Quotreq_model extends Generic_model
{
	var $table = 'shopping_cart';
	var $prfx = 'crt_';

	public function __construct()
	{
		parent::__construct($this->table, $this->prfx);
		$this->load->model('apiv1/Product_model');
		$this->load->model('apiv1/Vehicle_model');
		$this->load->model('apiv1/Productcondition_model');
	}

	public function list_by_userId($user_id, $message = NULL)
	{
		$this->db->select($this->prfx . "id as " . $this->prfx . "quotReqId, " . $this->prfx . "userId, " . $this->prfx . "currentMileage, " . $this->prfx . "comment, " . $this->Product_model->get_product_select_items() . "," . $this->Vehicle_model->get_vehicle_select_items() . "," . $this->Productcondition_model->get_product_condition_select_items());
		$this->db->from($this->table);
		$this->Product_model->get_product_joins($this->db, $this->prfx . "productId");
		$this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx . "vehicleId");
		$this->Productcondition_model->get_join($this->db, $this->prfx . "productConditionId");
		$this->db->where($this->prfx . "userId = " . $user_id);
		$this->db->where($this->prfx . "cartType = 'quotreq'");
		$this->db->order_by('crt_createdAt', 'DESC');
		return $this->model_response(true, 200, array('quotReqs' => $this->build_response_array($this->db->get()->result_array())), $message);
	}

	public function list_quote_reqs()
	{
		$this->db->select($this->prfx . "id as " . $this->prfx . "quotReqId," . $this->prfx . "quantity as " . $this->prfx . "quantity,". $this->prfx . "userId, " . $this->prfx . "createdAt,". $this->prfx . "currentMileage, " . $this->prfx . "comment, concat(first_name, ' ', last_name) as userName," . $this->Product_model->get_product_select_items() . "," . $this->Vehicle_model->get_vehicle_select_items() . "," . $this->Productcondition_model->get_product_condition_select_items());
		$this->db->from($this->table);
		$this->Product_model->get_product_joins($this->db, $this->prfx . "productId");
		$this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx . "vehicleId");
		$this->Productcondition_model->get_join($this->db, $this->prfx . "productConditionId");
		$this->db->join("users", "user_id = crt_userId", "left");
		$this->db->order_by('crt_createdAt desc');
		$this->db->where($this->prfx . "cartType = 'quotreq'");
		return $this->model_response(true, 200, $this->build_response_array($this->db->get()->result_array(), NULL, array("createdAt")));
	}

	public function get_quotereq_item_by_id($reqId)
	{
		$this->db->select($this->prfx . "id as " . $this->prfx . "quotReqId," . $this->prfx . "quantity as " . $this->prfx . "quantity,". $this->prfx . "userId, " . $this->prfx . "createdAt,". $this->prfx . "currentMileage, ". $this->prfx . "createdAt, " . $this->prfx . "images as itemImages, " . $this->prfx . "comment, concat(first_name, ' ', last_name) as userName," . $this->Product_model->get_product_select_items() . "," . $this->Vehicle_model->get_vehicle_select_items() . "," . $this->Productcondition_model->get_product_condition_select_items());
		$this->db->from($this->table);
		$this->Product_model->get_product_joins($this->db, $this->prfx . "productId");
		$this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx . "vehicleId");
		$this->Productcondition_model->get_join($this->db, $this->prfx . "productConditionId");
		$this->db->join("users", "user_id = crt_userId", "left");
		$this->db->where(array($this->prfx . "cartType" => 'quotreq', $this->prfx . "id" => $reqId));
		$response_data = $this->build_response($this->db->get()->row(), array("createdAt"));

		return $response_data;
	}
}