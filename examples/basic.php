<?php
namespace Xtractor;
require_once realpath( __DIR__ . '/../') . '/src/Xtractor/autoload.php';

try {
  $xtractorClient = new Client();
  //$xtractorClient->setAccessToken('ACCESS_TOKEN');
  $xtractorClient->setAccessToken('m1HHn/2Ph5H3SjIdkfEQI7szgo0Pv38T5CtlXREJwjk=');

  $sourceFile = realpath(__DIR__) . '/files/example.pdf';
  $responseObject   = $xtractorClient->upload($sourceFile);

  print_r ( $responseObject->getResponseBody() );

} catch (Exception $e) {
  print $e->getMessage() . "\n";
  print $e->getTraceAsString() . "\n";
}
