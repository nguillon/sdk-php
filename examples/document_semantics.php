<?php

require_once __DIR__ . '/../xtractor.php';

$xtractorApi = new Xtractor('<YOUR_API_KEY>');
$file = __DIR__ . '/files/example.pdf';

try {
  $client = $xtractorApi->getApiClient();

  $result = $client->documentSemantics($file);

  echo "<pre>";
  var_export($result);
  echo "</pre>";
}
catch (Swagger\Client\ApiException $e) {
  echo "<pre>";
  echo 'Caught exception: ', $e->getMessage(), "\n";
  echo 'HTTP response headers: ', $e->getResponseHeaders(), "\n";
  echo 'HTTP response body: ', $e->getResponseBody(), "\n";
  echo 'HTTP status code: ', $e->getCode(), "\n";
  echo "</pre>";
}
