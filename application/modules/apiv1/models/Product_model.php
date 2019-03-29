<?php
/**
 * Created by PhpStorm.
 * User: enginef
 * Date: 29/1/19
 * Time: 7:50 PM
 */
require_once APPPATH . 'core/Generic_model.php';

class Product_model extends Generic_Model
{
	var $table = "products";
	var $tableConditions = 'product_conditions';
	var $tableCategories = 'product_categories';
	var $tableTypes = 'product_types';
	var $subProducts = 'product_sub_products';
	var $prfx = "prd_";
	var $cat_prfx = "pca_";
	var $pty_prfx = "pty_";

	var $limit = 10;

	public function __construct()
	{
		parent::__construct($this->table, $this->prfx);
		$this->load->helper('inflector');
	}

	public function create_product_with_sub_items($data, $subItems = NULL)
	{
		$this->db->insert($this->table, $data);
		$productId = $this->db->insert_id();
		if (!empty($subItems)) {
			$sub_items_model = array();
			foreach ($subItems as $subItem) {
				$model = array(
					"psp_productId" => $productId,
					"psp_subProductId" => $subItem,
				);
				array_push($sub_items_model, $model);
			}
			$this->db->insert_batch($this->subProducts, (array)$sub_items_model);
		}
		return true;
	}

	public function list_product_conditions()
	{
		$this->db->from($this->tableConditions);
		//$this->db->limit($this->limit);
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
		return $this->model_response(true, 200, array('productConditions' => $response_data));
	}

	public function list_product_by_type($typeId)
	{
		$this->db->select($this->table . ".*, " .$this->table . ".prd_id as productId, " .$this->tableCategories . ".pca_name as productCategory, pty_name as productType");
		$this->db->from($this->table);
		$this->db->join($this->tableCategories, 'prd_categoryId = pca_id');
		$this->db->join($this->tableTypes, 'prd_typeId = pty_id');
		$this->db->where('prd_typeId=' . $typeId);
		$this->db->order_by('pca_name');
		$result = $this->db->get();
		$response_data = $this->build_response_array_simple($result->result_array(), "productCategory");
		return $this->model_response(true, 200, array('vehicleParts' => array($response_data)));
	}

	public function list_service_packs()
	{
		$this->db->select("parent.prd_name as servicePackName, parent.prd_id as productId, child.*");
		$this->db->from($this->table . " as parent");
		$this->db->join($this->subProducts, 'parent.prd_id = psp_productId');
		$this->db->join($this->table . " as child", 'psp_subProductId = child.prd_id');
		$this->db->where('parent.prd_typeId=2');
		$this->db->order_by('servicePackName');
		$result = $this->db->get();
		$response_data = $this->build_response_array_simple($result->result_array(), "servicePackName");
		return $this->model_response(true, 200, array('servicePacks' => $response_data));
	}

	public function get_products()
	{
		$this->db->select($this->table . ".*, " . $this->tableCategories . ".pca_name as productCategory, pty_name as productType");
		$this->db->from($this->table);
		$this->db->join($this->tableCategories, 'prd_categoryId = pca_id', 'left');
		$this->db->join($this->tableTypes, 'prd_typeId = pty_id', 'left');
		$this->db->order_by("prd_createdAt", "desc");
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_products_sub_items()
	{
		$this->db->select($this->table . ".*, " . $this->tableCategories . ".pca_name as productCategory, pty_name as productType");
		$this->db->from($this->table);
		$this->db->join($this->tableCategories, 'prd_categoryId = pca_id', 'left');
		$this->db->join($this->tableTypes, 'prd_typeId = pty_id', 'left');
		$this->db->where('prd_typeId=3');
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_products_service_pack()
	{
		$this->db->select($this->table . ".*, " . $this->tableCategories . ".pca_name as productCategory, pty_name as productType");
		$this->db->from($this->table);
		$this->db->join($this->tableCategories, 'prd_categoryId = pca_id', 'left');
		$this->db->join($this->tableTypes, 'prd_typeId = pty_id', 'left');
		$this->db->where('prd_typeId=2');
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_subItems()
	{
		$this->db->select("prd_id as ProductId,prd_name as ProductName");
		$this->db->from($this->table);
		$this->db->where('prd_typeId=3');
		$result = $this->db->get();
		$response_data = $this->build_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_categories()
	{
		$this->db->from($this->tableCategories);
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_conditions()
	{
		$this->db->from($this->tableConditions);
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_types()
	{
		$this->db->from($this->tableTypes);
		$result = $this->db->get();
		$response_data = $this->build_datatable_response_array($result->result_array());
		return $this->model_response(true, 200, $response_data);
	}

	public function get_product_joins(& $db, $relation_field)
	{
		$db->join($this->table, $this->prfx . "id = " . $relation_field, "left");
		$db->join($this->tableCategories, 'prd_categoryId = pca_id', "left");
		$db->join($this->tableTypes, 'prd_typeId = pty_id', "left");
	}

	public function get_product_select_items()
	{
		return $this->prfx . "id as productId, " .
			$this->prfx . "name as productName, " .
			$this->prfx . "image as productImage, " .
			$this->cat_prfx . "name as categoryName, " .
			$this->pty_prfx . "name as productType";
	}
}