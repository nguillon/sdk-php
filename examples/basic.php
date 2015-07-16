<?php
namespace Xtractor;

require_once realpath(__DIR__ . '/../') . '/src/Xtractor/autoload.php';

try {
    $xtractorClient = new Client();
    $xtractorClient->setAccessToken('ACCESS_TOKEN');

    //Optional
    $xtractorClient->setApiVersion('1.1.0');
    $xtractorClient->disableSSLVerification();

    $sourceFile = realpath(__DIR__) . '/files/example.pdf';
    $response = $xtractorClient->upload($sourceFile);

    print_r( $response->getData() );

} catch (Exception $e) {
    print $e->getMessage() . "\n";
    print $e->getTraceAsString() . "\n";
}
