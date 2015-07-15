<?php
require_once realpath(__DIR__ . '/../../../src/Xtractor') . '/autoload.php';

use Xtractor\Auth;
use Xtractor\Http\Header;

class AuthBaseTest extends PHPUnit_Framework_TestCase
{
    private $authBase = null;
    private $header = null;

    public function __construct()
    {
        $this->header = new Header();
        $this->authBase = new Auth\Base($this->header);
    }

    public function testSetAccessToken()
    {
        $accessToken = 'abcedfg';

        $this->authBase->setAccessToken($accessToken);
        $this->assertEquals($accessToken, $this->authBase->getAccessToken());
        $this->assertEquals($accessToken, $this->header->getField('X-API-Key'));
    }

    public function testHasAccessToken()
    {
        $this->assertFalse($this->authBase->hasAccessToken());

        $this->authBase->setAccessToken('abcdefg');
        $this->assertTrue($this->authBase->hasAccessToken());
    }
}
