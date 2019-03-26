<?php
require_once APPPATH . 'core/Generic_model.php';

class Quote_model extends Generic_model
{
	var $table = 'orders';
	var $cart_table = 'shopping_cart';
	var $table_order_detail = 'order_details';
	var $table_order_status = 'order_status';
	var $table_quote_status = 'quote_status';
//	const TBL_ORDER_PAYMENT = 'order_payment';
//	const TBL_ORDER_SHIPPING = 'order_shipping';
	const TBL_ORDER_ADDRESS = 'shipping_addresses';
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

	const SHA = 'sha_';
	var $prefix = 'ord_';
	var $prfx_order_details = "ode_";
	var $ordItemsprefix = 'ode_';
	var $prfx_order_shipping = "osh_";
	var $prfx_order_messages = "orm_";

	public function __construct()
	{
		parent::__construct($this->table, $this->prefix);
		$this->load->model(array('Product_model', 'Shippingmethod_model', 'User_model', 'Productcondition_model', 'Vehicle_model'));
	}

	function DuplicateMySQLRecord($source_table, $where_key_field, $where_key_val, $del_element_from_source, $extra_elements = null)
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

	public function create()
	{
		$inputData = $this->httpRequest;
		$quoteItemExtraElements = $inputData->quoteItems;

		/* Cart Ids Array */
		$cart_ids = array();
		foreach ($quoteItemExtraElements as $item) {
			array_push($cart_ids, $item->id);
		}

		/* Generate Data from cart table */
		$quoteItems = $this->DuplicateMySQLRecord($this->cart_table, 'crt_id', $cart_ids, array("crt_id", "crt_userId", "crt_cartType"), $quoteItemExtraElements);

		if (!count($quoteItems) > 0)
			return $this->model_response(false, 500, array(), "No Request Items Found");

		unset($inputData->quoteItems);

		/* Sum Item Price */
		$itemTotal = array_sum(array_column($quoteItems, 'total'));
		$grandTotal = 0;

		/* Create Quote Data */
		$QuotData = $this->build_model_data($inputData, $this->prefix, array("quotStatusId" => 1, "isQuote" => 1, "itemTotal" => $itemTotal, "grandTotal" => $grandTotal, "quotCreatedAt" => date('Y-m-d H:i:s'), "quotCreatedBy" => NULL));

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

	public function get_quotes_by_userId($user_id)
	{
		$this->db->select($this->select_fields_for_quot_list() . ", qst_name as quotStatus, concat(first_name, ' ', last_name) as userName");
		$this->db->from($this->table);
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->tbl_users, "user_id = ord_userId", "left");
		$this->db->where(array("ord_userId" => $user_id, "ord_isQuote" => 1));
		$this->db->order_by('ord_quotCreatedAt');
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("createdAt"));
		return $this->model_response(true, 200, array("quotes" => $response_data));
	}

	public function get_quote_by_id($quoteId)
	{
		$this->db->select($this->select_fields_for_quot_list() . "," . $this->Shippingmethod_model->select_fields_for_quot_list() . "," . $this->User_model->select_fields_for_quot_list() . ", " . $this->select_ode_fields_for_quot_list() . ", " . $this->Productcondition_model->get_product_condition_fields_for_quot_list() . ", qst_name as qst_quotStatus, prd_name as itemName, " . $this->Vehicle_model->select_vehicle_fields_for_quot_list());
		$this->db->from($this->table);
		$this->db->join($this->table_quote_status, "ord_quotStatusId = qst_id", "left");
		$this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
		$this->db->join($this->table_products, "ode_productId = prd_id", "left");
		$this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
		$this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
		$this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
		$this->db->join($this->tbl_shipping_method, "shm_id = ord_shippingMethodId", "left");
		$this->db->where(array("ord_id" => $quoteId, "ord_isQuote" => 1));
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category");

		//Mapping order items
		$response_data = $this->map_response($response_data, array("quoteItems" => array("itemId", "itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")), true);

//		  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("shaId, shaFirstName, shaLastName, shaAddressLine1, shaAddressLine2, shaCity, shaState, shaCountry, shaPostCode, shaPhone, shaEmail")));
		return $this->model_response(true, 200, $response_data);
	}

	public function add_item()
	{
		$inputData = $this->httpRequest;
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

	public function remove_item()
	{
		$inputData = $this->httpRequest;

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

	public function get_quot_item_by_ids($ids)
	{
		$this->db->from($this->table_order_detail);
		$this->db->where_in($this->prfx_order_details . 'id', $ids);
		return $this->db->get()->result_array();
	}

	public function update_quote_price()
	{
		/* Build Item Ids Array */
		$itemIds = array_column($this->httpRequest->quoteItems, 'id');

		$itemNewTotal = array_sum(array_column($this->httpRequest->quoteItems, 'total'));

		/* Select Items */
		$items = $this->get_quot_item_by_ids($itemIds);

		/* Build ItemsTotal */
		$itemPreviousTotal = array_sum(array_column($items, 'ode_total'));

		/* build New price array */
		$quoteItems = $this->build_model_array($this->httpRequest->quoteItems, $this->prfx_order_details);

		/* Update Price for item*/
		$this->db->update_batch($this->table_order_detail, $quoteItems, 'ode_id');

		/* Update Price In Quote */
		$this->db->where('ord_id', $this->httpRequest->quoteId);
		$this->db->set('ord_itemTotal', 'ord_itemTotal -' . $itemPreviousTotal . '+' . $itemNewTotal, FALSE);
		$this->db->set('ord_grandTotal', 'ord_grandTotal -' . $itemPreviousTotal . '+' . $itemNewTotal, FALSE);
		$this->db->update($this->table);

		return $this->model_response(true, 200, array(), 'Price Updated');
	}

	public function update_status($quoteId)
	{
		$statusData = array(
			'ord_quotStatusId' => $this->validate_input($this->httpRequest, "statusId")
		);
		if (isset($statusData)) {
			$this->db->where("ord_id", $quoteId);
			$this->db->update($this->table, $statusData);
			return $this->model_response(true, 200, array(), 'Status Updated');
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
	}

	public function update_quote_shipping($quoteId)
	{
		$shippingData = array(
			'ord_shippingAddressId' => $this->validate_input($this->httpRequest, "shippingAddressId"),
			'ord_shippingMethodId' => $this->validate_input($this->httpRequest, "shippingMethodId"),
			'ord_shippingTotal' => $this->validate_input($this->httpRequest, "shippingTotal")
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

	public function select_ode_fields_for_quot_list()
	{
		return $this->prfx_order_details . "id as itemId," .
			$this->prfx_order_details . "price as itemPrice, " .
			$this->prfx_order_details . "comment, " .
			$this->prfx_order_details . "currentMileage, " .
			$this->prfx_order_details . "vehicleId";
	}


	public function create_old()
	{
		$data = $this->httpRequest;
		$quoteReqItems = $data->quoteReqItems;

		unset($data->quoteReqItems);
		$data->statusId = 1;

		$orderData = $this->build_model_data($data, $this->prefix);

		$this->db->insert($this->table, $orderData);
		$orderId = $this->db->insert_id();
		if (!empty($db_error)) {
			return $this->model_response(false, 500, array(), "Error on creating order");
		}

		$orderItemsData = $this->build_model_array($quoteReqItems, $this->prfx_order_details, array("orderId" => $orderId));
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
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, NULL, array("createdAt"));

		//Mapping order items
		// $response_data = $this->map_response($response_data, array("orderItems"=>array("itemName","itemPrice","itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin","vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")),true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $this->model_response(true, 200, $response_data);


	}

	public function get_order_items_by_id($orderId)
	{
		$this->db->select("ord_id,
        concat(first_name, ' ', last_name) as userName,
        sha_id as shippingAddressId,concat(sha_firstName, ' ', sha_lastName) as shippingUser,concat(sha_addressLine1, ' ', sha_addressLine2,' ', sha_city,' ', sha_state,' ', sha_country) as shippingAddress,sha_city,sha_state,sha_country,sha_postCode,sha_phone,sha_email,
        ode_id as itemId, ode_productConditionId as itemConditionId, 
        pco_name as itemConditionName, 
        ost_name as ost_orderStatus, 
        prd_name as ord_itemName,ode_id as orderDetailsId, 
        ode_price as itemPrice, ode_vehicleId, 
        concat(vhl_make,' ',vhl_model,' ',vhl_year) as vehicleInfo,vhl_vin as vehicleVin, vhl_make as vehicleMake, vhl_model as vehicleModel, vhl_year as vehicleYear, vhl_image as vehicleImage, 
        ode_comment, ode_currentMileage, 
        shm_name as shippingMethod, shm_price as shippingCost,
        pty_name as productType,
        pca_name as productCategory");
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
		$this->db->where('ode_orderId', $orderId);
		$result = $this->db->get()->result_array();
		$response_data = $this->build_response_array($result, "category");

		//Mapping order items
		$response_data = $this->map_response($response_data, array("orderItems" => array("itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage", "productType", "productCategory", "vehicleInfo", "orderDetailsId")), true);

		//  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
		return $response_data;
	}

	public function get_order_details_by_id($orderId)
	{
		return $this->model_response(true, 200, $this->get_order_items_by_id($orderId)['orderItems']);
	}


	/*public function get_orders()
	{
		$this->db->from($this->table);
		$this->db->join($this->table_order_detail, 'order_detail.order_id = order.order_id', 'left');
		$result = $this->db->get();
		return $result->result_array();
	}*/

	public function get_cart_items($order_id)
	{
		$this->db->from($this->table_order_detail);
		$this->db->where('order_id', $order_id);
		$result = $this->db->get()->result_array();
		$response_data = $this->camelize_array_data($result);
		return $response_data;
	}


	public function update_status1($request, $orderId)
	{
		$statusData = array(
			'ord_status' => $this->validate_input($request, "statusId")
		);
		if (!isset($statusData)) {
			$this->db->where("order_id", $orderId);
			$this->db->update($this->table, $statusData);
			return $this->model_response(true, 200);
		} else {
			return $this->model_response(true, 400, array(), "Invalid Request");
		}
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

	//Shipping methods
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

	public function generate_order_number($orderId)
	{
		$order_number = "OC-" . substr(date("Y"), -2) . "-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
		return $order_number;
	}

	public function generate_quote_number($quoteId)
	{
		$quote_number = "QT-" . substr(date("Y"), -2) . "-" . str_pad($quoteId, 6, '0', STR_PAD_LEFT);
		return $quote_number;
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

	public function get_order_status()
	{
		$this->db->select("ost_name,ost_order");
		$this->db->from($this->table_order_status);
		$result = $this->db->get()->result_array();
		$response_data = $this->camelize_array_data($result);
		return $response_data;
	}

}