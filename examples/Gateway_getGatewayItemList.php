<?php

require_once __DIR__ . '/../xtractor.php';

$xtractorApi = new Xtractor('<YOUR_API_KEY>');
$file = __DIR__ . '/files/example.pdf';

try {
  $client = $xtractorApi->getApiClient();

  $gatewayApi = new \Swagger\Client\Api\GatewayApi($client->getApiClient());
  $payload = new \Swagger\Client\Model\GatewayItemListPayload([
      'type' => '<GATEWAY_TYPE>',
      'auth' => [
          'username' => '<YOUR_GATEWAY_USERNAME>',
          'password' => '<YOUR_GATEWAY_PASSWORD>'
      ]
  ]);
  $result = $gatewayApi->getGatewayItemList($payload);

  echo "<pre>";
  var_export($result);
  echo "</pre>";
}
catch (Swagger\Client\ApiException $e) {
  echo "<pre>\n";
  echo 'Caught exception: ', $e->getMessage(), "\n";
  echo 'HTTP status code: ', $e->getCode(), "\n";
  echo 'HTTP response headers: ', $e->getResponseHeaders(), "\n";
  echo 'HTTP response body: '; print_r($e->getResponseBody()); echo "\n";
  echo "</pre>\n";
}
