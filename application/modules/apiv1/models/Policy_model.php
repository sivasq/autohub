<?php
require_once APPPATH . 'core/Generic_model.php';

class Policy_model extends Generic_model
{
    var $table = 'policy';
    var $prfx = '';

    public function __construct()
    {
        parent::__construct($this->table, $this->prfx);
    }

    public function get_policy_by_id($policy_id)
    {
        $this->db->from($this->table);
        $this->db->where('policy_id', $policy_id);
        $result = $this->build_response($this->db->get()->row());
        return $this->model_response(true, 200, $result);
    }

    public function update_policy_by_id($data)
    {        
        $this->db->where('policy_id', $data['policyid']);
        $this->db->update($this->table, array('policy_value' => $data['details']));        
        return $this->model_response(true, 200, array(), "Updated Successfully");
    }
}
