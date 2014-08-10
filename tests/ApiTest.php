<?php

use JamesRyanBell\Cloudflare;

class ApiTest extends PHPUnit_Framework_TestCase {

	public function testApiClassFound()
	{
		$api = new Cloudflare\Api;
		$this->assertTrue((bool)$api);
	}

	public function testApiInitialised()
	{
		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$this->assertEquals('email@example.com', $api->email);
		$this->assertEquals('Auth Key', $api->auth_key);
	}

	public function testApiInitialisedFromPreviousObject()
	{
		$client = new Cloudflare\Api('email@example.com', 'Auth Key');
		$api = new Cloudflare\Api($client);
		$this->assertEquals('email@example.com', $api->email);
		$this->assertEquals('Auth Key', $api->auth_key);
	}

	public function testSetAuthKey()
	{
		$api = new Cloudflare\Api;
		$api->setAuthKey('Auth Key');
		$this->assertEquals('Auth Key', $api->auth_key);
	}

	public function testSetEmail()
	{
		$api = new Cloudflare\Api;
		$api->setEmail('email@example.com');
		$this->assertEquals('email@example.com', $api->email);
	}

	public function testSetCurlOption()
	{
		$api = new Cloudflare\Api;
		$api->setCurlOption(array(CURLOPT_TIMEOUT => 5));
		$this->assertArrayHasKey(CURLOPT_TIMEOUT, $api->curl_options);
		$this->assertEquals(5, $api->curl_options[CURLOPT_TIMEOUT]);
	}

}