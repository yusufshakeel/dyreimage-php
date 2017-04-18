<?php
/**
 * file: DYReImage.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this file contains the image resizing class.
 */
namespace DYReImage;

use DYReImage\Core\Config as Config;

/**
 * the dy resizing image class
 */
class DYReImage {
	
	private $source;
	private $destination;
	private $imageDetail;
	private $requiredImage = array();
	
	/**
	 * this is the constructor function.
	 * 
	 * $option = array(
	 * 	"type" => "thumbnail",
	 *  "height" => "sm",
	 *  "width" => null,
	 *	"quality" => 100
	 * );
	 * 
	 * @param string $source		path of the input image file. example: /path/to/input.png
	 * @param string $destination	path of the output image file example: /path/to/output.png
	 * @param array $option			array of options
	 * @throws \Exception
	 */
	function __construct($source, $destination, $option) {
		
		/**
		 * required image type
		 * example: thumbnail
		 */
		if (!isset($option['type'])) {
			throw new \Exception('Type required.');
		} else {
			if (!array_key_exists($option['type'], Config::$RequiredImage)) {
				throw new \Exception('Invalid Type.');
			} else {
				$this->requiredImage['type'] = $option['type'];
			}
		}
		
		/**
		 * path of the source image file
		 */
		if (!isset($source)) {
			throw new \Exception('Source file path required.');
		} else {
			
			// check if file exists
			if (!file_exists($source)) {
				throw new \Exception('Source file does not exists.');
			} else {
				$path_parts = pathinfo($source);
				if (!in_array($path_parts['extension'], Config::$RequiredImage[$this->requiredImage['type']]['allowedextension'])) {
					throw new \Exception('Invalid source file extension.');
				} else {
					$this->source = $source;
					$this->imageDetail = getimagesize($source);
				}
			}
			
		}
		
		/**
		 * path of the destination image file
		 */
		if (!isset($destination)) {
			throw new \Exception('Destination file path required.');
		} else {
			$path_parts = pathinfo($destination);
			$this->destination = $destination;
			$this->requiredImage['dirname'] = $path_parts['dirname'];
			$this->requiredImage['filename'] = $path_parts['filename'];
			$this->requiredImage['extension'] = $path_parts['extension'];
		}
		
		/**
		 * required image height
		 * example: md
		 * example: 300
		 */
		if (!isset($option['height'])) {
			
			$this->height = Config::$RequiredImage[$this->requiredImage['type']]['height']['default'];
			
		} else {
			
			// check data type
			if (gettype($option['height']) === "string") {
				
				if (array_key_exists($option['height'], Config::$RequiredImage[$this->requiredImage['type']]['height'])) {
					$this->requiredImage['height'] = Config::$RequiredImage[$this->requiredImage['type']]['height'][$option['height']];
				} else {
					throw new \Exception('Invalid string value passed for height.');
				}
				
			} else if (gettype($option['height']) === "integer") {
				if ($option['height']<= 0) {
					throw new \Exception('Height must be greater than 0.');
				} else {
					$this->requiredImage['height'] = $option['height'];
				}
			} else {
				throw new \Exception('Height must be either an integer value greater than 0 or a predefined string value.');
			}
			
		}
		
		/**
		 * required image width
		 */
		if (!isset($option['width'])) {
			// set auto width
			$this->requiredImage['width'] = intval( ($this->imageDetail[0] / $this->imageDetail[1]) * $this->requiredImage['height'] );
		} else {
			$this->requiredImage['width'] = $option['width'];
		}
		
		/**
		 * required image quality
		 * example: 75 
		 */
		if (!isset($option['quality'])) {
			// default quality
			$this->requiredImage['quality'] = Config::$RequiredImage[$this->requiredImage['type']]['quality'];
		} else {
			if (!in_array(gettype($option['quality']), array("integer", "double"))) {
				throw new \Exception('Quality must be a number.');
			} else {
				if ($option['quality'] > 100 || $option['quality'] <= 0) {
					throw new \Exception('Quality must be greater than 0 and less than or equal to 100.');
				} else {
					$this->requiredImage['quality'] = $option['quality'];
				}
			}
		}
		
	}
	
	public function getSource() {
		return $this->source;
	}
	
	public function getDestination() {
		return $this->destination;
	}
	
	public function getImageDetail() {
		return $this->imageDetail;
	}
	
	public function getRequiredImageDetail() {
		return $this->requiredImage;
	}
	
	/**
	 * this function will generate a new resized image
	 */
	public function resize() {
		
		// resize image
		switch ($this->imageDetail['mime']) {
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
				$this->imageDetail[0],
				$this->imageDetail[1]
			);
		
		// save the resized image
		switch ($this->imageDetail['mime']) {
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
	
	/**
	 * this will display the image in the browser
	 */
	public function display() {
		
		// resize image
		switch ($this->imageDetail['mime']) {
			case 'image/jpeg':
				$sourceImage = imagecreatefromjpeg($this->source);
				$resizeImage = imagecreatetruecolor($this->requiredImage['width'], $this->requiredImage['height']);
				break;
				
			case 'image/png':
				$sourceImage = imagecreatefrompng($this->source);
				$resizeImage = imagecreatetruecolor($this->requiredImage['width'], $this->requiredImage['height']);
				imagealphablending($resizeImage, false);
				imagesavealpha($resizeImage, true);
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
				$this->imageDetail[0],
				$this->imageDetail[1]
			);
		
		// display resized image
		header('Content-Type: '. $this->imageDetail['mime']);
		switch ($this->imageDetail['mime']) {
			case 'image/jpeg':
				imagejpeg($resizeImage);
				break;
				
			case 'image/png':
				imagepng($resizeImage);
				break;
		}
		imagedestroy($resizeImage);
		imagedestroy($sourceImage);
	}
	
}