<?php
require APPPATH . 'core/Generic_model.php';

class User_model extends Generic_model
{

    const TBL_SHIPPING_ADDRESS = 'shipping_addresses';
    const SHA = 'sha_';
    const USER_ID = self::SHA . 'userId';

    public function create_shipping_address($shippingAddress)
    {
        $shippingAddressData = $this->build_model_data($shippingAddress, self::SHA);
        $this->db->insert(self::TBL_SHIPPING_ADDRESS, $shippingAddressData);
        return $this->model_response(true,202, array("shippingAddressId"=>$this->db->insert_id()));
    }

    public function update_shipping_address($shippingAddress, $shippingId)
    {
        $shippingAddressData = $this->create_model($shippingAddress, self::SHA);
        $this->db->where("sha_id", $shippingId);
        $this->db->update(self::TBL_SHIPPING_ADDRESS, $shippingAddressData);
        //$this->db->affected_rows()->get();
        return $this->model_response(true,200);
    }

    public function list_shipping_address($userId)
    {
        $this->db->from(self::TBL_SHIPPING_ADDRESS);
        $this->db->where(self::USER_ID, $userId);
        $result = $this->db->get();
        $response_data = $this->build_response_array($result->result_array());
        return $this->model_response(true,200, $response_data);
    }

}