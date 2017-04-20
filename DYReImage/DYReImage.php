<?php
/**
 * file: DYReImage.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this file contains the image resizing class.
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
namespace DYReImage;

use DYReImage\Core\Config as Config;
use DYReImage\Core\Helper as Helper;
use DYReImage\Core\Validator as Validator;

/**
 * The dy resizing image class
 */
class DYReImage {
	
	/**
	 * This holds the path of the source image file.
	 * 
	 * @var string
	 */
	private $source;
	
	/**
	 * This holds the path of the destination image file.
	 * 
	 * @var string
	 */
	private $destination;
	
	/**
	 * This is the options array.
	 * 
	 * @var array
	 */
	private $option = array();
	
	/**
	 * This holds the detail of the source image file.
	 * 
	 * @var array
	 */
	private $sourceDetail;
	
	/**
	 * This holds the detail of the required image file.
	 * 
	 * @var array
	 */
	private $requiredImage = array();
	
	/**
	 * The constructor.
	 * 
	 * @param string $source
	 * @param string $destination
	 * @param array $option
	 */
	public function __construct($source, $destination, $option = array()) {
		
		$this->source = $source;
		$this->destination = $destination;
		$this->option = $option;
		
		$this->init();
		
	}
	
	/**
	 * This function will return the option used to resize image.
	 * 
	 * @return array
	 */
	public function getOption() {
		return $this->option;
	}
	
	/**
	 * This function will return the source image file path.
	 * 
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}
	
	/**
	 * This function will return the destination image file path.
	 * 
	 * @return string
	 */
	public function getDestination() {
		return $this->destination;
	}

	/**
	 * This function will return the detail of the source image file.
	 * 
	 * @return array
	 */
	public function getSourceDetail() {
		return $this->sourceDetail;
	}
	
	/**
	 * This function will return the detail of the required image file.
	 * 
	 * @return array
	 */
	public function getRequiredImageDetail() {
		return $this->requiredImage;
	}
	
	/**
	 * This function will initialize the variables.
	 */
	private function init() {
		
		// init option
		$this->option = Helper::initOption($this->option, Config::$defaultOption);
		
		// validate source
		if (Validator::validateSource($this->source)) {
			
			// get source image file detail
			$this->sourceDetail = getimagesize($this->source);
			
		}
		
		// validate destination
		if (Validator::validateDestination($this->destination)) {
			
			// get destination file detail
			$this->requiredImage['pathinfo'] = pathinfo($this->destination);
			
		}
		
		// validate required height
		$heightDataArr = Validator::validateHeight($this->option['height']);
		
		// if height in exact integer value
		if ($heightDataArr['type'] === "i") {
			$this->requiredImage['height'] = $heightDataArr['value'];
		}
		// if height in percentage
		else if ($heightDataArr['type'] === "%") {
			$getPercentValue = Helper::getPercentageValue(
									$this->sourceDetail[1],
									$heightDataArr['value']
								);
			$this->requiredImage['height'] = intval($getPercentValue);
		}
		
		// validate required width
		$widthDataArr = Validator::validateWidth($this->option['width']);
		
		// if width in exact integer value
		if ($widthDataArr['type'] === "i") {
			$this->requiredImage['width'] = $widthDataArr['value'];
		}
		// if width in percentage
		else if ($widthDataArr['type'] === "%") {
			$getPercentValue = Helper::getPercentageValue(
									$this->sourceDetail[0],
									$widthDataArr['value']
								);
			$this->requiredImage['width'] = intval($getPercentValue);
		}
		// if width is auto
		else if ($widthDataArr['type'] === "auto") {
			$this->requiredImage['width'] = intval(
					Helper::getProportionalWidth(
							$this->sourceDetail[0],
							$this->sourceDetail[1],
							$this->requiredImage['height']
						)
					);
		}
		
		// validate required quality
		$qualityDataArr = Validator::validateQuality($this->option['quality']);
		
		// if width in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
	}
	
	public function resize() {
		
		// resize image
		switch ($this->sourceDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($this->source);
				$resizeImage = imagecreatetruecolor($this->requiredImage['width'], $this->requiredImage['height']);
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($this->source);
				$resizeImage = imagecreatetruecolor($this->requiredImage['width'], $this->requiredImage['height']);
				imagealphablending($resizeImage, false);
				imagesavealpha($resizeImage, true);
				
				// for png quality must be between 0 to 9
				if ($this->requiredImage['quality'] > 81) {
					$this->requiredImage['quality'] = 81;
				} else if ($this->requiredImage['quality'] < 9) {
					$this->requiredImage['quality'] = 9;
				}
				$this->requiredImage['quality'] = round($this->requiredImage['quality'] / 9);
				break;
		}
		
		// copy image
		imagecopyresampled(
				$resizeImage,
				$sourceImage,
				0,
				0,
				0,
				0,
				$this->requiredImage['width'],
				$this->requiredImage['height'],
				$this->sourceDetail[0],
				$this->sourceDetail[1]
				);
		
		// save the resized image
		switch ($this->sourceDetail['mime']) {
			case 'image/jpeg':
				imagejpeg($resizeImage, $this->destination, $this->requiredImage['quality']);
				break;
				
			case 'image/png':
				imagepng($resizeImage, $this->destination, $this->requiredImage['quality']);
				break;
		}
		imagedestroy($resizeImage);
		imagedestroy($sourceImage);
		
	}
	
}