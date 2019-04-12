<?php
require_once APPPATH . 'core/Generic_model.php';

class Quote_model extends Generic_model
{
	const TBL_ORDER_ADDRESS = 'shipping_addresses';
	const SHA = 'sha_';
	var $table = 'orders';
	var $cart_table = 'shopping_cart';
	var $table_order_detail = 'order_details';
	//	const TBL_ORDER_PAYMENT = 'order_payment';
	//	const TBL_ORDER_SHIPPING = 'order_shipping';
	var $table_order_status = 'order_status';
	var $table_quote_status = 'quote_status';
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
		$quoteCartExtraElements = $inputData->quoteItems;

		$finalQuoteCartExtraElements = array();
		foreach ($quoteCartExtraElements as $row) {
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

			array_push($finalQuoteCartExtraElements, (object)$element_array);
		}

		// $sum = array_sum(array_map(function($item) {
		// 	return $item->price * $item->quantity - $item->discount;
		// }, $finalQuoteCartExtraElements));

		/* Cart Ids Array */
		$cart_ids = array_column($finalQuoteCartExtraElements, 'id');

		/* Generate Data from cart table */
		$quoteItems = $this->DuplicateMySQLRecord($this->cart_table, 'crt_id', $cart_ids, array("crt_id", "crt_userId", "crt_cartType"), $finalQuoteCartExtraElements);

		if (!count($quoteItems) > 0)
			return $this->model_response(false, 500, array(), "No Request Items Found");

		unset($inputData->quoteItems);

		/* Sum Item Price */
		$itemTotal = array_sum(array_column($quoteItems, 'total'));
		$shippingTotal = 0;
		$grandTotal = $shippingTotal + array_sum(array_column($quoteItems, 'total'));

		/* Create Quote Data */
		$QuotData = $this->build_model_data($inputData, $this->prefix, array("quotStatusId" => 1, "isQuote" => 1, "itemTotal" => $itemTotal, "shippingTotal" => $shippingTotal, "grandTotal" => $grandTotal, "quotCreatedAt" => date('Y-m-d H:i:s'), "quotCreatedBy" => NULL));

