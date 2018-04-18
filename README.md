# dyreimage-php
This is an image resizing project.

# Status

[![license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/yusufshakeel/dyreimage-php)
[![Build Status](https://travis-ci.org/yusufshakeel/dyreimage-php.svg?branch=master)](https://travis-ci.org/yusufshakeel/dyreimage-php)
[![npm version](https://img.shields.io/badge/npm-1.1.0-blue.svg)](https://www.npmjs.com/package/dyreimage-php)
[![Bower](https://img.shields.io/badge/bower-1.1.0-blue.svg)](https://bower.io/search/?q=dyreimage-php)

# Documentation
[Click here for the documentation.](https://www.dyclassroom.com/dyreimage-php/getting-started)

# Getting started
- [Download the latest release.](https://github.com/yusufshakeel/dyreimage-php/releases)
- Clone the repo: `git clone https://github.com/yusufshakeel/dyreimage-php.git`
- Install with [Bower](https://bower.io): `bower install dyreimage-php`
- Install with [npm](https://www.npmjs.com): `npm install dyreimage-php`
- Install using composer `composer require yusufshakeel/dyreimage-php`

# Requirement
DYReImage requires the following:
* PHP version 5.5 or higher.
* GD extension.

# Brief history
I was working on an [Image Processing Project](https://github.com/yusufshakeel/Java-Image-Processing-Project) when I was in college back in 2014. Created this project back then and then decided to make some more changes and put it on GitHub.

# What's inside
```
dyreimage-php/
├── image/
│   └── sample.jpeg
├── src/
│   └── DYReImage/
│       ├── Core/
│       │   ├── Config.php
│       │   ├── Helper.php
│       │   └── Validator.php
│       ├── Utilities/
│       │   ├── Image.php
│       │   └── Resize.php
│       ├── autoload.php
│       └── DYReImage.php
├── tests/
└── index.php
```

# How to use?
Include the ```DYReImage``` directory which is inside the ```src``` directory in your project. Now to start using it write the following code.

```
<?php
require_once 'path/to/DYReImage/autoload.php';

// path of source image file that we want to resize
$source = 'path/to/image/sample.jpeg';

// path of destination image file
// resized image will be saved in img directory by the name output.png
$destination = 'path/to/destination/img/output.png';

// options to resize image
// required image width = 400, height 200 (in pixels) and quality = 80
$option = array(
  "height" => 200,
  "width" => 400,
  "quality" => 80
);

// resize
try {
  $obj = new DYReImage\DYReImage($source, $destination, $option);
  $obj->resize();
} catch(\Exception $e) {
  die("Error: " . $e->getMessage());
}
?>
```
Note! You must have write permission in order to save the resized image in the destination directory.


# Create grayscale image
```
require_once 'path/to/DYReImage/autoload.php';

$source = 'path/to/image/sample.jpg';
$destination = 'path/to/image/output.png';
$option = array(
	"quality" => 80
);

try {
	$obj = new DYReImage\DYReImage($source, $destination, $option);
	$obj->grayscaleImage();
} catch(\Exception $e) {
	die("Error: " . $e->getMessage());
}
```


# Create red image
```
require_once 'path/to/DYReImage/autoload.php';

$source = 'path/to/image/sample.jpg';
$destination = 'path/to/image/output.png';
$option = array(
	"quality" => 80
);

try {
	$obj = new DYReImage\DYReImage($source, $destination, $option);
	$obj->redImage();
} catch(\Exception $e) {
	die("Error: " . $e->getMessage());
}
```


# Create green image
```
require_once 'path/to/DYReImage/autoload.php';

$source = 'path/to/image/sample.jpg';
$destination = 'path/to/image/output.png';
$option = array(
	"quality" => 80
);

try {
	$obj = new DYReImage\DYReImage($source, $destination, $option);
	$obj->greenImage();
} catch(\Exception $e) {
	die("Error: " . $e->getMessage());
}
```


# Create blue image
```
require_once 'path/to/DYReImage/autoload.php';

$source = 'path/to/image/sample.jpg';
$destination = 'path/to/image/output.png';
$option = array(
	"quality" => 80
);

try {
	$obj = new DYReImage\DYReImage($source, $destination, $option);
	$obj->blueImage();
} catch(\Exception $e) {
	die("Error: " . $e->getMessage());
}
```


# License

It's free and released under [MIT License](https://github.com/yusufshakeel/dyreimage-php/blob/master/LICENSE)
Copyright (c) 2017 Yusuf Shakeel

# Buy me a cup of tea

If you enjoy watching my [YouTube](https://www.youtube.com/yusufshakeel) videos and find my projects here on [GitHub](https://github.com/yusufshakeel) interesting and helpful then feel free to buy me a cup of tea or coffee. It helps in creating more :)

[Donate via PayPal](https://paypal.me/yusufshakeel)
