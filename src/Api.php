<?php

namespace JamesRyanBell\Cloudflare;

use \Exception;

/**
 * CloudFlare API wrapper
 *
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Api
{
	public $email;
	public $auth_key;
	public $curl_options;

	public $client;

	/**
	 * Make a new instance of the API client
	 * This can be done via providing the email address and api key as seperate parameters
	 * or by passing in an already instantiated object from which the details will be extracted
	 */
	public function __construct()
	{
		$num_args = func_num_args();
		if ($num_args === 1)
		{
			$parameters         = func_get_args();
			$this->client       = $parameters[0];
			$this->email        = $this->client->email;
			$this->auth_key     = $this->client->auth_key;
			$this->curl_options = $this->client->curl_options;
		} else if ($num_args === 2) {
			$parameters     = func_get_args();
			$this->email    = $parameters[0];
			$this->auth_key = $parameters[1];
		}
	}

	/**
	 * Setter to allow the setting of the email address
	 * @param string $email The email address associated with the Cloudflare account
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Setter to allow the setting of the Authentication Key
	 * @param string $token Authentication key, this can be retrieve from the 'My Account' section of the Cloudflare account
	 */
	public function setAuthKey($token)
	{
		$this->auth_key = $token;
	}

	/**
	 * Setter to allow the adding / changing of the Curl options that will be used within the HTTP requests
	 * @param long $key    The CURLOPT_XXX option to set e.g. CURLOPT_TIMEOUT
	 * @param mixed $value The value to be set on option e.g. 10
	 */
	public function setCurlOption($key, $value) {
		$this->curl_options[$key] = $value;
	}

	/**
	 * API call method for sending requests using GET
	 * @param  string $path Path of the endpoint
	 * @param  array  $data Data to be sent along with the request
	 */
	public function get($path, $data = array())
	{
		return $this->request($path, $data, 'get');
	}

	/**
	 * API call method for sending requests using POST
	 * @param  string $path Path of the endpoint
	 * @param  array  $data Data to be sent along with the request
	 */
	public function post($path, $data = array())
	{
		return $this->request($path, $data, 'post');
	}

	/**
	 * API call method for sending requests using PUT
	 * @param  string $path Path of the endpoint
	 * @param  array  $data Data to be sent along with the request
	 */
	public function put($path, $data = array())
	{
		return $this->request($path, $data, 'put');
	}

	/**
	 * API call method for sending requests using DELETE
	 * @param  string $path Path of the endpoint
	 * @param  array  $data Data to be sent along with the request
	 */
	public function delete($path, $data = array())
	{
		return $this->request($path, $data, 'delete');
	}

	/**
	 *
	 * @codeCoverageIgnore
	 *
	 * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH
	 * @param  string $path   Path of the endpoint
	 * @param  array  $data   Data to be sent along with the request
	 * @param  string $method Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
	 */
	protected function request($path, $data = array(), $method = 'get')
	{
		if( !isset($this->email) || !isset($this->auth_key) ) {
			throw new Exception('Authentication information must be provided');
			return false;
		}

		//Removes empty entries
		$data = array_filter($data);

		$url = 'https://api.cloudflare.com/v4/' . $path;

		$default_curl_options = array(
			CURLOPT_VERBOSE        => false,
			CURLOPT_FORBID_REUSE   => true,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER         => false,
			CURLOPT_TIMEOUT        => 5,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_FOLLOWLOCATION => true
		);

		$curl_options = $default_curl_options;
		if(isset($this->curl_options) && is_array($this->curl_options)) {
			$curl_options = array_merge($default_curl_options, $this->curl_options);
		}

		$headers = array("X-Auth-Email: {$this->email}", "X-Auth-Key: {$this->auth_key}");

		$ch = curl_init();

		curl_setopt_array($ch, $curl_options);

		if( $method === 'post' ) {
			curl_setopt($ch, CURLOPT_POST, true);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		} else if ( $method === 'put' ) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			//curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
		} else if ( $method === 'delete' ) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		} else if ($method === 'patch') {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
			//$headers[] = "Content-type: application/json";
		} else {
			$url .= '?' . http_build_query($data);
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);

		$http_result = curl_exec($ch);
		$error       = curl_error($ch);
		$information = curl_getinfo($ch);
		$http_code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);
		if ($http_code != 200) {
			return array(
				'error'     => $error,
				'http_code' => $http_code,
				'method'    => $method
			);
		} else {
			return json_decode($http_result);
		}
	}
}
