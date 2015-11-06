<?php

require_once __DIR__ . '/../autoload.php';

use Organizeme\Xtractor\SemanticsApi;
use Organizeme\Xtractor\ApiException;

$apiKey = '<YOUR_API_KEY>';
$file = __DIR__ . '/files/example.pdf';

try {
  $semanticsApi = new SemanticsApi();
  $semanticsApi->getApiClient()->getConfig()->addDefaultHeader('X-API-Key', $apiKey);
  $result = $semanticsApi->getDocumentSemantics($file);

  echo "<pre>\n";
  var_export($result);
  echo "</pre>\n";
}
catch (ApiException $e) {
  echo "<pre>\n";
  echo 'Caught exception: ', $e->getMessage(), "\n";
  echo 'HTTP status code: ', $e->getCode(), "\n";
  echo 'HTTP response headers: ', $e->getResponseHeaders(), "\n";
  echo 'HTTP response body: '; print_r($e->getResponseBody()); echo "\n";
  echo "</pre>\n";
}
