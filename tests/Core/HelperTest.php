<?php
/**
 * file: HelperTest.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: This is the Helper test file.
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

namespace DYReImage\Tests\Core;

use DYReImage\Core\Config as Config;
use DYReImage\Core\Helper as Helper;

class HelperTest extends \PHPUnit_Framework_TestCase {
	
	/**
	 * Testing whether the new options generated when no options is set by the user
	 * is equal to the default options.
	 */
	public function testInitOptionWithNoUserOption() {
		
		$option = array();
		$newOption = Helper::initOption($option, Config::$defaultOption);
		
		$this->assertTrue($newOption == Config::$defaultOption);
		
	}
	
	/**
	 * This function will test if the partially set user option is properly merged
	 * with the default options.
	 */
	public function testPartialUserOption() {
		
		$option = array(
				"height" => 200,
		);
		
		$newOption = Helper::initOption($option, Config::$defaultOption);
		
		$expectedOption = array(
				"height" => 200,
				"width" => "auto",
				"quality" => 75
		);
		
		$this->assertTrue($newOption === $expectedOption);
		
	}
	
	/**
	 * This will test the computed height for the resized image based on the original width and height
	 * and the required width of the resized image.
	 */
	public function testGetProportionalHeight() {
		
		$imageWidth = 1280;
		$imageHeight = 720;
		$resizedImageWidth = 240;
		
		$computedHeight = Helper::getProportionalHeight($imageWidth, $imageHeight, $resizedImageWidth);
		
		$this->assertEquals($computedHeight, 135);
		
	}
	
	/**
	 * This will test the computed width for the resized image based on the original width and height
	 * and the required height of the resized image.
	 */
	public function testGetProportionalWidth() {
		
		$imageWidth = 1280;
		$imageHeight = 720;
		$resizedImageHeight = 135;
		
		$computedWidth = Helper::getProportionalWidth($imageWidth, $imageHeight, $resizedImageHeight);
		
		$this->assertEquals($computedWidth, 240);
		
	}
	
	/**
	 * This will test the computed percentage value.
	 */
	public function testGetPercentageValue() {
		
		$value = 1000;
		$percent = 40;
		
		$computedValue = Helper::getPercentageValue($value, $percent);
		
		$this->assertEquals($computedValue, 400);
		
	}
	
}