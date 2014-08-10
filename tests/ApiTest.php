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

	public function testHttpNoCredentials()
	{
		$http = new Cloudflare\Api();
		try {
			$http->get('test');
			$this->fail("Expected exception not thrown");
		} catch(Exception $e) {
			$this->assertEquals("Authentication information must be provided", $e->getMessage());
		}
	}

	public function testHttpGetMethodSet() {
		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$result = $api->get('test');
		$this->assertEquals("get", $result['method']);
	}

	public function testHttpPostMethodSet() {
		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$result = $api->post('test');
		$this->assertEquals("post", $result['method']);
	}

	public function testHttpPutMethodSet() {
		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$result = $api->put('test');
		$this->assertEquals("put", $result['method']);
	}

	public function testHttpDeleteMethodSet() {
		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$result = $api->delete('test');
		$this->assertEquals("delete", $result['method']);
	}

	public function testHttpRequest() {
		$reflectionClass = new ReflectionClass('\\JamesryanBell\Cloudflare\\Api');
		$method = $reflectionClass->getMethod('request');
		$method->setAccessible(true);

		$api = new Cloudflare\Api('email@example.com', 'Auth Key');
		$result = $method->invoke($api, 'test');

		$this->assertEquals('get', $result['method']);
	}

}