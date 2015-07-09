<?php

if (!class_exists('Xtractor_Client')) {
  require_once dirname(__FILE__) . '/autoload.php';
}

class Xtractor_Client extends Xtractor_Client_Base
{
  public function __construct($apiUrl = null) {
    parent::__construct($apiUrl);
  }

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
