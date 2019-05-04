<?php
require_once APPPATH . 'core/Generic_model.php';

class Cart_model extends Generic_model
{
	var $table = 'shopping_cart';
	var $prfx = 'crt_';

	public function __construct()
	{
		parent::__construct($this->table, $this->prfx);
		$this->load->model(array('apiv1/Product_model'));
		$this->load->model(array( 'apiv1/Vehicle_model'));
		$this->load->model(array( 'apiv1/Productcondition_model'));
	}

	public function list_by_userId($user_id, $message = NULL)
	{
		$this->db->select($this->prfx . "id as " . $this->prfx . "cartId, " . $this->prfx . "userId, " . $this->prfx . "currentMileage, " . $this->prfx . "comment, " . $this->prfx . "quantity, " . $this->Product_model->get_product_select_items());
		$this->db->from($this->table);
		$this->Product_model->get_product_joins($this->db, $this->prfx . "productId");
//		$this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx . "vehicleId");
		$this->Productcondition_model->get_join($this->db, $this->prfx . "productConditionId");
		$this->db->where($this->prfx . "userId = " . $user_id);
		$this->db->where($this->prfx . "cartType = 'shopping'");
		return $this->model_response(true, 200, array('cartItems' =>$this->build_response_array($this->db->get()->result_array())), $message);
	}



	//Deprecated
	/**
	 * @param $user_id
	 * @param null $message
	 * @return array
	 *
	 */
	public function list_by_userId_old($user_id, $message = NULL)
	{
		$this->db->select($this->prfx . "id as " . $this->prfx . "cartId, " . $this->prfx . "userId, " . $this->prfx . "currentMileage, " . $this->prfx . "comment, " . $this->Product_model->get_product_select_items() . "," . $this->Vehicle_model->get_vehicle_select_items() . "," . $this->Productcondition_model->get_product_condition_select_items());
		$this->db->from($this->table);
		$this->Product_model->get_product_joins($this->db, $this->prfx . "productId");
		$this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx . "vehicleId");
		$this->Productcondition_model->get_join($this->db, $this->prfx . "productConditionId");
		$this->db->where($this->prfx . "userId = " . $user_id);
		$this->db->where($this->prfx . "cartType = 'shopping'");
		return $this->model_response(true, 200, array('cartItems' =>$this->build_response_array($this->db->get()->result_array())), $message);
	}
}