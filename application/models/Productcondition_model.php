<?php
require_once APPPATH . 'core/Generic_model.php';

class Productcondition_model extends Generic_model
{
    var $table = 'product_conditions';
    var $prfx = 'pco_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }


    public function  get_product_condition_select_items(){

        return $this->prfx."id as productConditionId, ".
	        $this->prfx."name as productCondition";

    }
}