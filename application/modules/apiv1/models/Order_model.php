<?php
require APPPATH . 'core/Generic_model.php';

class Order_model extends Generic_model
{
    var $table = 'orders';
    var $table_order_detail = 'order_details';
    var $table_order_status = 'order_status';
    const TBL_ORDER_PAYMENT = 'order_payment';
    const TBL_ORDER_SHIPPING = 'order_shipping';
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
        $this->load->model(array('Product_model'));
    }

    public function create($data)
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

    public function get_order_by_id($orderId)
    {

        $this->db->select("shm_id as shippingMethodId, shm_name as shippingMethodName, sha_id,sha_firstName,sha_lastName,sha_addressLine1, sha_addressLine2,sha_city,sha_state,sha_country,sha_postCode,sha_phone,sha_email, ode_id as itemId, ode_productConditionId as itemConditionId, pco_name as itemConditionName, ost_name as ost_orderStatus, prd_name as ord_itemName, ode_price as itemPrice, ode_vehicleId, vhl_vin as vehicleVin, vhl_make as vehicleMake, vhl_model as vehicleModel, vhl_year as vehicleYear, vhl_image as vehicleImage, ode_comment, ode_currentMileage");
        $this->db->from($this->table);
        $this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
        $this->db->join($this->table_order_detail, "ord_id = ode_orderId", "left");
        $this->db->join($this->table_products, "ode_productId = prd_id", "left");
        $this->db->join($this->table_vehicles, "ode_vehicleId = vhl_id", "left");
        $this->db->join($this->tbl_product_condition, "ode_productConditionId = pco_id", "left");
        $this->db->join($this->tbl_shipping_address, "sha_id = ord_shippingAddressId", "left");
        $this->db->join($this->tbl_shipping_method, "shm_id = ord_shippingMethodId", "left");
        $result = $this->db->get()->result_array();
        $response_data = $this->build_response_array($result, "category");

        //Mapping order items
        $response_data = $this->map_response($response_data, array("orderItems" => array("itemName", "itemPrice", "itemConditionId", "itemConditionName", "comment", "currentMileage", "vehicleId", "vehicleVin", "vehicleMake", "vehicleModel", "vehicleYear", "vehicleImage")), true);

        //  $response_data = $this->map_response($response_data, array("shippingAddress"=>array("id,firstName,lastName,addressLine1,addressLine2,city,state,country,postCode,phone,email")));
        return $this->model_response(true, 200, $response_data);


    }

    public function get_orders_by_userId($user_id){

        $this->db->select($this->table . ".*,ost_name as status,concat(first_name, ' ', last_name) as userName");
        $this->db->from($this->table);
        $this->db->join($this->table_order_status, "ord_statusId = ost_id", "left");
        $this->db->join($this->tbl_users, "user_id = ord_userId", "left");
        $this->db->where("ord_userId", $user_id);
        $this->db->order_by('ord_createdAt');
        $result = $this->db->get()->result_array();
        $response_data = $this->build_response_array($result, NULL, array("createdAt"));
        return $this->model_response(true, 200, $response_data);
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
	    $this->db->where('ord_isOrder',1);
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


    public function update_status($request, $orderId)
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