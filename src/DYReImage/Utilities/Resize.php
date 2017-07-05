<?php
/**
 * file: Resize.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage-php
 * date: 12-feb-2014 wed
 * description: This is the resize utility file.
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

namespace DYReImage\Utilities;

class Resize {
	
	/**
	 * This function will resize the image.
	 * 
	 * Return true on success.
	 * 
	 * $sourceImageDetail array
	 * <pre>
	 * $sourceImageDetail = array(
	 *     "0" => width of the image,
	 *     "1" => height of the image,
	 *     "2" => some value,
	 *     "3" => value like width="1920" height="1280"
	 *     "bits" => some value like 8
	 *     "channels" => some value like 3
	 *     "mime" => like "image/jpeg"
	 *     "source" => "path/to/image/source.png"
	 * );
	 * </pre>
	 * 
	 * $requiredImageDetail = array
	 * <pre>
	 * $requiredImageDetail = array(
	 *     "pathinfo" => Array
	 *     "destination" => "path/to/image/output.png"
	 *     "height" => 200
	 *     "width" => 300
	 *     "quality" => 80
	 * );
	 * </pre>
	 * 
	 * @param array $sourceImageDetail
	 * @param array $requiredImageDetail
	 * @return boolean
	 */
	public static function resize($sourceImageDetail, $requiredImageDetail) {
		
		// resize image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$resizeImage = imagecreatetruecolor($requiredImageDetail['width'], $requiredImageDetail['height']) or die('Cannot Initialize new GD image stream.');
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$resizeImage = imagecreatetruecolor($requiredImageDetail['width'], $requiredImageDetail['height']) or die('Cannot Initialize new GD image stream.');
				
				if(imagealphablending($resizeImage, false) === FALSE) {
					die("Failed to set the blending mode for an image.");
				}
				
				if (imagesavealpha($resizeImage, true) === FALSE) {
					die("Failed to set the flag to save full alpha channel information when saving PNG images.");
				}
				
				// for png quality must be between 0 to 9
				if ($requiredImageDetail['quality'] > 81) {
					$requiredImageDetail['quality'] = 81;
				} else if ($requiredImageDetail['quality'] < 9) {
					$requiredImageDetail['quality'] = 9;
				}
				$requiredImageDetail['quality'] = round($requiredImageDetail['quality'] / 9);
				break;
		}
		
		// copy image
		if(imagecopyresampled(
				$resizeImage,
				$sourceImage,
				0,
				0,
				0,
				0,
				$requiredImageDetail['width'],
				$requiredImageDetail['height'],
				$sourceImageDetail[0],
				$sourceImageDetail[1]
		) === FALSE) {
			die("Failed to copy and resize part of an image with resampling.");
		}
				
		// save the resized image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				if (imagejpeg($resizeImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
				
			case 'image/png':
				if (imagepng($resizeImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
		}
		imagedestroy($resizeImage) or die("Failed to free any memory associated with resized image.");
		imagedestroy($sourceImage) or die("Failed to free any memory associated with source image.");
		
		return true;
				
	}
	
}