<?php
 use Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
    }


    public function list_all_get(){

        $this->response($this->Notification_model->list_all());
    }

    public function list_by_userid_get(){
        $userId = $this->get_path_variable('user-id');
        $this->response($this->Notification_model->list_by_field("userId",$userId));
    }



}