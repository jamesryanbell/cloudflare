<?php

use Cloudflare\Api as Api;
use Cloudflare\Exception\AuthenticationException;

class ApiTest extends PHPUnit_Framework_TestCase
{
    public function testApiClassFound()
    {
        $api = new Api();
        $this->assertTrue((bool) $api);
    }

    public function testApiInitialised()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $this->assertEquals('email@example.com', $api->email);
        $this->assertEquals('Auth Key', $api->auth_key);
    }

    public function testApiInitialisedFromPreviousObject()
    {
        $client = new Api('email@example.com', 'Auth Key');
        $api = new Api($client);
        $this->assertEquals('email@example.com', $api->email);
        $this->assertEquals('Auth Key', $api->auth_key);
    }

    public function testSetAuthKey()
    {
        $api = new Api();
        $api->setAuthKey('Auth Key');
        $this->assertEquals('Auth Key', $api->auth_key);
    }

    public function testSetEmail()
    {
        $api = new Api();
        $api->setEmail('email@example.com');
        $this->assertEquals('email@example.com', $api->email);
    }

    public function testSetCurlOption()
    {
        $api = new Api();
        $api->setCurlOption(CURLOPT_TIMEOUT, 5);
        $this->assertEquals(5, $api->curl_options[CURLOPT_TIMEOUT]);
    }

    public function testHttpNoCredentials()
    {
        $http = new Api();
        try {
            $http->get('test');
            $this->fail('Expected exception not thrown');
        } catch (Exception $e) {
            $this->assertEquals('Authentication information must be provided', $e->getMessage());
        }
    }

    public function testHttpGetMethodSet()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $result = $api->get('test');
        $this->assertEquals('get', $result->method);
    }

    public function testHttpPostMethodSet()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $result = $api->post('test');
        $this->assertEquals('post', $result->method);
    }

    public function testHttpPutMethodSet()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $result = $api->put('test');
        $this->assertEquals('put', $result->method);
    }

    public function testHttpPatchMethodSet()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $result = $api->patch('test');
        $this->assertEquals('patch', $result->method);
    }

    public function testHttpDeleteMethodSet()
    {
        $api = new Api('email@example.com', 'Auth Key');
        $result = $api->delete('test');
        $this->assertEquals('delete', $result->method);
    }

    public function testHttpRequest()
    {
        $reflectionClass = new ReflectionClass('\\Cloudflare\\Api');
        $method = $reflectionClass->getMethod('request');
        $method->setAccessible(true);

        $api = new Api('email@example.com', 'Auth Key');
        $result = $method->invoke($api, 'test');

        $this->assertEquals('get', $result->method);
    }

    public function testInvalidAuthenticationWithoutInformation()
    {
        self::setExpectedException(AuthenticationException::class);

        $api = new Api();
        $api->get('/bogus', []);
    }

    public function testInvalidAuthenticationWithInvalidParameters()
    {
        self::setExpectedException(AuthenticationException::class);

        $api = new Api('foo.domain.tld', 'KEY');
        $api->get('/bogus', []);
    }
}
