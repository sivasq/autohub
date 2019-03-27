<?php
require_once APPPATH . 'core/Generic_model.php';

class Driver_model extends Generic_model
{
    var $table = 'vehicle_drivers';
    var $prfx = 'vdr_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

}