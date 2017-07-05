<?php
/**
 * file: Helper.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage-php
 * date: 12-feb-2014 wed
 * description: this is the helper file.
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
namespace DYReImage\Core;

/**
 * The Helper class.
 */
class Helper {
	
	/**
	 * This function will merge default options with user defined options.
	 * 
	 * @param array $option
	 * @param array $defaultOption
	 * @return array
	 */
	public static function initOption($option, $defaultOption) {
		return array_merge($defaultOption, $option);
	}
		
	/**
	 * This function will return the proportional height based on the required width and
	 * dimensions of the source image.
	 *
	 * @param integer $originalWidth
	 * @param integer $originalHeight
	 * @param integer $requiredWidth
	 * @return integer
	 */
	public static function getProportionalHeight($originalWidth, $originalHeight, $requiredWidth) {
		return intval(($originalHeight / $originalWidth) * $requiredWidth);
	}
	
	/**
	 * This function will return the proportional width based on required height and
	 * dimensions of the source image.
	 * 
	 * @param integer $originalWidth
	 * @param integer $originalHeight
	 * @param integer $requiredHeight
	 * @return integer
	 */
	public static function getProportionalWidth($originalWidth, $originalHeight, $requiredHeight) {
		return intval(($originalWidth / $originalHeight) * $requiredHeight);
	}
	
	/**
	 * This function will return percent of x.
	 * 
	 * @param integer $x		This is the value. <p>Example: 100</p>
	 * @param string $percent	This is the percentage we want from the value. <p>Example: "80%" or "90.5%"</p>
	 * @return integer
	 */
	public static function getPercentageValue($x, $percent) {
		return intval($x * ($percent/100));
	}
	
}