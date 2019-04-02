<?php

class Generic_model extends CI_Model
{
	var $table;
	var $prfx;
	var $primary_key = "id";

	public function __construct($table, $prfx)
	{
		parent::__construct();
		$this->table = $table;
		$this->prfx = $prfx;
		$this->primary_key = $prfx . $this->primary_key;
		$this->load->database();
	}

	public function insert($data, $table = NULL, $idField = 'id', $message = NULL)
	{
		if ($table != NULL) {
			$this->db->insert($table, $data);
			return $this->model_response(true, 202, array($idField => $this->db->insert_id()), $message);
		}
		$this->db->insert($this->table, $data);
		return $this->model_response(true, 202, array($idField => $this->db->insert_id()), $message);
	}

	public function insert_batch($data_array, $table = NULL, $message = NULL)
	{
		if ($table != NULL) {
			$this->db->insert_batch($this->table, $data_array);
			return $this->model_response(true, 202, array());
		}
		$this->db->insert_batch($this->table, $data_array);
		return $this->model_response(true, 202, array(), $message);
	}

	public function update($data, $id, $table = NULL, $primary_key = NULL, $message = NULL)
	{
		if ($table != NULL) {
			$this->db->where($primary_key, $id);
			$this->db->update($table, $data);
			return $this->model_response(true, 200, array(), $message);
		}
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table, $data);
		return $this->model_response(true, 200, array(), $message);
	}

	public function delete_by_ids($id_array, $table = NULL, $primary_key = NULL)
	{
		if ($table != NULL) {
			$this->db->where_in($primary_key, $id_array);
			$this->db->delete($table);
			return $this->model_response(true, 202, array());
		}
		$this->db->where_in($this->primary_key, $id_array);
		$this->db->delete($this->table);
		return $this->model_response(true, 202, array());
	}

	public function delete($id, $table = NULL, $primary_key = NULL)
	{
		if ($table != NULL) {
			if (is_array($id)) {
				$this->db->where_in($primary_key, $id);
			} else {
				$this->db->where($primary_key, $id);
			}
			$this->db->delete($table);
			return $this->model_response(true, 202, array(), 'Delete Success');
		}
		$this->db->where_in($this->primary_key, $id);
		$this->db->delete($this->table);
		return $this->model_response(true, 202, array(), 'Delete Success');
	}

	public function delete_inner($id, $table = NULL, $primary_key = NULL)
	{
		if ($table != NULL) {
			if (is_array($id)) {
				$this->db->where_in($primary_key, $id);
			} else {
				$this->db->where($primary_key, $id);
			}
			return $this->db->delete($table);
		}
		$this->db->where_in($this->primary_key, $id);
		return $this->db->delete($this->table);
	}

	public function list_by_field($fieldName, $value, $table = NULL, $orderby = "createdAt", $responseField)
	{
		if ($table != NULL) {
			$this->db->from($table);
			$this->db->where($this->prfx . $fieldName, $value);
			$result = $this->build_response_array($this->db->get()->result_array());
			return $this->model_response(true, 200, array($responseField => $result));
		}
		$this->db->from($this->table);
		if ($orderby)
			$this->db->order_by($this->prfx . $orderby);

		$this->db->where($this->prfx . $fieldName, $value);
		$result = $this->build_response_array($this->db->get()->result_array());
		return $this->model_response(true, 200, array($responseField => $result));
	}

	public function list_all($table = NULL, $where = NULL, $orderby = "createdAt", $responseField)
	{
		if ($table != NULL) {
			$this->db->from($table);
			$result = $this->build_response_array($this->db->get()->result_array());
			return $this->model_response(true, 200, array($responseField => $result));
		}
		$this->db->from($this->table);
		if ($orderby)
			$this->db->order_by($this->prfx . $orderby);
		$result = $this->build_response_array($this->db->get()->result_array());
		return $this->model_response(true, 200, array($responseField => $result));
	}

	public function get_join(& $db, $relation_field)
	{
		$db->join($this->table, $this->prfx . "id = " . $relation_field, "left");
	}

	public function check_input_body($data_var)
	{
		if ($data = ($data_var !== null) ? $data_var : 'NULL') {
			return $data;
		}
	}

	public function validate_input($data_var, $value)
	{
		if (isset($data_var->$value)) {
			if ($data = ($data_var !== null) ? $data_var : 'NULL') {
				return $data_var->$value;
			}
		}
	}


	public function camelize_data($result)
	{
		$response_data = array();
		foreach ($result as $key => $value) {
			$camelKey = camelize($key);
			$response_data[$camelKey] = $value;
		}
		return $response_data;
	}

	public function camelize_array_data($result)
	{
		$response_array_data = array();
		foreach ($result as $data) {
			$response_data = array();
			foreach ($data as $key => $value) {
				$camelKey = camelize($key);
				$response_data[$camelKey] = $value;
			}
			array_push($response_array_data, $response_data);
		}
		return $response_array_data;
	}

	public function build_response($result, $date_fields = array())
	{
		$response_data = array();
		foreach ($result as $key => $value) {
			$responseKey = (strpos($key, '_')) ? substr($key, strpos($key, "_") + 1) : $key;
			if (!in_array($responseKey, array_diff(array('createdAt', 'createdBy', 'updatedAt', 'updatedBy'), $date_fields)))
				$response_data[$responseKey] = $value;
		}
		return $response_data;
	}

	public function build_response_array($result, $mapField = NULL, $date_fields = array())
	{
		$response_array_data = array();

		if (empty($result))
			return $response_array_data;

		foreach ($result as $data) {
			$response_data = $this->build_response($data, $date_fields);

			if (array_key_exists($mapField, $response_data)) {

				if (!array_key_exists(0, $response_array_data))
					array_push($response_array_data, array());  //to create response data as array;

				if (!array_key_exists($response_data[$mapField], $response_array_data[0])) {
					$response_array_data[0][$response_data[$mapField]] = array();
				}

				array_push($response_array_data[0][$response_data[$mapField]], $response_data);
			} else
				array_push($response_array_data, $response_data);
		}
		return $response_array_data;
	}

	public function build_response_array_simple($result, $mapField = NULL, $date_fields = array())
	{
		$response_array_data = array();

		if (empty($result))
			return $response_array_data;

		foreach ($result as $val) {
			$response_data = $this->build_response($val, $date_fields);

			if (array_key_exists($mapField, $response_data)) {
				$response_array_data[$response_data[$mapField]][] = $response_data;
			} else {
				$response_array_data[""][] = $response_data;
			}
		}

		return $response_array_data;
	}

	public function build_datatable_response_array($result, $mapField = NULL)
	{
		return $this->camelize_array_data($result);
	}

	public function map_response($data, $model_array_items, $repeated = false)
	{
		$mapped_array = array();

		foreach ($model_array_items as $model_key => $model_array) {

			$mapped_array[$model_key] = array();

			$mapped_items = array();

			foreach ($data as $items) {
				foreach ($items as $attr_key => $attributes) {
					//var_dump($item);
					// if(is_array($attributes))
					//     continue;

					if (in_array($attr_key, $model_array)) {
						$mapped_items[$attr_key] = $attributes;
					} elseif (!array_key_exists($attr_key, $mapped_array)) {
						$mapped_array[$attr_key] = $items[$attr_key];
					}
				}

				array_push($mapped_array[$model_key], $mapped_items);

//				   if(!$repeated)
//				      break;
			}
		}
		return $mapped_array;
	}

	//  public function map_su

	/*
* Map result as complicated array as given
* */

	public function map_result($data, $map_model)
	{

		if (!is_array($map_model) || $map_model == null)
			return $data;

		reset($map_model);
		$map_key = key($map_model);
		$data[$map_key] = array();
		foreach ($map_model[$map_key] as $item_key => $item) {
			if (is_array($item))
				$this->map_result($data, $item);

			if (array_key_exists($item, $data)) {
				$data[$map_key][$item_key] = $data[$item_key];
				unset($data[$item_key]);
			}
		}
	}

	/*
	 * $additionalFields to add additional fields in to model data
	 * */
	public function build_model_data(&$array, $prefix = '', $additionalFields = array())
	{
		$model_data = array();
		foreach ($array as $k => $v) {
			foreach ($additionalFields as $key => $value)
				$model_data[$prefix . $key] = $value;
			$model_data[$prefix . $k] = $v;
		}
		return $model_data;
	}


	public function build_generic_model_data(&$array, $additionalFields = array())
	{
		$model_data = array();
		foreach ($array as $k => $v) {
			foreach ($additionalFields as $key => $value)
				$model_data[$this->prfx . $key] = $value;
			$model_data[$this->prfx . $k] = $v;
		}
		return $model_data;
	}

	//Deprecated
	public function build_model_array(&$array, $prefix = '', $additionalFields = array())
	{

		$model_array_data = array();

		foreach ($array as $items) {
			$model_data = $this->build_model_data($items, $prefix, $additionalFields);
			array_push($model_array_data, $model_data);
		}
		return $model_array_data;
	}


	public function build_generic_model_array(&$array, $additionalFields = array())
	{

		$model_array_data = array();

		foreach ($array as $items) {
			$model_data = $this->build_model_data($items, $this->prfx, $additionalFields);
			array_push($model_array_data, $model_data);
		}
		return $model_array_data;
	}

	public function model_response($status = false, $errorCode = NULL, $data = array(), $message = "")
	{
		return array($status, $errorCode, $message, $data);
	}

	public function create_model(&$array, $prefix = '')
	{
		$model_data = array();
		foreach ($array as $k => $v) {
			$model_data[$prefix . $k] = $v;
		}
		return $model_data;
	}

	public function select_data($tableName, $selectCondition, $conditionKey = NULL, $conditionValue = NULL)
	{
		$selectArray = array();
		if (empty($conditionKey) or empty($conditionValue)) {
			$this->db->select($selectCondition);
			$this->db->from($tableName);

		} else {
			$this->db->select($selectCondition);
			$this->db->from($tableName);
			$this->db->where($conditionKey, $conditionValue);
		}
		$selectionDataIds = explode(",", $selectCondition);
		$selectData = $this->db->get()->result_array();
		foreach ($selectData as $data) {
			$temp = array("id" => $data[$selectionDataIds[0]], "name" => $data[$selectionDataIds[1]]);
			array_push($selectArray, $temp);
		}
		return $selectArray;
	}

	public function getArrayFiltered($FilterKey, $FilterValue, $array)
	{
		$filtered_array = array();
		foreach ($array as $value) {
			if (isset($value->$FilterKey)) {
				if ($value->$FilterKey == $FilterValue) {
					$filtered_array[] = $value;
				}
			}
		}

		return $filtered_array;
	}

	/*
	 * $a = [
    (object)['size' => 15, 'person' => (object)['name' => 'Andy', 'job' => 'developer'], 'pet' => 'dog'],
    (object)['size' => 9, 'person' => (object)['name' => 'Candy', 'job' => 'stripper'], 'pet' => 'hamster'],
    (object)['person' => (object)['name' => 'Bubbles', 'job' => 'painter'], 'pet' => 'fish'],
    (object)['person' => (object)['name' => 'Bob', 'job' => 'Breeder'], 'pet' => 'hamster'],
    (object)['person' => (object)['name' => 'Bob', 'job' => 'Bus conductor'], 'pet' => ''],
	];
	var_dump(ofilter($a, ['pet' => 'hamster', 'size']));
	 */
	function ofilter($array, $properties)
	{
		if (empty($array)) {
			return;
		}
		if (is_string($properties)) {
			$properties = [$properties];
		}
		$isValid = function ($obj, $propKey, $propVal) {
			if (is_int($propKey)) {
				if (!property_exists($obj, $propVal) || empty($obj->{$propVal})) {
					return false;
				}
			} else {
				if (!property_exists($obj, $propKey)) {
					return false;
				}
				if (is_callable($propVal)) {
					return call_user_func($propVal, $obj->{$propKey});
				}
				if (strtolower($obj->{$propKey}) != strtolower($propVal)) {
					return false;
				}
			}
			return true;
		};
		return array_filter($array, function ($v) use ($properties, $isValid) {
			foreach ($properties as $propKey => $propVal) {
				if (is_array($propVal)) {
					$prop = array_shift($propVal);
					if (!property_exists($v, $prop)) {
						return false;
					}
					reset($propVal);
					$key = key($propVal);
					if (!$isValid($v->{$prop}, $key, $propVal[$key])) {
						return false;
					}
				} else {
					if (!$isValid($v, $propKey, $propVal)) {
						return false;
					}
				}
			}
			return true;
		});
	}

	function sum_index($arr, $col_name)
	{
		$sum = 0;
		foreach ($arr as $item) {
			$sum += $item[$col_name];
		}
		return $sum;
	}
}