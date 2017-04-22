<?php
/**
 * file: Validator.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: This is the validator file.
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
 * The Validator class.
 */
class Validator {
	
	/**
	 * This function will validate if the source file exists and is of valid type.
	 * Returns true if valid.
	 * 
	 * @param string $source
	 * @throws \Exception
	 * @return boolean
	 */
	public static function validateSource($source) {
		
		// check if $source set
		if (!isset($source)) {
			throw new \Exception('Source file path required.');
		}
			
		// check if file exists
		if (!file_exists($source)) {
			throw new \Exception('Source file does not exists.');
		}
		
		// check file extension is valid
		$path_parts = pathinfo($source);
		if (!in_array($path_parts['extension'], Config::$RequiredImage['allowedextension'])) {
			throw new \Exception('Invalid source file extension. [Allowed Type: ' . implode(", ", Config::$RequiredImage['allowedextension']) . ']');
		}
		
		return true;
		
	}
	
	/**
	 * This function will validate if the destination file has a valid directory and extension.
	 * Returns true if valid.
	 * 
	 * @param string $destination
	 * @throws \Exception
	 * @return boolean
	 */
	public static function validateDestination($destination) {
		
		// check if $destination set
		if (!isset($destination)) {
			throw new \Exception('Destination file path required.');
		}
			
		// get file detail
		$path_parts = pathinfo($destination);
		
		// check if directory exists
		if (!file_exists($path_parts['dirname'])) {
			throw new \Exception('Invalid destination directory path.');
		}
		
		// check file extension
		if (!in_array($path_parts['extension'], Config::$RequiredImage['allowedextension'])) {
			throw new \Exception('Invalid destination file extension. [Allowed Type: ' . implode(", ", Config::$RequiredImage['allowedextension']) . ']');
		}
				
		return true;
		
	}
	
	/**
	 * This function will validate the required image height value.
	 * 
	 * @param integer|string $height		Height of the required image. Example: 100 or "sm" or "30%"
	 * @throws \Exception
	 * @return array
	 */
	public static function validateHeight($height) {
		
		// check if data type is string
		if (gettype($height) === "string") {
			
			// check if height set to predefined value
			if (array_key_exists($height, Config::$RequiredImage['height'])) {
				return array(
						"type" => "i",
						"value" => Config::$RequiredImage['height'][$height]
				);
			}
			
			// check if height in percentage and in range (0,100] i.e., 0% < height <= 100%
			if ($height[strlen($height)-1] === "%" && preg_match("/^(0\.\d{1,}\%)|([1-9][0-9]?(\.\d{1,})?\%)|(100\%)$/", $height) == 1) {
				return array(
						"type" => "%",
						"value" => floatval(explode("%", $height)[0])
				);
			} else {
				throw new \Exception('Invalid percentage value passed for height.');
			}
			
			throw new \Exception('Invalid string value passed for height.');
			
		}
		
		// check if height is integer
		else if (gettype($height) === "integer") {
			if ($height <= 0) {
				throw new \Exception('Height must be greater than 0.');
			} else {
				return array(
						"type" => "i",
						"value" => $height
				);
			}
		}
		
		throw new \Exception('Height must be either an integer value greater than 0 or a predefined string value or in percentage.');
		
	}
	
	/**
	 * This function will validate the required image width value.
	 * 
	 * @param unknown $width	Width of the required image. Example: 100 or "sm" or "30%"
	 * @return array
	 */
	/**
	 * 
	 * @param integer|string $width
	 * @throws \Exception
	 * @return array
	 */
	public static function validateWidth($width) {
		
		// check if data type is string
		if (gettype($width) === "string") {
			
			// check if width set to predefined value
			if (array_key_exists($width, Config::$RequiredImage['width'])) {
				
				if ($width === Config::$RequiredImage['width']['auto']) {
					return array(
							"type" => "auto",
							"value" => "auto"
					);
				}
				else {
					return array(
							"type" => "i",
							"value" => Config::$RequiredImage['width'][$width]
					);
				}
			}
			
			// check if width in percentage and in range (0,100] i.e., 0% < width <= 100%
			if ($width[strlen($width)-1] === "%" && preg_match("/^(0\.\d{1,}\%)|([1-9][0-9]?(\.\d{1,})?\%)|(100\%)$/", $width) == 1) {
				return array(
						"type" => "%",
						"value" => floatval(explode("%", $width)[0])
				);
			} else {
				throw new \Exception('Invalid percentage value passed for width.');
			}
			
			throw new \Exception('Invalid string value passed for width.');
			
		}
		
		// check if width is integer
		else if (gettype($width) === "integer") {
			if ($width<= 0) {
				throw new \Exception('Width must be greater than 0.');
			} else {
				return array(
						"type" => "i",
						"value" => $width
				);
			}
		}
		
		throw new \Exception('Width must be either an integer value greater than 0 or a predefined string value or in percentage.');
		
	}
	
	/**
	 * This function will return the quality value.
	 * 
	 * @param integer|double $quality
	 * @throws \Exception
	 * @return array
	 */
	public static function validateQuality($quality) {
		
		// check data type of the $quality
		if (!in_array(gettype($quality), array("integer", "double"))) {
			throw new \Exception('Quality must be a number.');
		}
		
		// check quality range
		if ($quality> 100 || $quality<= 0) {
			throw new \Exception('Quality must be greater than 0 and less than or equal to 100.');
		}
		
		return array(
				"type" => "i",
				"value" => $quality
		);
		
	}
	
}