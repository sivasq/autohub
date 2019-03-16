<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent:: __construct();

        $this->load->library('session');
        $this->load->library('cloudinarylib');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->database();
        $this->load->model('admin_model');

//        if (!$this->session->userdata('admin_user_id')) {
//            redirect('admin/index');
//        }
    }


    public function index()
    {
        $data['page_name'] = 'index';

        $this->load->view('admin/dashboard', $data);
    }

    public function products()
    {
        $data['page_name'] = 'products';

        $this->load->view('admin/product', $data);
    }

    public function Nigeria_buyer_list()
    {
        $data['page_name'] = 'Nigeria_buyer';

        $data['buyer_lists'] = $this->admin_model->get_nigeria_buyer_list();
        // print_r($data['buyer_list']);

        $this->load->view('admin/Nigeria_buyer_list', $data);
    }


    public function update_user_details()
    {

        if ($_POST['action'] === 'edit') {

            $data = array(
                'first_name' => $_POST['fname'],
                'last_name' => $_POST['lname'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'ref_code' => $_POST['ref_code']
            );

            $this->db->where('user_id', $_POST['id']);
            $this->db->update('register', $data);

        } else if ($_POST['action'] === 'delete') {

            $this->db->where('user_id', $_POST['id']);
            $this->db->delete('register');
        }

        echo json_encode($_POST);

    }

    public function user_status_update($user_id)
    {
        $data['page_name'] = '';

        $this->db->select('*');
        $this->db->from('private_car');
        // $this->db->join('car_images', 'car_images.private_id = private_car.private_id', 'left');
        $this->db->join('register', 'register.user_id = private_car.user_id', 'left');
        $this->db->where('private_car.user_id', $user_id);
        $data['privatecar_detail'] = $this->db->get()->result();

        $commercial_car = "select * from commercial_car  left join car_images on car_images.commercial_id = commercial_car.commercial_id left join register on register.user_id = commercial_car.user_id where commercial_car.user_id = '$user_id' ";
        $data['comm_car_detail'] = $this->db->query($commercial_car)->result();

        $this->load->view('admin/user_status_update', $data);

    }

    public function update_private_car_status()
    {

        $private_id = $_POST['id'];
        $car_status = $_POST['car_status'];

        $status = array('car_status' => $car_status);
        $update_status = $this->db->where('private_id', $private_id)->update('private_car', $status);

        if ($update_status == true) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
        }

        echo json_encode($response);
    }


    public function update_commercial_car_status()
    {

        $commercial_id = $_POST['id'];
        $car_status = $_POST['car_status'];

        $status = array('car_status' => $car_status);

        $update_status = $this->db->where('commercial_id', $commercial_id)->update('commercial_car', $status);

        if ($update_status == true) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'failed';
        }

        echo json_encode($response);
    }

    public function view_particular_private_car($private_id)
    {
        $data['page_name'] = '';

        $this->db->select('*');
        $this->db->from('private_car');
        $this->db->join('car_images', 'car_images.private_id = private_car.private_id', 'left');
        $this->db->join('register', 'register.user_id = private_car.user_id', 'left');
        $this->db->where('private_car.private_id', $private_id);

        $data['private_detail'] = $this->db->get()->row();

        $this->load->view('admin/view_particular_private_car', $data);

    }

    public function view_particular_commercial_car($commercial_id)
    {
        $data['page_name'] = '';

        $this->db->select('*');
        $this->db->from('commercial_car');
        $this->db->join('car_images', 'car_images.commercial_id = commercial_car.commercial_id', 'left');
        $this->db->join('register', 'register.user_id = commercial_car.user_id', 'left');
        $this->db->where('commercial_car.commercial_id', $commercial_id);

        $data['commercial_detail'] = $this->db->get()->row();

        $this->load->view('admin/view_particular_commercial_car', $data);

    }

}