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


    if (!$response->hasError()) {
      print_r( $response->getData() );
    } else {
        $error = $response->getError();

        print "Error code: " . $error->code . "\n";
        print "Error message: " . $error->message . "\n";

        //You can also get this as single values.

        print "Error code: " . $response->getErrorCode() . "\n";
        print "Error message: " . $response->getErrorMessage() . "\n";
    }

} catch (Exception $e) {
    print $e->getMessage() . "\n";
    print $e->getTraceAsString() . "\n";
}
