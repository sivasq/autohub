<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
       
    }


  	public function login_auth()
	{		

		$user_name = $this->input->post("email");
    	$password  = $this->input->post("password");
    	$user_type = 'super_admin';
    	
    		$credential = array('admin_email' => $user_name, 'admin_password' => $password, 'user_type' => $user_type);
    		$query= $this->db->get_where('admin_user', $credential)->result();
 		
 			 		
	       	if($query == true)
			{		 	
				foreach ($query as $queries) 
				{
					$this->session->set_userdata('admin_user_id', $queries->admin_id);
					$this->session->set_userdata('first_name', $queries->admin_fname);
					$this->session->set_userdata('last_name', $queries->admin_lname);
					$this->session->set_userdata('profile_img', $queries->image);
					$this->session->set_userdata('admin_email', $queries->admin_email);
					$this->session->set_userdata('admin_phone', $queries->admin_phone);
				}

				return true;	
									
			}
			else 
				{	
					return false;
				}

	}


  
	public function get_nigeria_buyer_list()
  	{
        $this->db->select('*');
        $this->db->from('commercial_car');
        $this->db->join('car_images', 'car_images.commercial_id = commercial_car.commercial_id', 'left');  
        // $this->db->join('register', 'register.user_id = commercial_car.commercial_id', 'left');
        $this->db->where('commercial_car.car_type','commercial');
        // $this->db->where('register.country','Nigeria');

        $data['user'] = $this->db->get()->result();
      
        return $data['user'];
  	} 


	

   

 
  
   	
}