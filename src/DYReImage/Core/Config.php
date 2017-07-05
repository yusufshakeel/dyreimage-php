<?php
/**
 * file: Config.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage-php
 * date: 12-feb-2014 wed
 * description: This is the configuration file.
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
 * The Config class
 */
class Config {
	
	/**
	 * The default options for the resizing.
	 * 
	 * @var array
	 */
	public static $defaultOption = array(
			"height" => "xs",
			"width" => "auto",
			"quality" => 75
	);
	
	/**
	 * The required image values.
	 * 
	 * @var array
	 */
	public static $RequiredImage = array(
			
			// height of the image in pixels
			"height" => array(
					"xs" => 100,	//extra small
					"sm" => 200,	//small
					"md" => 400,	//medium
					"lg" => 800,	//large
					"xl" => 1600	//extra large
			),
			
			// width will be in proportion to the height
			"width" => array(
					"auto" => "auto",	//compute width proportional to height
					"xs" => 100,	//extra small
					"sm" => 200,	//small
					"md" => 400,	//medium
					"lg" => 800,	//large
					"xl" => 1600	//extra large
			),
			
			// quality of the thumbnail image
			"quality" => 75,
				
			// allowed file extensions
			"allowedextension" => array("jpg", "jpeg", "png")
			
	);
	
}