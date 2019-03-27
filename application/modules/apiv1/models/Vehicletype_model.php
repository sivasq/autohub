<?php
require_once APPPATH . 'core/Generic_model.php';

class Vehicletype_model extends Generic_model
{
    var $table = 'vehicle_types';
    var $prfx = 'vtyp_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return string
     */
    public function getPrfx()
    {
        return $this->prfx;
    }



}