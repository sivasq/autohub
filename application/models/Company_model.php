<?php
require_once APPPATH . 'core/Generic_model.php';

class Company_model extends Generic_model
{
    var $table = 'vehicle_companies';
    var $prfx = 'vcm_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

}