<?php
require_once APPPATH . 'core/Generic_model.php';

class Cart_model extends Generic_model
{
    var $table = 'shopping_cart';
    var $prfx = 'crt_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
        $this->load->model(array('Product_model'));
        $this->load->model(array('Vehicle_model'));
        $this->load->model(array('Productcondition_model'));

    }

    public function list_by_userId($user_id){
        $this->db->select("crt_id, crt_userId, crt_mileage, crt_comment, ".$this->Product_model->get_product_list().",".$this->Vehicle_model->get_vehicle_select_items().",".$this->Productcondition_model->get_query_list());
        $this->db->from($this->table);
        $this->Product_model->get_product_joins($this->db,$this->prfx."productId");
        $this->Vehicle_model->get_vehicle_joins($this->db, $this->prfx."vehicleId");
        $this->Productcondition_model->get_join($this->db, $this->prfx."prdConditionId");
        $this->db->where($this->prfx."userId = ".$user_id);
        return $this->model_response(true, 200, $this->build_response_array($this->db->get()->result_array()));
    }

}