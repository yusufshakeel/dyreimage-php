# dyreimage-php
This is an image resizing project.

# Status

[![Build Status](https://travis-ci.org/yusufshakeel/dyreimage-php.svg?branch=master)](https://travis-ci.org/yusufshakeel/dyreimage-php)

# Getting started
- [Download the latest release.](https://github.com/yusufshakeel/dyreimage-php/releases)
- Clone the repo: `git clone https://github.com/yusufshakeel/dyreimage-php.git`
- Install with [Bower](https://bower.io): `bower install dyreimage-php`

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


# License

MIT License

Copyright (c) 2017 Yusuf Shakeel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
