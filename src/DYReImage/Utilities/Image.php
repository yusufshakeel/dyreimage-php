<?php
/**
 * file: Image.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage-php
 * date: 12-feb-2014 wed
 * description: This is the image utility file.
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

class Image {
	
	/**
	 * This function will return the red image.
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
	 *     "destination" => "path/to/image/output.png",
	 *     "quality" => 0 < x <= 100
	 * );
	 * </pre>
	 * 
	 * @param array $sourceImageDetail
	 * @param array $requiredImageDetail
	 * @return boolean
	 */
	public static function redImage($sourceImageDetail, $requiredImageDetail) {
		
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage = imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[1]) or die('Cannot Initialize new GD image stream.');
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage= imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[0]) or die('Cannot Initialize new GD image stream.');
				
				// for png quality must be between 0 to 9
				if ($requiredImageDetail['quality'] > 81) {
					$requiredImageDetail['quality'] = 81;
				} else if ($requiredImageDetail['quality'] < 9) {
					$requiredImageDetail['quality'] = 9;
				}
				$requiredImageDetail['quality'] = round($requiredImageDetail['quality'] / 9);
				break;
		}
		
		// create red image
		for ($w = 0; $w < $sourceImageDetail[0]; $w++) {
			for ($h = 0; $h < $sourceImageDetail[1]; $h++) {
				$colorIndex = imagecolorat($sourceImage, $w, $h);
				$a = 0;
				$r = ($colorIndex >> 16) & 0xFF;
				$g = 0;
				$b = 0;
				$newColor = $a << 32 | $r << 16 | $g << 8 | $b;
				imagesetpixel($finalImage, $w, $h, $newColor);
			}
		}
		
		// save the image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				if (imagejpeg($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
				
			case 'image/png':
				if (imagepng($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
		}
		imagedestroy($finalImage) or die("Failed to free any memory associated with final image.");
		imagedestroy($sourceImage) or die("Failed to free any memory associated with source image.");
		
		return true;
				
	}
	
	/**
	 * This function will return the green image.
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
	 *     "destination" => "path/to/image/output.png",
	 *     "quality" => 0 < x <= 100
	 * );
	 * </pre>
	 *
	 * @param array $sourceImageDetail
	 * @param array $requiredImageDetail
	 * @return boolean
	 */
	public static function greenImage($sourceImageDetail, $requiredImageDetail) {
		
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage = imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[1]) or die('Cannot Initialize new GD image stream.');
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage= imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[0]) or die('Cannot Initialize new GD image stream.');
				
				// for png quality must be between 0 to 9
				if ($requiredImageDetail['quality'] > 81) {
					$requiredImageDetail['quality'] = 81;
				} else if ($requiredImageDetail['quality'] < 9) {
					$requiredImageDetail['quality'] = 9;
				}
				$requiredImageDetail['quality'] = round($requiredImageDetail['quality'] / 9);
				break;
		}
		
		// create green image
		for ($w = 0; $w < $sourceImageDetail[0]; $w++) {
			for ($h = 0; $h < $sourceImageDetail[1]; $h++) {
				$colorIndex = imagecolorat($sourceImage, $w, $h);
				$a = 0;
				$r = 0;
				$g = ($colorIndex >> 8) & 0xFF;
				$b = 0;
				$newColor = $a << 32 | $r << 16 | $g << 8 | $b;
				imagesetpixel($finalImage, $w, $h, $newColor);
			}
		}
		
		// save the image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				if (imagejpeg($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
				
			case 'image/png':
				if (imagepng($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
		}
		imagedestroy($finalImage) or die("Failed to free any memory associated with final image.");
		imagedestroy($sourceImage) or die("Failed to free any memory associated with source image.");
		
		return true;
		
	}
	
	/**
	 * This function will return the blue image.
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
	 *     "destination" => "path/to/image/output.png",
	 *     "quality" => 0 < x <= 100
	 * );
	 * </pre>
	 *
	 * @param array $sourceImageDetail
	 * @param array $requiredImageDetail
	 * @return boolean
	 */
	public static function blueImage($sourceImageDetail, $requiredImageDetail) {
		
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage = imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[1]) or die('Cannot Initialize new GD image stream.');
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage= imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[0]) or die('Cannot Initialize new GD image stream.');
				
				// for png quality must be between 0 to 9
				if ($requiredImageDetail['quality'] > 81) {
					$requiredImageDetail['quality'] = 81;
				} else if ($requiredImageDetail['quality'] < 9) {
					$requiredImageDetail['quality'] = 9;
				}
				$requiredImageDetail['quality'] = round($requiredImageDetail['quality'] / 9);
				break;
		}
		
		// create blue image
		for ($w = 0; $w < $sourceImageDetail[0]; $w++) {
			for ($h = 0; $h < $sourceImageDetail[1]; $h++) {
				$colorIndex = imagecolorat($sourceImage, $w, $h);
				$a = 0;
				$r = 0;
				$g = 0;
				$b = $colorIndex & 0xFF;
				$newColor = $a << 32 | $r << 16 | $g << 8 | $b;
				imagesetpixel($finalImage, $w, $h, $newColor);
			}
		}
		
		// save the image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				if (imagejpeg($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
				
			case 'image/png':
				if (imagepng($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
		}
		imagedestroy($finalImage) or die("Failed to free any memory associated with final image.");
		imagedestroy($sourceImage) or die("Failed to free any memory associated with source image.");
		
		return true;
		
	}
	
	/**
	 * This function will return the grayscale image.
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
	 *     "destination" => "path/to/image/output.png",
	 *     "quality" => 0 < x <= 100
	 * );
	 * </pre>
	 *
	 * @param array $sourceImageDetail
	 * @param array $requiredImageDetail
	 * @return boolean
	 */
	public static function grayscaleImage($sourceImageDetail, $requiredImageDetail) {
		
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage = imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[1]) or die('Cannot Initialize new GD image stream.');
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($sourceImageDetail['source']) or die('Error: Failed to create a new image from file or URL.');
				$finalImage= imagecreatetruecolor($sourceImageDetail[0], $sourceImageDetail[0]) or die('Cannot Initialize new GD image stream.');
				
				// for png quality must be between 0 to 9
				if ($requiredImageDetail['quality'] > 81) {
					$requiredImageDetail['quality'] = 81;
				} else if ($requiredImageDetail['quality'] < 9) {
					$requiredImageDetail['quality'] = 9;
				}
				$requiredImageDetail['quality'] = round($requiredImageDetail['quality'] / 9);
				break;
		}
		
		// create blue image
		for ($w = 0; $w < $sourceImageDetail[0]; $w++) {
			for ($h = 0; $h < $sourceImageDetail[1]; $h++) {
				$colorIndex = imagecolorat($sourceImage, $w, $h);
				$a = ($colorIndex >> 32) & 0xFF;
				$r = ($colorIndex >> 16) & 0xFF;
				$g = ($colorIndex >> 8) & 0xFF;
				$b = $colorIndex & 0xFF;
				$gray = intval(($r + $g + $b) / 3);
				$newColor = $a << 32 | $gray<< 16 | $gray<< 8 | $gray;
				imagesetpixel($finalImage, $w, $h, $newColor);
			}
		}
		
		// save the image
		switch ($sourceImageDetail['mime']) {
			case 'image/jpeg':
				if (imagejpeg($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
				
			case 'image/png':
				if (imagepng($finalImage, $requiredImageDetail['destination'], $requiredImageDetail['quality']) === FALSE) {
					die("Failed to save image to file.");
				}
				break;
		}
		imagedestroy($finalImage) or die("Failed to free any memory associated with final image.");
		imagedestroy($sourceImage) or die("Failed to free any memory associated with source image.");
		
		return true;
		
	}
	
}