# xtractor.io-sdk-php

## Requirements ##

  - PHP 5.3.0 or above
  - enabled cURL extension
  - enabled fileinfo extension

## Setup ##

1. Create an access token with [xtractor.io API console] (https://console.xtractor.io). 
2. Clone git repository to your local project folder and include autoload file into your project.

## Basic Usage ##

    <?php
      namespace Xtractor;
      require_once realpath(__DIR__ . '/../') . '/src/Xtractor/autoload.php';
      
      $sourceFile = <fullpath_to_my_file>;
      
      $xtractorClient = new Client();
      $xtractorClient->setAccessToken('ACCESS_TOKEN');
      
      //Call upload method
      $responseObject = $xtractorClient->upload($sourceFile);
      
      //response object contains all extracted information
      print_r($responseObject);

## License ##

The MIT License (MIT)

Copyright (c) 2015 organize.me GmbH

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