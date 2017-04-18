<?php
/**
 * file: index.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this file contains the index page.
 */

require_once 'DYReImage/autoload.php';

$source = __DIR__ . '/image/sample.jpeg';
$destination = __DIR__ . '/image/output.png';
$option = array(
		"type" => "thumbnail",
		"height" => "sm",
		"width" => null,
		"quality" => 80
);

$obj = new DYReImage\DYReImage($source, $destination, $option);

// echo "Source: " . $obj->getSource() . "<br>";
// echo "Destination: " . $obj->getDestination() . "<br>";
// echo "ImageDetail: " . print_r($obj->getImageDetail()) . "<br>";
// echo "ImageRequired: " . print_r($obj->getRequiredImageDetail()) . "<br>";

$obj->resize();
