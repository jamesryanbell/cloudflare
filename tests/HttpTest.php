<?php

use JamesRyanBell\Cloudflare;
use \Exception;

class HttpTest extends PHPUnit_Framework_TestCase {

	public function testHttpClassFound()
	{
		$http = new Cloudflare\Http;
		$this->assertTrue((bool)$http);
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