<?php

namespace Cloudflare;

/**
 * CloudFlare API wrapper
 *
 * A work in progress library for the Cloudflare API. The documentation for the API can be found at https://www.cloudflare.com/docs/.
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Api
{
    /**
     * Holds the provided email address for API authentication
     *
     * @var string
     */
    public $email;

    /**
     * Holds the provided auth_key for API authentication
     *
     * @var string
     */
    public $auth_key;

    /**
     * Holds the request object to perform API requests
     *
     * @var RequestInterface
     */
    public $request;

    /**
     * Holds the curl options
     *
     * @var array
     */
    public $curl_options;

    /**
     * Make a new instance of the API client
     * This can be done via providing the email address and api key as seperate parameters
     * or by passing in an already instantiated object from which the details will be extracted
     */
    public function __construct()
    {
        $num_args = func_num_args();
        if ($num_args === 1) {
            $parameters = func_get_args();
            $client = $parameters[0];
            $this->email = $client->email;
            $this->auth_key = $client->auth_key;
            $this->request = $client->request;
            $this->curl_options = $client->curl_options;
        } elseif ($num_args === 2) {
            $parameters = func_get_args();
            $this->email = $parameters[0];
            $this->auth_key = $parameters[1];
        }

        if ($this->request === null) {
            $this->request = new Request();
        }
    }

    /**
     * Setter to allow the setting of the email address
     *
     * @param string $email The email address associated with the Cloudflare account
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Setter to allow the setting of the Authentication Key
     *
     * @param string $token Authentication key, this can be retrieve from the 'My Account' section of the Cloudflare account
     */
    public function setAuthKey($token)
    {
        $this->auth_key = $token;
    }

    /**
     * Setter to change request object
     *
     * @param RequestInterface $request The request object to perform API requests
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Setter to allow the adding / changing of the Curl options that will be used within the HTTP requests
     *
     * @param int   $key   The CURLOPT_XXX option to set e.g. CURLOPT_TIMEOUT
     * @param mixed $value The value to be set on option e.g. 10
     */
    public function setCurlOption($key, $value)
    {
        $this->curl_options[$key] = $value;
    }

    /**
     * API call method for sending requests using GET
     *
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     *
     * @return mixed
     */
    public function get($path, array $data = null)
    {
        return $this->request($path, $data, 'get');
    }

    /**
     * API call method for sending requests using POST
     *
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     *
     * @return mixed
     */
    public function post($path, array $data = null)
    {
        return $this->request($path, $data, 'post');
    }

    /**
     * API call method for sending requests using PUT
     *
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     *
     * @return mixed
     */
    public function put($path, array $data = null)
    {
        return $this->request($path, $data, 'put');
    }

    /**
     * API call method for sending requests using DELETE
     *
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     *
     * @return mixed
     */
    public function delete($path, array $data = null)
    {
        return $this->request($path, $data, 'delete');
    }

    /**
     * API call method for sending requests using PATCH
     *
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     *
     * @return mixed
     */
    public function patch($path, array $data = null)
    {
        return $this->request($path, $data, 'patch');
    }

    /**
     * @codeCoverageIgnore
     *
     * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH
     *
     * @param string      $path   Path of the endpoint
     * @param array|null  $data   Data to be sent along with the request
     * @param string|null $method Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
     *
     * @throws \Cloudflare\Exception\UnauthorizedException
     * @throws \Cloudflare\Exception\AuthenticationException
     *
     * @return mixed
     */
    protected function request($path, array $data = null, $method = null)
    {
        return $this->request->perform($this, $path, $data, $method);
    }
}
