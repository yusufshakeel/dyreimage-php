<?php
/**
 * file: Config.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dyreimage
 * date: 12-feb-2014 wed
 * description: this is the configuration file.
 */
namespace DYReImage\Core;

class Config {
	
	public static $RequiredImage = array(
			
			/**
			 * the custom image configuration
			 * @var array
			 */
			"custom" => array(
					
					// height of the image in pixels
					"height" => array(
							"default" => 100,
							"xs" => 100,	//extra small
							"sm" => 200,	//small
							"md" => 300,	//medium
							"lg" => 400,	//large
							"xl" => 500		//extra large
					),
					
					// width will be in proportion to the height
					"width" => "auto",
					
					// quality of the thumbnail image
					"quality" => 75,
					
					// allowed file extensions
					"allowedextension" => array("jpg", "jpeg", "png")
			),
			
			/**
			 * the thumbnail configurations
			 * @var array
			 */
			"thumbnail" => array(
			
					// height of the image in pixels
					"height" => array(
							"default" => 100,
							"xs" => 100,	//extra small
							"sm" => 200,	//small
							"md" => 300,	//medium
							"lg" => 400,	//large
							"xl" => 500		//extra large
					),
					
					// width will be in proportion to the height
					"width" => "auto",
					
					// quality of the thumbnail image
					"quality" => 75,
						
					// allowed file extensions
					"allowedextension" => array("jpg", "jpeg", "png")
				
			)
			
	);
	
}