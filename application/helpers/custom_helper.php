<?php
/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 28-03-2019 028
 * Time: 12:06
 */

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('exists')) {
	/**
	 * Formats a numbers as bytes, based on size, and adds the appropriate suffix
	 *
	 * @param    mixed    will be cast as int
	 * @param    int
	 * @return    string
	 */
	function exists($var)
	{
		if (isset($var) && $var) {
			return $var;
		} else {
			return '';
		}
	}
}
