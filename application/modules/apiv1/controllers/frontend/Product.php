<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Base_Controller
{
	const PRODUCT_URL = 'product/index';
	const CATEGORY_URL = 'product/category';
	const TYPE_URL = 'product/type';
	const CONDITION_URL = 'product/condition';
	var $tableProducts = "products";
	var $tableConditions = 'product_conditions';
	var $tableCategories = 'product_categories';
	var $tableTypes = 'product_types';

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Product_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->page_name = 'Products';
		$data->categoryData = $this->get_categories();
		$data->typeData = $this->get_types();
		$data->subItems = $this->get_subItems();
		$this->load->view('admin/product/product', $data);
	}

	public function get_categories()
	{
		$output = "";
		$categoryData = $this->Product_model->select_data($this->tableCategories, "pca_id,pca_name");
		foreach ($categoryData as $value) {
			$data = array_values($value);
			$output .= '<option value="' . $data[0] . '">' . $data[1] . '</option>';
		}
		return $output;

	}

	public function get_types()
	{
		$output = "";
		$categoryData = $this->Product_model->select_data($this->tableTypes, "pty_id,pty_name");
		foreach ($categoryData as $value) {
			$data = array_values($value);
			$output .= '<option value="' . $data[0] . '">' . $data[1] . '</option>';
		}
		return $output;
	}

	public function get_subItems()
	{
		$data = new stdClass();
		$output = "";
		$categoryData = $this->Product_model->select_data($this->tableProducts, "prd_id,prd_name", "prd_typeId", 3);
		foreach ($categoryData as $value) {
			$data = array_values($value);
			$output .= '<option value="' . $data[0] . '">' . $data[1] . '</option>';
		}
		return $output;
	}

	public function category()
	{
		$data['page_name'] = 'Product Category';
		$this->load->view('admin/product/category', $data);
	}

	public function condition()
	{
		$data['page_name'] = 'Product Conditions';
		$this->load->view('admin/product/condition', $data);
	}

	public function type()
	{
		$data['page_name'] = 'Product Types';
		$this->load->view('admin/product/type', $data);
	}

	public function product_create()
	{
		$id = $this->input->post('prdId');
		$subItems = $this->input->post("sub_item");
		$rules = array();
//        $rules = array(
//            array(
//                'field' => 'prdName',
//                'label' => 'Product Name',
//                'rules' => 'required|is_unique[products.prd_name]',
//                'errors' => array(
//                    'required' => 'You must provide a %s.',
//                    'is_unique' => '%s already exists',
//                ),
//            )
//        );
		if (isset($subItems)) {
			$this->createProduct(SELF::PRODUCT_URL, $id, $rules, $this->postProductData(), $this->tableProducts, 'pra_id', $subItems);
		} else {
			$this->createProduct(SELF::PRODUCT_URL, $id, $rules, $this->postProductData(), $this->tableProducts, 'pra_id');
		}
	}

	public function createProduct($view, $id, $rules, $requestData, $table, $id_name, $subItems = NULL)
	{
		$data = new stdClass();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$submitType = $this->input->post('create_update');

		if ($submitType == "Create") {
			// set validation rules
			$this->form_validation->set_rules($rules);
			if ($subItems == NULL) {
				if ($this->Product_model->insert($requestData)) {
					redirect($view);
				}
			} else {
				if ($this->Product_model->create_product_with_sub_items($requestData, $subItems)) {
					redirect($view);
				}
			}
		} else {
			if ($this->Product_model->update($requestData, $id, $table, $id_name)) {
				redirect($view);
			}
		}
	}

	private function postProductData()
	{
		$productName = $this->input->post('prdName');
		$productDescription = $this->input->post('prdDescription');
		$productCategory = $this->input->post('productCategory');
		$productType = $this->input->post('productType');
		$productPrice = $this->input->post('prdPrice');
		$data = array(
			'prd_name' => $productName,
			'prd_description' => $productDescription,
			'prd_categoryId' => $productCategory,
			'prd_typeId' => $productType,
			'prd_price' => $productPrice
		);

		return $data;
	}

	public function product_delete()
	{
		$id = $this->input->post('id');
		$this->Product_model->delete($id, $this->tableCategories, 'pca_id');
	}

	public function category_create()
	{
		$id = $this->input->post('pcaId');
		$rules = array(
			array(
				'field' => 'pcaName',
				'label' => 'Category Name',
				'rules' => 'required|is_unique[product_categories.pca_name]',
				'errors' => array(
					'required' => 'You must provide a %s.',
					'is_unique' => '%s already exists',
				),
			)
		);
		$this->create(SELF::CATEGORY_URL, $id, $rules, $this->postCategoryData(), $this->tableCategories, 'pca_id', "Product Category");
	}

	public function create($view, $id, $rules, $requestData, $table, $id_name, $page_name)
	{
		$data = new stdClass();
		$data->page_name = $page_name;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$submitType = $this->input->post('create_update');

		if ($submitType == "Create") {
			// set validation rules
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === false) {

				// validation not ok, send validation errors to the view
				$this->load->view('admin/' . $view, $data);
			} else {
				if ($this->Product_model->insert($requestData, $table)) {
					redirect($view);
				}
			}
		} else {
			if ($this->Product_model->update($requestData, $id, $table, $id_name)) {
				redirect($view);
			}
		}
	}

	private function postCategoryData()
	{
		$categoryName = $this->input->post('pcaName');
		$categoryDescription = $this->input->post('pcaDescription');
		$data = array(
			'pca_name' => $categoryName,
			'pca_description' => $categoryDescription
		);
		return $data;
	}

	public function category_delete()
	{
		$id = $this->input->post('id');
		$this->Product_model->delete($id, $this->tableCategories, 'pca_id');
	}

	public function condition_create()
	{
		$id = $this->input->post('pcoId');
		$rules = array(
			array(
				'field' => 'pcoName',
				'label' => 'Condition Name',
				'rules' => 'required|is_unique[product_conditions.pco_name]',
				'errors' => array(
					'required' => 'You must provide a %s.',
					'is_unique' => '%s already exists',
				),
			)
		);
		$this->create(SELF::CONDITION_URL, $id, $rules, $this->postConditionData(), $this->tableConditions, 'pco_id', 'Product Conditions');
	}

	private function postConditionData()
	{
		$conditionName = $this->input->post('pcoName');
		$conditionDescription = $this->input->post('pcoDescription');
		$data = array(
			'pco_name' => $conditionName,
			'pco_description' => $conditionDescription
		);
		return $data;
	}

	public function condition_delete()
	{
		$id = $this->input->post('id');
		$this->Product_model->delete($id, $this->tableConditions, 'pco_id');
	}

	public function type_create()
	{
		$id = $this->input->post('ptyId');
		$rules = array(
			array(
				'field' => 'ptyName',
				'label' => 'Type Name',
				'rules' => 'required|is_unique[product_types.pty_name]',
				'errors' => array(
					'required' => 'You must provide a %s.',
					'is_unique' => '%s already exists',
				),
			)
		);
		$this->create(SELF::TYPE_URL, $id, $rules, $this->postTypeData(), $this->tableTypes, 'pty_id', "Product Types");
	}

	private function postTypeData()
	{
		$typeName = $this->input->post('ptyName');
		$typeDescription = $this->input->post('ptyDescription');
		$data = array(
			'pty_name' => $typeName,
			'pty_description' => $typeDescription
		);
		return $data;
	}

	public function type_delete()
	{
		$id = $this->input->post('id');
		$this->Product_model->delete($id, $this->tableTypes, 'pty_id');
	}

}