# xtractor.io-sdk-php

## Requirements ##

  - PHP 5.3.0 or above
  - enabled cURL extension

## Installation ##

### Composer ###

### Manually ###

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

## Documentation ##

