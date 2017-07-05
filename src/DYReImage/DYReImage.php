<?php
/**
 * file: DYReImage.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage-php
 * date: 12-feb-2014 wed
 * description: This file contains the DYReImage class.
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
use DYReImage\Utilities\Resize as Resize;
use DYReImage\Utilities\Image as Image;

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
	 * This function will set the source.
	 * @param string $source
	 */
	public function setSource($source) {
		$this->source = $source;
	}
	
	/**
	 * This function will set the destination.
	 * @param string $destination
	 */
	public function setDestination($destination) {
		$this->destination = $destination;
	}
	
	/**
	 * This will set the option.
	 * @param array $option
	 */
	public function setOption($option = array()) {
		$this->option = $option;
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
			$this->sourceDetail['source'] = $this->source;
			
		}
		
		// validate destination
		if (Validator::validateDestination($this->destination)) {
			
			// get destination file detail
			$this->requiredImage['pathinfo'] = pathinfo($this->destination);
			$this->requiredImage['destination'] = $this->destination;
			
		}
		
	}
	
	/**
	 * This function will resize the image.
	 */
	public function resize() {
		
		$this->init();
		
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
		
		// if quality in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
		// now resize
		if (Resize::resize($this->sourceDetail, $this->requiredImage) !== TRUE) {
			die("Failed to resize image.");
		}
		
	}
	
	/**
	 * This function will create red image.
	 */
	public function redImage() {
		
		$this->init();
		
		// validate required quality
		$qualityDataArr = Validator::validateQuality($this->option['quality']);
		
		// if quality in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
		if (Image::redImage($this->sourceDetail, $this->requiredImage) !== TRUE) {
			die("Failed to create red image.");
		}
		
	}
	
	/**
	 * This function will create green image.
	 */
	public function greenImage() {
		
		$this->init();
		
		// validate required quality
		$qualityDataArr = Validator::validateQuality($this->option['quality']);
		
		// if quality in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
		if (Image::greenImage($this->sourceDetail, $this->requiredImage) !== TRUE) {
			die("Failed to create green image.");
		}
		
	}
	
	/**
	 * This function will create blue image.
	 */
	public function blueImage() {
		
		$this->init();
		
		// validate required quality
		$qualityDataArr = Validator::validateQuality($this->option['quality']);
		
		// if quality in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
		if (Image::blueImage($this->sourceDetail, $this->requiredImage) !== TRUE) {
			die("Failed to create blue image.");
		}
		
	}
	
	/**
	 * This function will create grayscale image.
	 */
	public function grayscaleImage() {
		
		$this->init();
		
		// validate required quality
		$qualityDataArr = Validator::validateQuality($this->option['quality']);
		
		// if quality in exact integer value
		if ($qualityDataArr['type'] === "i") {
			$this->requiredImage['quality'] = $qualityDataArr['value'];
		}
		
		if (Image::grayscaleImage($this->sourceDetail, $this->requiredImage) !== TRUE) {
			die("Failed to create grayscale image.");
		}
		
	}
	
}