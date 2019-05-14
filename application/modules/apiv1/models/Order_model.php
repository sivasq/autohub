<?php
require_once APPPATH . 'core/Generic_model.php';

class Order_model extends Generic_model
{
	const TBL_ORDER_PAYMENT = 'order_payment';
	const TBL_ORDER_SHIPPING = 'order_shipping';
	const TBL_ORDER_ADDRESS = 'shipping_addresses';
	const SHA = 'sha_';
	var $table = 'orders';
	var $cart_table = 'shopping_cart';
	var $table_order_detail = 'order_details';
	var $table_order_status = 'order_status';
	var $table_shipping_methods = 'shipping_methods';
	var $table_vehicles = 'vehicles';
	var $table_products = 'products';
	var $table_product_type = 'product_types';
	var $table_product_categories = 'product_categories';
	var $tbl_product_condition = 'product_conditions';
	var $tbl_shipping_address = 'shipping_addresses';
	var $tbl_order_shipping = "order_shippings";
	var $tbl_order_message = "order_messages";
	var $tbl_order_payment = "order_payments";
	var $tbl_shipping_method = "shipping_methods";
	var $tbl_users = 'users';
	var $prefix = 'ord_';
	var $prfx_order_details = "ode_";
	var $ordItemsprefix = 'ode_';
	var $prfx_order_shipping = "osh_";
	var $prfx_order_messages = "orm_";

	public function __construct()
	{
		parent::__construct($this->table, $this->prefix);
		$this->load->model('apiv1/Product_model');
		$this->load->model('apiv1/Shippingmethod_model');
		$this->load->model('apiv1/User_model');
		$this->load->model('apiv1/Productcondition_model');
		$this->load->model('apiv1/Vehicle_model');
	}

	public function create($httpRequest)
	{
		$inputData = $httpRequest;
		$shoppingCartExtraElements = $inputData->cartItems;

		$finalShoppingCartExtraElements = array();
		foreach ($shoppingCartExtraElements as $row) {
			$element_array = array();

			if (!array_key_exists("price", $row)) {
				$element_array['price'] = 0;
			}

			if (!array_key_exists("discount", $row)) {
				$element_array['discount'] = 0;
			}

			if (!array_key_exists("total", $row)) {
				$element_array['total'] = 0;
			}

			foreach ($row as $key => $val) {
				$element_array[$key] = $val;
			}

			array_push($finalShoppingCartExtraElements, (object)$element_array);
		}

		// $sum = array_sum(array_map(function($item) {
		// 	return $item->price * $item->quantity - $item->discount;
		// }, $finalQuoteCartExtraElements));

		/* Cart Ids Array */
		$cart_ids = array_column($finalShoppingCartExtraElements, 'id');

		/* Generate Data from cart table */
		$cartItems = $this->DuplicateMySQLRecord($this->cart_table, 'crt_id', $cart_ids, array("crt_id", "crt_userId", "crt_cartType"), $finalShoppingCartExtraElements);

		if (!count($cartItems) > 0)
			return $this->model_response(false, 500, array(), "No Cart Items Found");

		unset($inputData->cartItems);

		/* Sum Item Price */
		$itemTotal = array_sum(array_column($cartItems, 'total'));
		$shippingTotal = $inputData->shippingTotal;
		$grandTotal = $shippingTotal + array_sum(array_column($cartItems, 'total'));

		/* Create Quote Data */
		$CartData = $this->build_model_data($inputData, $this->prefix, array("statusId" => 4, "isOrder" => 1, "itemTotal" => $itemTotal, "shippingTotal" => $shippingTotal, "grandTotal" => $grandTotal, "CreatedAt" => date('Y-m-d H:i:s'), "CreatedBy" => NULL));

		/* Insert Quote data */
		$this->db->insert($this->table, $CartData);
		$orderId = $this->db->insert_id();
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating Quote");
		}

		/* Update Order Number */
		$this->update(array('ord_orderId' => $this->generate_order_number($orderId)), $orderId);

		/* Create quote Items data */
		$orderItemsData = $this->build_model_array($cartItems, $this->prfx_order_details, array("orderId" => $orderId, "createdDate" => date('Y-m-d H:i:s'), "createdBy" => NULL));

