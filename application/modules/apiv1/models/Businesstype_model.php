<?php
require_once APPPATH . 'core/Generic_model.php';

class Businesstype_model extends Generic_model
{
    var $table = 'vehicle_business_type';
    var $prfx = 'vbt_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

}