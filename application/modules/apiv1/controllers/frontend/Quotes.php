<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends User_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('Quote_model');
	    $this->load->model('Quotreq_model');
    }

    public function index()
    {
        $data['page_name'] = "Quotes";
        $this->load->view('admin/quote/quotedata', $data);
    }

	public function reqs()
	{
		$data['page_name'] = "Quote Reqs.";
		$this->load->view('admin/quote/quotereqdata', $data);
	}

    public function detail_view()
    {
        $quoteId = $this->get_path_variable('quote-id');
        $data = new stdClass();
        $data->page_name = "Quote Details";
        $data->itemData = $this->Quote_model->get_quote_items_by_id($quoteId);
        $data->statusData = $this->Quote_model->get_quote_status();
//        echo json_encode($data);
//        die();
        $this->load->view('admin/quote/quotedetails', $data);
    }

    public function update_items_price()
    {
        $update_data = json_decode(file_get_contents('php://input'));
        return json_encode($update_data);
    }

    public function get_path_variable($path)
    {
        $data = $this->uri->uri_to_assoc();
        // echo json_encode($data);die;
        $code = $data[$path];
        return $code;
    }

	public function req_detail_view()
	{
		$itemId = $this->get_path_variable('item-id');
		$data = new stdClass();
		$data->page_name = "Quote Req Item Details";
		$data->itemData = $this->Quotreq_model->get_quotereq_item_by_id($itemId);
//		$data->statusData = $this->Quote_model->get_quote_status();
//        echo json_encode($data);
//        die();
		$this->load->view('admin/quote/quotereqdetails', $data);
//		print_r($data);
	}
}