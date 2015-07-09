<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/autoload.php';
}

/**
 * Class Xtractor_Client
 *
 * This class is the gateway to our api.
 * Here are all supported api methods declared.
 */
class Xtractor_Client extends Xtractor_Client_Base
{
  /**
   * @param null $apiUrl
   *
   * A user can override default api url. Further explanations:
   * Xtractor_Client_Base::_setApiUrl
   */
  public function __construct($apiUrl = null) {
    parent::__construct($apiUrl);
  }

  /**
   * @param $filePath
   * @param array $extractors
   * @return Xtractor_Http_Response
   * @throws Xtractor_Exception
   * @throws Xtractor_Http_Exception
   *
   * This method uploads a file to our api and returns the response body
   * from that request.
   *
   * A user can define used extractors as an array of strings.
   */
  public function upload($filePath, $extractors = array())
  {
    if ( !Xtractor_Utils_Files::isValidFileType($filePath) ) {
      throw new Xtractor_Exception('Invalid file type.');
    }

    //Set Method
    $this->setRequestMethod('POST');

    //Set Postfields
    $this->_body->addField('extractors', $extractors);
    $this->_body->addField('file', $filePath);

    //Set Options
    $this->_options->addOption(CURLOPT_SSL_VERIFYPEER, false);
    $this->_options->addOption(CURLOPT_CONNECTTIMEOUT, 60);
    $this->_options->addOption(CURLOPT_TIMEOUT, 60);

    return $this->executeRequest();
  }
}
