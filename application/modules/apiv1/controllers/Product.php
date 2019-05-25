<?php

use Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
	}

	/*
	 * No Body
	 */
	public function list_product_conditions_get()
	{
		$response = $this->Product_model->list_product_conditions();
		return $this->response($response);
	}

	/*
	 * No Body
	 */
	public function list_vehicle_parts_get()
	{
		$response = $this->Product_model->list_product_by_type(1, 'vehicleParts', 'productCategory');
		return $this->response($response);
	}

	/*
	 * No Body
	 */
	public function list_shopping_parts_get()
	{
		$response = $this->Product_model->list_product_by_type_for_shopping_items(4, 'shoppingParts');
		return $this->response($response);
	}

	/*
	 * No Body
	 */
	public function list_service_packs_get()
	{
		$response = $this->Product_model->list_service_packs();
		return $this->response($response);
	}


	/*
	 * For Admin Panel
	 */
	public function get_products_get()
	{
		$response = $this->Product_model->get_products();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	public function get_products_sub_items_get()
	{
		$response = $this->Product_model->get_products_sub_items();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	public function get_products_service_pack_get()
	{
		$response = $this->Product_model->get_products_service_pack();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	public function get_categories_get()
	{
		$response = $this->Product_model->get_categories();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	public function get_conditions_get()
	{
		$response = $this->Product_model->get_conditions();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	public function get_type_get()
	{
		$response = $this->Product_model->get_types();
		return $this->response($response, REST_Controller::HTTP_OK);
	}

	/*
	 * Deprecated Functions
	 */
	public function get_sub_items_get()
	{
		$response = $this->Product_model->get_subItems();
		return $this->response($response, REST_Controller::HTTP_OK);
	}
}