		/* Insert Quote data */
		$this->db->insert($this->table, $QuotData);
		$quoteId = $this->db->insert_id();
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating Quote");
		}

		/* Update Quote Number */
		$this->update(array('ord_quoteId' => $this->generate_quote_number($quoteId)), $quoteId);

		/* Create quote Items data */
		$quoteItemsData = $this->build_model_array($quoteItems, $this->prfx_order_details, array("orderId" => $quoteId, "createdDate" => date('Y-m-d H:i:s'), "createdBy" => NULL));

		/* insert Quote Items data */
		$this->db->insert_batch($this->table_order_detail, (array)$quoteItemsData);
		if (!empty($db_error)) {
			/* Delete Quote if error in create quote items */
			$this->db->delete($quoteId);
			return $this->model_response(false, 500, array(), "Error on creating Quote Items");
		}
		$this->delete_inner($cart_ids, $this->cart_table, 'crt_id');

		return $this->model_response(true, 202, array("quoteId" => $quoteId), "Quotation Created Successfully");
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

	private function generate_quote_number($quoteId)
	{
		$quote_number = "QT-" . substr(date("Y"), -2) . "-" . str_pad($quoteId, 6, '0', STR_PAD_LEFT);
		return $quote_number;
	}

	public function get_quotes_by_userId($user_id)
	{
		$this->db->select($this->select_fields_for_quot_list() . ", qst_name as quotStatus, concat(first_name, ' ', last_name) as userName, orp_status as orp_paymentStatus, orp_txnId");
		$this->db->from($this->table);
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where(array("ord_userId" => $user_id, "ord_isQuote" => 1));
		$this->db->order_by('ord_createdAt', 'DESC');
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("createdAt"));
		return $this->model_response(true, 200, array("quotes" => $response_data));
	}

	public function select_fields_for_quot_list()
	{
		return $this->prefix . "id as quoteId, " .
			$this->prefix . "quoteId as quoteNumber, " .
			$this->prefix . "userId, " .
			$this->prefix . "quotStatusId, " .
			$this->prefix . "shippingAddressId, " .
			$this->prefix . "shippingMethodId, " .
			$this->prefix . "itemTotal, " .
			$this->prefix . "shippingTotal, " .
			$this->prefix . "grandTotal, " .
			$this->prefix . "discountAmount, " .
			$this->prefix . "discountPercent, " .
			$this->prefix . "quotCreatedAt as createdAt, " .
			$this->prefix . "quotCreatedBy as createdBy";
	}

	public function get_quote_by_id($quoteId)
	{
		$this->db->select($this->select_fields_for_quot_list() . "," . $this->Shippingmethod_model->select_fields_for_quot_list() . "," . $this->User_model->select_fields() . ", " . $this->select_ode_fields_for_quot_list() . ", " . $this->Productcondition_model->get_product_condition_fields_for_quot_list() . ", qst_name as qst_quotStatus, prd_name as itemName, " . $this->Vehicle_model->select_vehicle_fields_for_quot_list() . ", orp_status as orp_paymentStatus, orp_txnId");
		$this->db->from($this->table);
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
		$this->db->join($this->table_products, "ode_productId = prd_id", "left");
		$this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		$this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		$this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
		$this->db->join($this->tbl_shipping_method, "shm_id = ord_shippingMethodId", "left");
		$this->db->join($this->table_product_type, "pty_id = prd_typeId", "left");
		$this->db->join($this->table_product_categories, "pca_id = prd_categoryId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where(array("ord_id" => $quoteId, "ord_isQuote" => 1));
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category");

		//Mapping order items
		$response_data = $this->map_response($response_data, array("quoteItems" => array("itemId", "itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")), true);

		return $this->model_response(true, 200, $response_data);
	}

	public function select_ode_fields_for_quot_list()
	{
		return $this->prfx_order_details . "id as itemId," .
			$this->prfx_order_details . "price as itemPrice, " .
			$this->prfx_order_details . "comment, " .
			$this->prfx_order_details . "currentMileage, " .
			$this->prfx_order_details . "vehicleId";
	}

	public function add_item($httpRequest)
	{
		$inputData = $httpRequest;
		$quoteItemExtraElements = $inputData->quoteItems;

		/* Cart Ids Array */
		$cart_ids = array();
		foreach ($quoteItemExtraElements as $item) {
			array_push($cart_ids, $item->id);
		}

		$itemTotal = array_sum(array_column($quoteItemExtraElements, 'total'));

		/* Generate Data from cart table */
		$quoteItems = $this->DuplicateMySQLRecord($this->cart_table, 'crt_id', $cart_ids, array("crt_id", "crt_userId", "crt_cartType"), $quoteItemExtraElements);

		if (!count($quoteItems) > 0)
			return $this->model_response(false, 500, array(), "No Request Items Found");

		unset($inputData->quoteReqItems);

		/* Create quote Items data */
		$quoteItemsData = $this->build_model_array($quoteItems, $this->prfx_order_details, array("orderId" => $inputData->quoteId, "createdDate" => date('Y-m-d H:i:s'), "createdBy" => NULL));

		/* insert Quote Items data */
		$this->db->insert_batch($this->table_order_detail, (array)$quoteItemsData);
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating Quote Items");
		}

		/* Update Price In Quote */
		$this->db->where('ord_id', $inputData->quoteId);
		$this->db->set('ord_itemTotal', 'ord_itemTotal+' . $itemTotal, FALSE);
		$this->db->set('ord_grandTotal', 'ord_grandTotal+' . $itemTotal, FALSE);
		$this->db->update($this->table);

		/* Delete item from quot req, once item was added to quote */
		$this->delete_inner($cart_ids, $this->cart_table, 'crt_id');

		return $this->model_response(true, 202, array("quoteId" => $inputData->quoteId), 'Item successfully added to Quotation');
	}

	public function remove_item($httpRequest)
	{
		$inputData = $httpRequest;

		/* Quote Item Id */
		$quoteItemId = array($inputData->quoteItemId);

		/* Generate Data from cart table */
		$cartItems = $this->DuplicateMySQLRecord($this->table_order_detail, 'ode_id', $quoteItemId, array("ode_id", "ode_orderId", "ode_price", "ode_statusId", "ode_discount", "ode_createdDate", "ode_createdBy", "ode_updatedDate", "ode_updatedBy"));

		if (!count($cartItems) > 0)
			return $this->model_response(false, 500, array(), "No Quote Items Found");

		/* Get Deleted Items Price */
		$itemTotal = array_sum(array_column($cartItems, 'total'));
		unset($cartItems[0]['total']);

		/* Create cart Items data */
		$cartItemsData = $this->build_model_data($cartItems[0], 'crt_', array("userId" => $inputData->userId, "cartType" => 'quotreq', 'createdAt' => date('Y-m-d H:i:s')));

		/* insert item into cart */
		$this->db->insert($this->cart_table, $cartItemsData);
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating Cart Items");
		}

		/* Delete Item From Quote */
		$this->delete($inputData->quoteItemId, $this->table_order_detail, 'ode_id');

		/* Update Price In Quote */
		$this->db->where('ord_id', $inputData->quoteId);
		$this->db->set('ord_itemTotal', 'ord_itemTotal-' . $itemTotal, FALSE);
		$this->db->set('ord_grandTotal', 'ord_grandTotal- ' . $itemTotal, FALSE);
		$this->db->update($this->table);

		return $this->model_response(true, 202, array(), 'Product removed from Quote');
	}

	public function update_quote_price($httpRequest)
	{
		/* Build Item Ids Array */
		$itemIds = array_column($httpRequest->quoteItems, 'id');

		$itemNewTotal = array_sum(array_column($httpRequest->quoteItems, 'total'));

		/* Select Items */
		$items = $this->get_quot_item_by_ids($itemIds);

		/* Build ItemsTotal */
		$itemPreviousTotal = array_sum(array_column($items, 'ode_total'));

		/* build New price array */
		$quoteItems = $this->build_model_array($httpRequest->quoteItems, $this->prfx_order_details);

		/* Update Price for item*/
		$this->db->update_batch($this->table_order_detail, $quoteItems, 'ode_id');

		/* Update Price In Quote */
		$this->db->where('ord_id', $httpRequest->quoteId);
		$this->db->set('ord_itemTotal', 'ord_itemTotal -' . $itemPreviousTotal . '+' . $itemNewTotal, FALSE);
		$this->db->set('ord_grandTotal', 'ord_grandTotal -' . $itemPreviousTotal . '+' . $itemNewTotal, FALSE);
		$this->db->update($this->table);

		return $this->model_response(true, 200, array(), 'Price Updated');
	}

	public function update_status($httpRequest, $quoteId)
	{
		$statusData = array(
			'ord_quotStatusId' => $this->validate_input($httpRequest, "statusId")
		);
		if (isset($statusData)) {
			$this->db->where("ord_id", $quoteId);
			$this->db->update($this->table, $statusData);
			return $this->model_response(true, 200, array(), 'Status Updated');
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function update_payment_status($httpRequest, $quoteId)
	{
		$statusData = array(
			'orp_status' => $this->validate_input($httpRequest, "orp_status")
		);
		if (isset($statusData)) {
			$this->db->where("orp_orderId", $quoteId);
			$this->db->update($this->tbl_order_payment, $statusData);

			$updateData = new stdClass();
			$updateData->statusId = 5;

			return $this->Quote_model->update_status($updateData, $quoteId);
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function update_quote_shipping($httpRequest, $quoteId)
	{
		$shippingData = array(
			'ord_shippingAddressId' => $this->validate_input($httpRequest, "shippingAddressId"),
			'ord_shippingMethodId' => $this->validate_input($httpRequest, "shippingMethodId"),
			'ord_shippingTotal' => $this->validate_input($httpRequest, "shippingTotal")
		);
		if (isset($shippingData)) {
			$this->db->where("ord_id", $quoteId);
			$this->db->update($this->table, $shippingData);

			$this->db->where('ord_id', $quoteId);
			$this->db->set('ord_grandTotal', 'ord_itemTotal + ord_shippingTotal', FALSE);
			$this->db->update($this->table);

			return $this->model_response(true, 200, $this->db->last_query(), 'Quote Updated');
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function convert_to_order($quoteId)
	{
		$this->update(array('ord_orderId' => $this->generate_order_number($quoteId), "ord_statusId" => 1, "ord_isOrder" => 1, "ord_createdAt" => date('Y-m-d H:i:s'), "ord_createdBy" => NULL), $quoteId);

		return $this->model_response(true, 200, array(), 'Quote Converted To Order');
	}

	public function generate_order_number($orderId)
	{
		$order_number = "OC-" . substr(date("Y"), -2) . "-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
		return $order_number;
	}

	//Admin Panel
	public function get_quotes()
	{
		$this->db->select($this->table . ".*,qst_name as status, concat(first_name, ' ', last_name) as userName");
		$this->db->from($this->table);
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->order_by('ord_quotCreatedAt');
		//        $this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
		//        $this->db->join($this->table_products, "ode_productId = prd_id", "left");
		//        $this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		//        $this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		//        $this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId");
		$this->db->where('ord_isQuote', 1);
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("quotCreatedAt"));

		//Mapping order items
		// $response_data = $this->map_response($response_data, array("orderItems"=>array("itemName","itemPrice","itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin","vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")),true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $this->model_response(true, 200, $response_data);
	}

	public function get_quote_items_by_id($quoteId)
	{
		$this->db->select("concat(first_name, ' ', last_name) as userName, ord_id, ord_quoteId, ord_orderId, ord_quotStatusId, ord_isQuote, ord_isOrder, ord_shippingAddressId as shippingAddressId, concat(sha_firstName, ' ', sha_lastName) as shippingUser, concat(sha_addressLine1, ', ', sha_addressLine2,', ', sha_city,', ', sha_state,', ', sha_country) as shippingAddress, sha_city, sha_state, sha_country, sha_postCode, sha_phone, sha_email, ord_shippingMethodId as shippingMethodId, shm_name as shippingMethod, ord_shippingTotal as shippingCost, ord_quotStatusId, qst_name as quoteStatus, ode_id as itemId, ode_productConditionId as itemConditionId, pco_name as itemConditionName, ode_productId, prd_name as ord_itemName, ode_price as itemPrice, ode_discount as itemDiscount, ode_total as itemTotal, ode_comment, ode_currentMileage, ode_vehicleId, concat(vhl_make,' ',vhl_model,' ',vhl_year) as vehicleInfo, vhl_vin as vehicleVin, vhl_make as vehicleMake, vhl_model as vehicleModel, vhl_year as vehicleYear, vhl_image as vehicleImage, pty_name as productType, pca_name as productCategory, orp_status as orp_paymentStatus, orp_txnId, orp_createdAt as txnDate");
		$this->db->from($this->table);
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->table_order_detail, "ord_id = ode_orderId");
		$this->db->join($this->table_products, "ode_productId = prd_id", "left");
		$this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		$this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		$this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
		$this->db->join($this->table_shipping_methods, "shm_id = ord_shippingMethodId", "left");
		$this->db->join($this->table_product_type, "pty_id = prd_typeId", "left");
		$this->db->join($this->table_product_categories, "pca_id = prd_categoryId", "left");
		$this->db->join($this->tbl_order_payment, "orp_orderId = ord_id", "left");
		$this->db->where('ode_orderId', $quoteId);
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category", array('txnDate'));

		//Mapping order items
		$response_data = $this->map_response($response_data, array("orderItems" => array("itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage", "productType", "productCategory", "vehicleInfo", "itemId")), true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $response_data;
	}

	public function update_order_items_price($orderItems)
	{
		$quotStatus = $this->get_quote_status_by_quot_id($orderItems[0]->orderId);

		if ($quotStatus->ord_quotStatusId == 1 or $quotStatus->ord_quotStatusId == 2) {
			$total = 0;
			$orderId = $orderItems[0]->orderId;
			foreach ($orderItems as $items) {
				$total += $items->ode_price;
				unset($items->orderId);
			}
			$grandTotal = $total;
			$this->update(array("ord_quotStatusId" => 2, "ord_itemTotal" => $total, "ord_grandTotal" => $grandTotal), $orderId);
			$response_data = $this->db->update_batch($this->table_order_detail, $orderItems, 'ode_id');
			return $this->model_response(true, 200, $response_data);
		} else {
			return $this->model_response(false, 200, array());
		}
	}

	public function get_quote_status_by_quot_id($quoteId)
	{
		$this->db->select('ord_quotStatusId');
		$this->db->from($this->table);
		$this->db->where($this->prefix . "id", $quoteId);
		return $this->db->get()->row();
	}

	//	get List of quot status
	public function get_quote_status()
	{
		$this->db->select("qst_name, qst_order");
		$this->db->from($this->table_quote_status);
		$result = $this->db->get()->result_array();
		$response_data = $this->camelize_array_data($result);
		return $response_data;
	}

	public function get_quot_item_by_ids($ids)
	{
		$this->db->from($this->table_order_detail);
		$this->db->where_in($this->prfx_order_details . 'id', $ids);
		return $this->db->get()->result_array();
	}
}
