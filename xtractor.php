<?php

require_once 'SwaggerClient-php/autoload.php';

class Xtractor
{
  /**
   * Constructor of the class
   */
  function __construct($apiKey = null)
  {
    $this->apiKey = $apiKey;
  }

  /**
   * Get the config
   * @return Configuration
   */
  public function getApiClient()
  {
    $xtractorApi = new Swagger\Client\Api\SemanticsApi();
    $xtractorApi->getApiClient()->getConfig()->addDefaultHeader('X-API-Key', $this->apiKey);

    return $xtractorApi;
  }
}
