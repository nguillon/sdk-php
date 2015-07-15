# xtractor.io-sdk-php

# Installation #

## Requirements ##

  - PHP 5.3.0 or above
  - enabled cURL extension
  - enabled fileinfo extension

## Setup ##

### composer ###


### github ###

1. Create an access token with [xtractor.io API console] (https://console.xtractor.io). 
2. Clone git repository to your local project folder and include autoload file into your project.

### manually ###


# Usage #

## Basic Usage ##

    <?php
      namespace Xtractor;
      require_once realpath(__DIR__ . '/../') . '/src/Xtractor/autoload.php';
      
      $sourceFile = <fullpath_to_my_local_file>;
      
      $xtractorClient = new Client();
      $xtractorClient->setAccessToken('ACCESS_TOKEN');
      
      //call upload method
      $responseObject = $xtractorClient->upload($sourceFile);
      
      //response object contains all extracted information
      print_r($responseObject);

## Advanced Usage ##


# Response Object #

Every method that calls our api returns an instance of the Response class. Following methods are provided:

| Method | Description |
| --- | --- |
| getResponseCode | [HTTP status code] (https://de.wikipedia.org/wiki/HTTP-Statuscode) from cURL request.  |
| getResponseHeader | Response header information provided as associative array. |
| getResponseBody | This is the response of our api. The SDK convert response in an associative array if response header says the body is encodes JSON string. In other cases you will get the string without parsing value.  |
| getTotalTime | Welt |

# Methods #

## Methods provided by SDK ##

## Methods provided by REST API ##

## Create custom methods ##

Based on our REST API documentation you can create your own methods to combine two or more features.

# Miscellaneous #

## Run unit tests ##

1. [Install phpUnit] (https://phpunit.de/manual/current/en/installation.html) to your system
2. Open your commandline and navigate to project root
3. Run phpunit (e.g. php phpunit.phar) 

## Generate documentation ##

1. Install [phpDocumentor] (http://www.phpdoc.org/docs/latest/getting-started/installing.html)
2. Read the [instructions] (http://www.phpdoc.org/docs/latest/guides/running-phpdocumentor.html) how to run phpDocumentor on commadline
3. Open your commandline and navigate to project root
4. Following command generates the documentation:


    phpdoc -d src -t documentation --title "xtractor.io" --defaultpackagename "Xtractor" --sourcecode

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
