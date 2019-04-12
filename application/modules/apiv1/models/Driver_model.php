<?php
require_once APPPATH . 'core/Generic_model.php';

class Driver_model extends Generic_model
{
    var $table = 'vehicle_drivers';
	var $table_vehicles = 'vehicles';
    var $prfx = 'vdr_';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

	public function list_driver_by_vehicle($vehicleId)
	{
	    #Create where clause
	    $this->db->select('vhl_driverId');
	    $this->db->from($this->table_vehicles);
	    $this->db->where('vhl_id', $vehicleId);
	    $subQuery = $this->db->get_compiled_select();//it just compile the active records query without running it

		#Create main query
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("vdr_id IN ($subQuery)", NULL, FALSE);//The NULL, FALSE in the where() method tells CodeIgniter not to escape the query.

	    return $this->model_response(true, 200, array('driver' => $this->build_response($this->db->get()->row())));
    }

//	public function list_driver_by_vehicle($vehicleId)
//    {
//	    $this->db->select('*')->from($this->table);
//	    $this->db->where('`vdr_id` IN (SELECT `vhl_driverId` FROM `'.$this->table_vehicles.'` where `vhl_id`= '.$vehicleId.')', NULL, FALSE);
//	    return $this->model_response(true, 200, array('driver' => $this->build_response($this->db->get()->row())));
//    }

}