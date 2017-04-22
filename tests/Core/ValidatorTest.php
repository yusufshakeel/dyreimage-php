<?php
/**
 * file: ValidatorTest.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this is the validator test file.
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

namespace DYReImage\Tests;

use DYReImage\Core\Config as Config;
use DYReImage\Core\Validator as Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * This will check whether the source file exists.
	 */
	public function testValidateSource() {
		
		$sourceFilePath = __DIR__ . '/../../image/sample.jpeg';
		$this->assertTrue(Validator::validateSource($sourceFilePath));
		
	}
	
	/**
	 * This test will validate the existance of the destination directory and valid file extension.
	 */
	public function testValidateDestination() {
		
		$destinationFilePath = __DIR__ . '/../../image/output.png';
		$this->assertTrue(Validator::validateDestination($destinationFilePath));
		
	}
	
	/**
	 * This will test integer value of height.
	 */
	public function testValidateHeight_Integer() {
		
		$height = 100;
		$expected = array(
				"type" => "i",
				"value" => 100
		);
		$this->assertTrue($expected == Validator::validateHeight($height));
		
	}
	
	/**
	 * This will test string percentage value of height.
	 */
	public function testValidateHeight_StringPercent() {
		
		$height = "40%";
		$expected = array(
				"type" => "%",
				"value" => 40
		);
		$this->assertTrue($expected == Validator::validateHeight($height));
		
	}
	
	/**
	 * This will test the predefined value for height.
	 */
	public function testValidateHeight_StringPredefineValue() {
		
		$height = "sm";
		$expected = array(
				"type" => "i",
				"value" => Config::$RequiredImage['height'][$height]
		);
		$this->assertTrue($expected == Validator::validateHeight($height));
		
	}
	
	/**
	 * This will test integer value of width.
	 */
	public function testValidateWidth_Integer() {
		
		$width = 100;
		$expected = array(
				"type" => "i",
				"value" => 100
		);
		$this->assertTrue($expected == Validator::validateWidth($width));
		
	}
	
	/**
	 * This will test string percentage value of width.
	 */
	public function testValidateWidth_StringPercent() {
		
		$width = "40%";
		$expected = array(
				"type" => "%",
				"value" => 40
		);
		$this->assertTrue($expected == Validator::validateWidth($width));
		
	}
	
	/**
	 * This will test the predefined value for width.
	 */
	public function testValidateWidth_StringPredefineValue() {
		
		$width = "sm";
		$expected = array(
				"type" => "i",
				"value" => Config::$RequiredImage['width'][$width]
		);
		$this->assertTrue($expected == Validator::validateWidth($width));
		
	}
	
	/**
	 * This will test integer value of quality.
	 */
	public function testValidateQuality_Integer() {
		
		$quality = 80;
		$expected = array(
				"type" => "i",
				"value" => 80
		);
		$this->assertTrue($expected == Validator::validateQuality($quality));
		
	}
	
}