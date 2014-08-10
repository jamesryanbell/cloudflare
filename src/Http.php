<?php

namespace JamesRyanBell\Cloudflare;

/**
 * CloudFlare API wrapper
 *
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Http
{
	protected function get($path, $data = array())
	{
		return $this->request($path, $data, 'get');
	}

	protected function post($path, $data = array())
	{
		return $this->request($path, $data, 'post');
	}

	protected function put($path, $data = array())
	{
		return $this->request($path, $data, 'put');
	}

	protected function delete($path, $data = array())
	{
		return $this->request($path, $data, 'delete');
	}

	protected function request($path, $data = array(), $method = 'get')
	{
		//Remove empty entries
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
		if(is_array($this->curl_options)) {
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		} else if ($method === 'patch') {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
			//$headers[] = "Content-type: application/json";
		} else {
			$url .= '?' . http_build_query($data);
		}
var_dump($data);
var_dump(http_build_query($data));
var_dump($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);

		$http_result = curl_exec($ch);
		$error       = curl_error($ch);
		$information = curl_getinfo($ch);
		$http_code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		var_dump($information);
		curl_close($ch);
		if ($http_code != 200) {
			return array(
				'error' => $error,
				'http_code' => $http_code
			);
		} else {
			return json_decode($http_result);
		}
	}
}
