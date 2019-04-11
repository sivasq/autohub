<?php
/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 28-03-2019 028
 * Time: 12:06
 */

defined('BASEPATH') or exit('No direct script access allowed');

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

if (!function_exists('human_filesize')) {
	/**
	 * From http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
	 *
	 * @param int    $bytes
	 * @param int    $decimals
	 * @param string $separator
	 *
	 * @return string
	 */
	function human_filesize($bytes, $decimals = 1, $separator = " ")
	{
		$size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $separator . @$size[$factor];
	}
}
if (!function_exists('rmFolder')) {
	/**
	 * Recursively Delete a Directory
	 * @param $location
	 *
	 * @return bool
	 */
	function rmFolder($location)
	{
		if (!is_dir($location)) {
			return false;
		}
		$contents = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($location, FilesystemIterator::SKIP_DOTS),
			RecursiveIteratorIterator::CHILD_FIRST
		);
		/** @var SplFileInfo $file */
		foreach ($contents as $file) {
			if (!$file->isReadable()) {
				throw new RuntimeException("{$file->getFilename()} is not readable.");
			}
			switch ($file->getType()) {
				case 'dir':
					rmFolder($file->getRealPath());
					break;
				case 'link':
					unlink($file->getPathname());
					break;
				default:
					unlink($file->getRealPath());
			}
		}
		return rmdir($location);
	}
}
if (!function_exists('copyFolder')) {
	/**
	 * Recursively Copy a Directory
	 * @param string $location
	 *
	 * @return bool
	 */
	function copyFolder(string $source, string $destination): bool
	{
		if (!is_dir($destination)) {
			mkdir($destination, 0777, true);
		}
		$contents = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
			RecursiveIteratorIterator::SELF_FIRST
		);
		foreach ($contents as $item) {
			if ($item->isDir()) {
				$destDir = $destination . DIRECTORY_SEPARATOR . $contents->getSubPathName();
				if (!is_dir($destDir)) {
					@mkdir($destDir);
				}
			} else {
				copy($item, $destination . DIRECTORY_SEPARATOR . $contents->getSubPathName());
			}
		}
		return true;
	}
}
if (!function_exists('tempFolder')) {
	/**
	 * Creates a Temporary Directory for us.
	 * @param string $prefix
	 *
	 * @return SplFileInfo
	 */
	function tempFolder(string $prefix = '', bool $deleteOnShutdown = true): SplFileInfo
	{
		$tmpFile = tempnam(sys_get_temp_dir(), $prefix);
		if (file_exists($tmpFile)) {
			unlink($tmpFile);
		}
		mkdir($tmpFile);
		if (is_dir($tmpFile)) {
			if ($deleteOnShutdown) {
				register_shutdown_function(function () use ($tmpFile) {
					rmFolder($tmpFile);
				});
			}
			return new SplFileInfo($tmpFile);
		}
	}
}
if (!function_exists('class_basename')) {
	/**
	 * Get the class "basename" of the given object / class.
	 *
	 * @param  string|object  $class
	 * @return string
	 */
	function class_basename($class)
	{
		$class = is_object($class) ? get_class($class) : $class;
		return basename(str_replace('\\', '/', $class));
	}
}
if (!function_exists('class_uses_recursive')) {
	/**
	 * Returns all traits used by a class, its subclasses and trait of their traits.
	 *
	 * @param  object|string  $class
	 * @return array
	 */
	function class_uses_recursive($class)
	{
		if (is_object($class)) {
			$class = get_class($class);
		}
		$results = [];
		foreach (array_merge([$class => $class], class_parents($class)) as $class) {
			$results += trait_uses_recursive($class);
		}
		return array_unique($results);
	}
}
