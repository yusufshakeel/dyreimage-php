<?php
/**
 * file: index.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this file contains the index page.
 * 
 * MIT License
 *
 * Copyright (c) 2017 Yusuf Shakeel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

require_once 'DYReImage/autoload.php';

$source = __DIR__ . '/image/sample.jpeg';
$destination = __DIR__ . '/image/output.png';
$option = array(
		"height" => 200,
		"width" => "auto",
		"quality" => 80
);

try {
	
	$obj = new DYReImage\DYReImage($source, $destination, $option);
	
	echo "Source: " . $obj->getSource() . "<br>";
	echo "Destination: " . $obj->getDestination() . "<br>";
	echo "Option: " . print_r($obj->getOption()) . "<br>";
	echo "SourceImageDetail: " . print_r($obj->getSourceDetail()) . "<br>";
	echo "RequiredImageDetail: " . print_r($obj->getRequiredImageDetail()) . "<br>";
	
	$obj->resize();
	
	echo "Done!";
	
} catch(\Exception $e) {
	die("Error: " . $e->getMessage());
}