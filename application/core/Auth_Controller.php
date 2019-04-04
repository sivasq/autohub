<?php

/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 28-03-2019 028
 * Time: 12:34
 */
class Auth_Controller extends Base_Controller
{

	/**
	 * Base_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();

        if ($this->session->userdata('admin_user_id')) {
	        redirect('admin/dashboard');
        }
	}

}