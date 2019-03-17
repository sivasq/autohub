<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
    }


    public function add_item_post(){
        $user_id = $this->get_path_variable('user-id');
        $cart_model_data =  $this->Cart_model->build_generic_model_array($this->httpRequest,array("userId"=>$user_id));
        $this->Cart_model->insert_batch($cart_model_data);

        //Get the cartItem list
        $this->response($this->Cart_model->list_by_userId($user_id));
    }


    public function list_items_get(){
        $userId = $this->get_path_variable('user-id');
        $this->response($this->Cart_model->list_by_userId($userId));
    }

    public function delete_items_post(){
        $userId = $this->get_path_variable('user-id');
        $this->Cart_model->delete($this->httpRequest->ids);

        //Get the cartItem list
        $this->response($this->Cart_model->list_by_userId($userId));
    }

    public function delete_delete(){
        $cartItemId = $this->get_path_variable('id');
        $this->response($this->Cart_model->delete($cartItemId));
    }

}