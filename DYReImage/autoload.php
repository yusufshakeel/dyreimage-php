<?php
/**
 * file: autoload.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this file contains the autoload.
 */

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	throw new Exception('DYReImage requires PHP version 5.3 or higher.');
}

if (!extension_loaded('gd')) {
	throw new Exception('DYReImage requires GD extension.');
}

spl_autoload_register(function ($class) {
	
	$namespace = 'DYReImage\\';
	
	$baseDir = __DIR__;
	
	// if class is not using namespace then return
	$len = strlen($namespace);
	if (strncmp($namespace, $class, $len) !== 0) {
		return;
	}
	
	// get the relative class
	$relativeClass = substr($class, $len);
	
	// find file
	$file = $baseDir . '/' . str_replace('\\', '/', $relativeClass) . '.php';
	
	// require the file if exists
	if (file_exists($file)) {
		require $file;
	}
	
});