		/* insert Quote Items data */
		$this->db->insert_batch($this->table_order_detail, (array)$orderItemsData);
		if (!empty($db_error)) {
			/* Delete Quote if error in create quote items */
			$this->db->delete($orderId);
			return $this->model_response(false, 500, array(), "Error on creating Quote Items");
		}
		$this->delete_inner($cart_ids, $this->cart_table, 'crt_id');

		return $this->model_response(true, 202, array("quoteId" => $orderId), "Order Created Successfully");
	}

	private function DuplicateMySQLRecord($source_table, $where_key_field, $where_key_val, $del_element_from_source, $extra_elements = null)
	{
		/* generate the select query for get quote req items from db */
		$this->db->where_in($where_key_field, $where_key_val);
		$copiedItems = $this->db->get($source_table)->result();

		if (!count($copiedItems) > 0)
			return $this->build_response_array($copiedItems);;

		$finalItems_array = array();
		foreach ($copiedItems as $row) {
			$element_array = array();
			foreach ($row as $key => $val) {
				if (!in_array($key, $del_element_from_source)) {
					$element_array[$key] = $val;
				}
			}

			if ($extra_elements != null) {
				$extraElement = $this->getArrayFiltered('id', $row->crt_id, $extra_elements);
				foreach ($extraElement[0] as $key => $val) {
					if (!in_array($key, array("id"))) {
						$element_array[$key] = $val;
					}
				}
			}
			array_push($finalItems_array, $element_array);
		}

		return $this->build_response_array($finalItems_array);
	}

	public function generate_order_number($orderId)
	{
		$order_number = "OC-" . substr(date("Y"), -2) . "-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
		return $order_number;
	}

	public function get_orders_by_userId($user_id)
	{
		$this->db->select($this->select_fields_for_order_list() . ", ost_name as status, concat(first_name, ' ', last_name) as userName, orp_status as orp_paymentStatus, orp_txnId");
		$this->db->from($this->table);
		$this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where(array("ord_userId" => $user_id, "ord_isOrder" => 1));
		$this->db->order_by('ord_createdAt');
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("createdAt"));
		return $this->model_response(true, 200, array("orders" => $response_data));
	}

	public function select_fields_for_order_list()
	{
		return $this->prefix . "id as orderId, " .
			$this->prefix . "orderId as orderNumber, " .
			$this->prefix . "userId, " .
			$this->prefix . "statusId, " .
			$this->prefix . "shippingAddressId, " .
			$this->prefix . "shippingMethodId, " .
			$this->prefix . "itemTotal, " .
			$this->prefix . "shippingTotal, " .
			$this->prefix . "grandTotal, " .
			$this->prefix . "discountAmount, " .
			$this->prefix . "discountPercent, " .
			$this->prefix . "createdAt, " .
			$this->prefix . "createdBy";
	}

	public function get_order_by_id($orderId)
	{
		$this->db->select($this->select_fields_for_order_list() . "," . $this->Shippingmethod_model->select_fields_for_quot_list() . "," . $this->User_model->select_fields() . ", " . $this->select_ode_fields_for_order_list() . ", " . $this->Productcondition_model->get_product_condition_fields_for_quot_list() . ", ost_name as ost_orderStatus, prd_name as itemName, " . $this->Vehicle_model->select_vehicle_fields_for_quot_list() . ", orp_status as orp_paymentStatus, orp_txnId");
		$this->db->from($this->table);
		$this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
		$this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
		$this->db->join($this->table_products, "ode_productId = prd_id", "left");
		$this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		$this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		$this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
		$this->db->join($this->tbl_shipping_method, "shm_id = ord_shippingMethodId", "left");
		$this->db->join($this->table_product_type, "pty_id = prd_typeId", "left");
		$this->db->join($this->table_product_categories, "pca_id = prd_categoryId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where(array("ord_id" => $orderId, "ord_isOrder" => 1));
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category");

		//Mapping order items
		$response_data = $this->map_response($response_data, array("orderItems" => array("itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")), true);

		return $this->model_response(true, 200, $response_data);

	}

	public function select_ode_fields_for_order_list()
	{
		return $this->prfx_order_details . "id as itemId," .
			$this->prfx_order_details . "price as itemPrice, " .
			$this->prfx_order_details . "comment, " .
			$this->prfx_order_details . "currentMileage, " .
			$this->prfx_order_details . "vehicleId";
	}

	public function get_orders()
	{
		$this->db->select($this->table . ".*,ost_name as status,concat(first_name, ' ', last_name) as userName");
		$this->db->from($this->table);
		$this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->order_by('ord_createdAt');
//        $this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
//        $this->db->join($this->table_products, "ode_productId = prd_id", "left");
//        $this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
//        $this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
//        $this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId");
		$this->db->where('ord_isOrder', 1);
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("createdAt"));

		//Mapping order items
		// $response_data = $this->map_response($response_data, array("orderItems"=>array("itemName","itemPrice","itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin","vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")),true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $this->model_response(true, 200, $response_data);
	}

	public function get_order_details_by_id($orderId)
	{
		return $this->model_response(true, 200, $this->get_order_items_by_id($orderId)['orderItems']);
	}

	public function get_order_items_by_id($orderId)
	{
		$this->db->select("concat(first_name, ' ', last_name) as userName, ord_id, ord_quoteId, ord_orderId, ord_statusId, ord_isQuote, ord_isOrder, ord_shippingAddressId as shippingAddressId, concat(sha_firstName, ' ', sha_lastName) as shippingUser, concat(sha_addressLine1, ' ', sha_addressLine2,' ', sha_city,' ', sha_state,' ', sha_country) as shippingAddress, sha_city, sha_state, sha_country, sha_postCode, sha_phone, sha_email, ord_shippingMethodId as shippingMethodId, shm_name as shippingMethod, ord_shippingTotal as shippingCost, ode_id as itemId, ode_productConditionId as itemConditionId, pco_name as itemConditionName, ost_name as ost_orderStatus, prd_name as ord_itemName, ode_id as orderDetailsId, prd_name as ord_itemName, ode_price as itemPrice, ode_vehicleId, concat(vhl_make,' ',vhl_model,' ',vhl_year) as vehicleInfo,vhl_vin as vehicleVin, vhl_make as vehicleMake, vhl_model as vehicleModel, vhl_year as vehicleYear, vhl_image as vehicleImage,  ode_comment, ode_currentMileage,  shm_name as shippingMethod, shm_price as shippingCost, pty_name as productType, pca_name as productCategory, orp_status as orp_paymentStatus, orp_txnId, orp_createdAt as txnDate");
		$this->db->from($this->table);
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
		$this->db->join($this->table_order_detail, "ord_id = ode_orderId");
		$this->db->join($this->table_products, "ode_productId = prd_id", "left");
		$this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		$this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		$this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
		$this->db->join($this->table_shipping_methods, "shm_id = ord_shippingMethodId", "left");
		$this->db->join($this->table_product_type, "pty_id = prd_typeId", "left");
		$this->db->join($this->table_product_categories, "pca_id = prd_categoryId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where('ode_orderId', $orderId);
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category", array('txnDate'));

		//Mapping order items
		$response_data = $this->map_response($response_data, array("orderItems" => array("itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage", "productType", "productCategory", "vehicleInfo", "orderDetailsId")), true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $response_data;
	}

	public function update_status($request, $orderId)
	{
		$statusData = array(
			'ord_statusId' => $this->validate_input($request, "statusId")
		);

		if (isset($statusData)) {
			$this->db->where("ord_id", $orderId);
			$this->db->update($this->table, $statusData);
			return $this->model_response(true, 200, array(), 'Status Updated');
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function update_payment_status($httpRequest, $orderId)
	{
		$statusData = array(
			'orp_status' => $this->validate_input($httpRequest, "orp_status")
		);
		if (isset($statusData)) {
			$this->db->where("orp_orderId", $orderId);
			$this->db->update($this->tbl_order_payment, $statusData);

			$updateData = new stdClass();
			$updateData->statusId = 1;

			return $this->Order_model->update_status($updateData, $orderId);
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function insert_courier_details($courierDetails)
	{
		//$shippingData = $this->create_model($courierDetails, self::SHA);
		$this->db->insert($this->tbl_order_shipping, $courierDetails);

		return $this->model_response(true, 200, array("shippingId" => $this->db->insert_id()));
	}

	public function list_shipping_methods()
	{
		$this->db->from($this->table_shipping_methods);
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);

	}

	public function create_order_message($message_data)
	{
		$this->db->insert($this->tbl_order_message, $this->build_model_data($message_data, $this->prfx_order_messages));
		$message_id = $this->db->insert_id();
		return $this->model_response(true, 202, array("messageId" => $message_id));
	}

	public function get_order_messages($order_id)
	{
		$this->db->where($this->prfx_order_messages . "orderId", $order_id);
		$this->db->order_by($this->prfx_order_messages . "createdAt", "asc");
		$result_array = $this->db->get($this->tbl_order_message)->result_array();
		$response_data = $this->build_response_array($result_array, null, array("createdAt"));
		return $this->model_response(true, 200, $response_data);
	}

	public function get_order_status()
	{
		$this->db->select("ost_name, ost_order");
		$this->db->from($this->table_order_status);
		$result = $this->db->get()->result_array();
		$response_data = $this->camelize_array_data($result);
		return $response_data;
	}

	public function get_order_status_by_order_id($orderId)
	{
		$this->db->select('ord_statusId');
		$this->db->from($this->table);
		$this->db->where($this->prefix . "id", $orderId);
		return $this->db->get()->row();
	}


	/**
	 * @param $shippingAddress
	 * @return mixed
	 */
	public function create_shipping_address($shippingAddress)
	{
		$shippingAddressData = $this->create_model($shippingAddress, self::SHA);
		print_r($shippingAddressData);
		die();
		$this->db->insert($this->table_ADDRESS, $shippingAddressData);

		return $this->model_response(true, 200, array("shippingAddressId" => $this->db->insert_id()));
	}

	public function update_order_items_price($orderItems)
	{
		$total = 0;
		$orderId = $orderItems[0]->orderId;
		$shippingCost = $orderItems[0]->shippingCost;
		foreach ($orderItems as $items) {
			$total += $items->ode_price;
			unset($items->orderId);
			unset($items->shippingCost);
		}
		$grandTotal = $total + $shippingCost;
		$this->update(array("ord_itemTotal" => $total, "ord_shippingTotal" => $shippingCost, "ord_grandTotal" => $grandTotal), $orderId);
		$response_data = $this->db->update_batch($this->table_order_detail, $orderItems, 'ode_id');
		return $this->model_response(true, 200, $response_data);

	}

	public function create_old($data)
	{
		$orderItems = $data->orderItems;
		unset($data->orderItems);
		$data->statusId = 1;
		$orderData = $this->build_model_data($data, $this->prefix);

		$this->db->insert($this->table, $orderData);
		$orderId = $this->db->insert_id();
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating order");
		}

		$orderItemsData = $this->build_model_array($orderItems, $this->prfx_order_details, array("orderId" => $orderId));
		$this->db->insert_batch($this->table_order_detail, (array)$orderItemsData);
		if (!empty($db_error)) {

			$this->db->delete($orderId);
			return $this->model_response(false, 500, array(), "Error on creating order");
		}

		return $this->model_response(true, 202, array("orderId" => $orderId));
	}

	public function update_order($data, $order_id)
	{
		$orderItems = $data->orderItems;
		$orderShipping = $data->orderShipping;
		unset($data->orderItems);
		unset($data->orderShipping);
		if ($data->statusId == 2) {
			$data->orderId = $this->generate_order_number($order_id);
		}
		// var_dump($data); die;
		$data->grandTotal = $data->itemTotal;
		$orderData = $this->build_model_data($data, $this->prefix);
		$this->db->trans_begin();

		$this->db->where($this->prefix . "id", $order_id);
		$update_status = $this->db->update($this->table, $orderData);
		if (!$update_status) {
			return $this->model_response(false, 500, array(), "Error on Updating order");
		}

		$orderItemsData = $this->build_model_array($orderItems, $this->prfx_order_details, array("orderId" => $order_id));

		// echo json_encode($orderItemsData); die;
		$this->db->update_batch($this->table_order_detail, $orderItemsData, $this->prfx_order_details . "id");
		if ($this->db->trans_status() === FALSE) {

			$this->db->trans_rollback();
			return $this->model_response(false, 500, array(), "Error on creating order");
		}
		$this->db->trans_commit();


		//Update order shipping
		$orderShippingData = $this->build_model_data($orderShipping, $this->prfx_order_shipping, array("orderId" => $order_id));
		// echo json_encode($orderShippingData);die;
		$this->db->where($this->prfx_order_shipping . 'orderId', $order_id);
		$q = $this->db->get($this->tbl_order_shipping);
		$this->db->reset_query();
		if ($q->num_rows() > 0)
			$this->db->where($this->prfx_order_shipping . 'orderId', $order_id)->update($this->tbl_order_shipping, $orderShippingData);
		else
			$this->db->insert($this->tbl_order_shipping, $orderShippingData);

		return $this->model_response(true, 200);

	}
}