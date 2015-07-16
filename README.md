# xtractor.io-sdk-php

# Installation #

## Requirements ##

  - PHP 5.5.0 or above
  - enabled cURL extension
  - enabled fileinfo extension

## Setup ##

### github ###

1. Create an access token with [xtractor.io API console] (https://console.xtractor.io). 
2. Clone git repository to your local project folder.
3. Open commandline and navigate to the directory where you placed the SDK.
4. Run *composer install* . All dependencies for our SDK will be downloaded.
5. Include our autoload file into your project.

### manually ###
1. Download zip-file of project from github.
2. Unzip the file in a subdirectory of your local project directory
3. Open commandline and navigate to the directory where you have unzipped SDK.
4. Run *composer install* . All dependencies for our SDK will be downloaded.
5. Include our autoload file into your project.

# Usage #

## Basic Usage ##

```php
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
```

# Response Object #

Every method that calls our api returns an instance of the Result class. This class provides methods to handle
the result in your application. Following methods are available.

| Method | Description |
| --- | --- |
| hasError | Returns TRUE if an error occurred, otherwise FALSE. (e.g. an error occurs if an invalid access token is used)   |
| getErrorCode | Returns the [HTTP status code] (https://de.wikipedia.org/wiki/HTTP-Statuscode) from response.  |
| getErrorMessage | Returns the current error message |
| getError | Returns an object with the public properties "code" and "message".  |
| getData | Returns the api result. |

# Methods #

## Methods provided by SDK ##

The following methods are currently provided out-of-the-box:


### upload(string $file[, array $extractors]) ###


The upload method pushes a local file to our api and returns meta information and semantic result about the sent document.   

| Parameter | Required | Type | Description |
| --- | --- | --- | --- |
| file | yes | string | Ths string represents the local file you want to upload. For more information, read the [official documentation] (https://console.xtractor.io/#/api/docs) |
| extractors | no | array | Extractors limits the response object to your desired data. If you want to get only payment data from your document you have control with this parameter. For more information, read the [official documentation] (https://console.xtractor.io/#/api/docs) | 

#### Response ####

    [See the official documentation] (https://console.xtractor.io/#/api/docs)

#### Example ####

```php
$xtractorClient = new Client();
$xtractorClient->setAccessToken('ACCESS_TOKEN');

$sourceFile = realpath(__DIR__) . '/files/example.pdf';
$response = $xtractorClient->upload($sourceFile, ['payment', 'types']);

print_r( $response->getData() );
```

## Methods provided by REST API ##

Our REST API may provide more methods than implemented in the SDK. In the next topic we will show you how to use this 
SDK to work with "unsupported" methods. 

You can find an overview of our REST API on our [homepage.] (https://console.xtractor.io/#/api/docs)

## Create custom methods ##

Based on our REST API documentation you can create your own methods. Basically the source code is the same like in our Client.php. If you look at this file it's easy to see how to use methods and settings to build your own set of methods.

```php
<?php
  //Require the autoload path of our SDK
  require_once realpath( __DIR__ ) . '/xtractor-sdk/autoload.php';

  //You must set the ClientBase class, because you have to extend your class with this one
  use Xtractor\Client\Base;


  class MyCustomClient extends Base
  {
    public function myCustomMethod($parameters = array())
    {
      //Here you can add checks for your method parameters
      //Maybe our Utils classes helps you with that but this
      //is not required.

      //Every REST API Url is built of base uri and a route (see documentation)
      //here you have to define the route you want to use.
      $this->setApiRoute('/');

      //Every REST API method is built on a expected request type. The default is "GET"
      //but we recommend to set this manually.
      $this->setRequestMethod('POST');

      //To authenticate your api request or set other header information you have to set them
      //here. Every method needs at least this three headers.
      $this->addHeader('Accept', 'application/json');
      $this->addHeader('X-API-Key', $this->getAccessToken());

      //By default we use the newest api version. But if a user of your method want to use
      //a specific version of the api you should insert this code to enable that behavior.
      if (!empty($this->getApiVersion())) {
          $this->addHeader('Accept-Version', $this->getApiVersion());
      }

      //Here you can set the parameters the REST API method needs. Maybe there are methods 
      //that don't need any parameter, than you can skip this.
      $this->addParameter('extractors', $extractors);
      $this->addParameter('file', $filePath);

      //This call is required. If you don't implement this your method won't call against our api.
      //You won't get any result ;)
      $response = $this->executeRequest();
      return $this->buildResultObject($response);
    }
}
```

# Miscellaneous #

## Install composer ##

You need to install composer. Follow the instructions on this [website.] (https://getcomposer.org/doc/00-intro.md)

## Run Examples ##
1. Ensure you have installed all required dependencies
2. Get an access token [xtractor.io API console] (https://console.xtractor.io)
3. Replace the access token variable in example file(s) with your received access token.
4. Open your commandline and navigate to examples folder.
5. Run basic example with: *php basic.php*

## Run unit tests ##

1. Get an access token [xtractor.io API console] (https://console.xtractor.io)
2. Edit phpunit.xml and replace "ACCESS_TOKEN" with your personal access token.
3. [Install phpUnit] (https://phpunit.de/manual/current/en/installation.html) to your system
2. Open your commandline and navigate to project root
3. Run phpunit (e.g. php phpunit.phar) 

## Generate documentation ##

1. Install [phpDocumentor] (http://www.phpdoc.org/docs/latest/getting-started/installing.html)
2. Read the [instructions] (http://www.phpdoc.org/docs/latest/guides/running-phpdocumentor.html) how to run phpDocumentor on commandline
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
