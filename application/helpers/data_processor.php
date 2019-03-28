<?php

if (!function_exists('de_camelize')) {
	function de_camelize(array $array)
	{
		$result = array();
		$prefix = array();
		foreach ($array as $key => $value) {
			$new_key = strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $key));
			$example = explode('_', $new_key);
			$prefix[] = $example[0];
			$result[$new_key] = $value;

		}
		if (count(array_unique($prefix)) === 1) {
			$prefixString = array_unique($prefix)[0];

		}
		return $result;
	}
}
if (!function_exists('get_path_variable')) {

	function get_path_variable($path)
	{
		$data = $this->uri->uri_to_assoc();
		// echo json_encode($data);die;
		$code = $data[$path];
		return $code;
	}
}
