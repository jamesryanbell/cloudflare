<?php
 
use JamesRyanBell\Cloudflare;
 
class CloudflareTest extends PHPUnit_Framework_TestCase {
 
  public function testApiClassFound()
  {
    $api = new Cloudflare\Api;
    $this->assertTrue((bool)$api);
  }
 
}