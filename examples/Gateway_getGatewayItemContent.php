<?php

require_once __DIR__ . '/../autoload.php';

use Organizeme\Xtractor\GatewayApi;
use Organizeme\Xtractor\ApiException;
use Organizeme\Xtractor\Models\GatewayItemContentPayload;

$apiKey = '<YOUR_API_KEY>';

try {
  $gatewayApi = new GatewayApi();
  $gatewayApi->getApiClient()->getConfig()->addDefaultHeader('X-API-Key', $apiKey);
  $payload = new GatewayItemContentPayload([
    'type' => '<GATEWAY_TYPE>',
    'id' => '<GATEWAY_ITEM_ID>',
    'auth' => [
      'username' => '<YOUR_GATEWAY_USERNAME>',
      'password' => '<YOUR_GATEWAY_PASSWORD>'
    ]
  ]);
  $result = $gatewayApi->getGatewayItemContent($payload);

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
