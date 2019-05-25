<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends User_Controller
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
		parent::__construct();
		$this->load->model('apiv1/Product_model');
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

		if (isset($subItems)) {
			$this->createProduct(SELF::PRODUCT_URL, $id, $this->postProductData(), $this->tableProducts, 'prd_id', $subItems);
		} else {
			$this->createProduct(SELF::PRODUCT_URL, $id, $this->postProductData(), $this->tableProducts, 'prd_id');
		}
	}

	public function createProduct($view, $id, $requestData, $table, $id_name, $subItems = NULL)
	{
		$data = new stdClass();
		$data->page_name = "Products";
		$data->categoryData = $this->get_categories();
		$data->typeData = $this->get_types();
		$data->subItems = $this->get_subItems();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$submitType = $this->input->post('create_update');

		if ($submitType == "Create") {

			//Validation rule load from config file
			if ($this->form_validation->run('product_create') === false) {
				// validation not ok, send validation errors to the view
				$this->load->view('admin/product/product', $data);
			} else {
				if ($subItems == NULL) {
					if ($this->Product_model->insert($requestData)) {
						redirect($view);
					}
				} else {
					if ($this->Product_model->create_product_with_sub_items($requestData, $subItems)) {
						redirect($view);
					}
				}
			}
		} else {
			if ($subItems == NULL) {
				if ($this->Product_model->update($requestData, $id, $table, $id_name)) {
					redirect($view);
				}
			} else {
				if ($this->Product_model->update_product_with_sub_items($requestData, $id, $table, $id_name, $subItems)) {
					redirect($view);
				}
			}
		}
	}

	private function postProductData()
	{
		$productName = $this->input->post('prdName');
		$productDescription = $this->input->post('prdDescription');
		$productType = $this->input->post('productType');
		$productCategory = $this->input->post('productCategory');
		$productPrice = $this->input->post('prdPrice');
		$prdCurrentStock = $this->input->post('prdCurrentStock');
		$prdBrand = $this->input->post('prdBrand');
		$prdPartNumber = $this->input->post('prdPartNumber');
		$prdIncluded = $this->input->post('prdIncluded');
		$prdImage = $this->input->post('prdImage');

		$data = array(
			'prd_name' => $productName,
			'prd_description' => $productDescription,
			'prd_categoryId' => $productCategory,
			'prd_typeId' => $productType,
			'prd_price' => $productPrice,
			'prd_currentStock' => $prdCurrentStock,
			'prd_brand' => $prdBrand,
			'prd_partNumber' => $prdPartNumber,
			'prd_included' => $prdIncluded,
			'prd_image' => $prdImage
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

		$this->create(SELF::CATEGORY_URL, $id, 'prd_category_create', $this->postCategoryData(), $this->tableCategories, 'pca_id', "Product Category");
	}

	public function create($view, $id, $rules_config, $requestData, $table, $id_name, $page_name)
	{
		$data = new stdClass();
		$data->page_name = $page_name;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$submitType = $this->input->post('create_update');

		if ($submitType == "Create") {
			//Validation rule load from config file
			if ($this->form_validation->run($rules_config) === false) {
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

		$this->create(SELF::CONDITION_URL, $id, 'prd_condition_create', $this->postConditionData(), $this->tableConditions, 'pco_id', 'Product Conditions');
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

		$this->create(SELF::TYPE_URL, $id, 'product_type_create', $this->postTypeData(), $this->tableTypes, 'pty_id', "Product Types");
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

	//	Testing Function
	public function product_details()
	{

		//		$query = $this->db->query('SELECT *, (select GROUP_CONCAT(`psp_subProductId`) from `product_sub_products` where `psp_productId` = 17)  as `sub` FROM `products`' );


		//working
		//		$query = $this->db->query('SELECT *, GROUP_CONCAT(`product_sub_products`.`psp_subProductId`) AS `subitem`
		//FROM  `products`
		//left JOIN  `product_sub_products` ON `product_sub_products`.`psp_productId` = `products`.`prd_id`
		////group by `products`.`prd_id`');


		//working
		//		$query = $this->db->query('SELECT *, GROUP_CONCAT(`product_sub_products`.`psp_subProductId` ORDER BY `psp_subProductId` ASC SEPARATOR ";") AS `subitem`
		//FROM  `products`
		//LEFT JOIN  `product_sub_products` ON `product_sub_products`.`psp_productId` = `products`.`prd_id`
		//group by `products`.`prd_id`');


		//working
		//		$query = $this->db->query('SELECT *, GROUP_CONCAT(CONCAT_WS(",", `product_sub_products`.`psp_productId`, `product_sub_products`.`psp_subProductId`) SEPARATOR ";") AS `subitem`
		//FROM  `products`
		//LEFT JOIN  `product_sub_products` ON `product_sub_products`.`psp_productId` = `products`.`prd_id`
		//group by `products`.`prd_id`');


		//		$query = $this->db->query('SELECT *, CONCAT(
		//  "[", GROUP_CONCAT( JSON_OBJECT(`product_sub_products`.`psp_productId`, `product_sub_products`.`psp_subProductId`) SEPARATOR ";"), "]") AS `subitem`
		//FROM  `products`
		//LEFT JOIN  `product_sub_products` ON `product_sub_products`.`psp_productId` = `products`.`prd_id` where `psp_productId` = 17
		//group by `products`.`prd_id`');

		//		$query = $this->db->query('SELECT *, CONCAT(
		//  "[", GROUP_CONCAT( `product_sub_products`.`psp_subProductId` SEPARATOR ","), "]") AS `subitem`
		//FROM  `products`
		//LEFT JOIN  `product_sub_products` ON `product_sub_products`.`psp_productId` = `products`.`prd_id` where `psp_productId` = 17
		//group by `products`.`prd_id`');


		$this->db->select("products.*, product_categories.pca_name as productCategory, pty_name as productType, CONCAT('', GROUP_CONCAT( product_sub_products.psp_subProductId SEPARATOR ','), '') AS subitem, CONCAT('', GROUP_CONCAT( sub.prd_name SEPARATOR ','), '') AS subitemname");
		$this->db->from('products');
		$this->db->join('product_categories', 'prd_categoryId = pca_id', 'left');
		$this->db->join('product_types', 'prd_typeId = pty_id', 'left');
		$this->db->join('product_sub_products', 'psp_productId = prd_id', 'left');
		$this->db->join('products as sub', 'psp_subProductId = sub.prd_id', 'left');
		$this->db->group_by('products.prd_id');
		$query = $this->db->get();


		$result = $query->result_array();

		print_r($result);
	}
}
