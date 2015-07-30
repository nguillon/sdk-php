<?php

require_once realpath(__DIR__ . '/../') . '/autoload.php';

$apiKey = '<YOUR_API_KEY>';
$file = __DIR__ . '/files/example.pdf';

try {
  $xtractorApi = new Swagger\Client\Api\SemanticsApi();
  $xtractorApi->getApiClient()->getConfig()->addDefaultHeader('X-API-Key', $apiKey);

  $result = $xtractorApi->documentSemantics($file);

  echo "<pre>";
  var_export($result);
  echo "</pre>";
} catch (Swagger\Client\ApiException $e) {
  echo "<pre>";
  echo 'Caught exception: ', $e->getMessage(), "\n";
  echo 'HTTP response headers: ', $e->getResponseHeaders(), "\n";
  echo 'HTTP response body: ', $e->getResponseBody(), "\n";
  echo 'HTTP status code: ', $e->getCode(), "\n";
  echo "</pre>";
}
