<?php

namespace JamesRyanBell\Cloudflare;

use JamesRyanBell\Cloudflare\Http;

/**
 * CloudFlare API wrapper
 *
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Api extends Http
{
	public $email;
	public $auth_key;
	public $curl_options;

	public $client;

	/**
	 * Make a new instance of the API client
	 */
	public function __construct()
	{
		$num_args = func_num_args();
		if ($num_args === 1)
		{
			$parameters          = func_get_args();
			$this->client        = $parameters[0];
			$this->email         = $this->client->email;
			$this->auth_key      = $this->client->auth_key;
			$this->curl_options = $this->client->curl_options;
		} else if ($num_args === 2) {
			$parameters     = func_get_args();
			$this->email    = $parameters[0];
			$this->auth_key = $parameters[1];
		}
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setAuthKey($token)
	{
		$this->auth_key = $token;
	}

	public function setCurlOption($option) {
		$this->curl_options[key($option)] = current($option);
	}
}
