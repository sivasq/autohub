<?php
require_once APPPATH . 'core/Generic_model.php';

class Shippingmethod_model extends Generic_model
{
    var $table = 'shipping_methods';
    var $prfx = 'shm_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
        $this->load->model(array( 'apiv1/Product_model'));
        $this->load->model(array( 'apiv1/Vehicle_model'));
        $this->load->model(array( 'apiv1/Productcondition_model'));

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

	public function select_fields_for_quot_list()
	{
		return $this->prfx . "id as shippingMethodId, " .
			$this->prfx . "name as shippingMethodName";
	}
    
}