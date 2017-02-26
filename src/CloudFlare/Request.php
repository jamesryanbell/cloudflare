<?php

namespace Cloudflare;

use Cloudflare\Exception\AuthenticationException;
use Cloudflare\Exception\UnauthorizedException;

/**
 * CloudFlare API wrapper
 *
 * Request
 * The object to perform API requests
 *
 * @author Tang Rufus <tangrufus@gmail.com>
 */
class Request implements RequestInterface
{
    /**
     * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH
     *
     * @param Api         $api    The client object
     * @param string      $path   Path of the endpoint
     * @param array|null  $data   Data to be sent along with the request
     * @param string|null $method Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
     *
     * @throws \Cloudflare\Exception\AuthenticationException
     * @throws \Cloudflare\Exception\UnauthorizedException
     *
     * @return mixed
     */
    public function perform($api, $path, array $data = null, $method = null)
    {
        if (!isset($api->email, $api->auth_key) || false === filter_var($api->email, FILTER_VALIDATE_EMAIL)) {
            throw new AuthenticationException(
                'Authentication information must be provided'
            );
        }

        $data = (null === $data ? [] : $data);
        $method = (null === $method ? 'get' : $method);

        //Removes null entries
        $data = array_filter(
            $data,
            function ($val) {
                return null !== $val;
            }
        );

        $url = 'https://api.cloudflare.com/client/v4/'.$path;

        $default_curl_options = [
            CURLOPT_VERBOSE        => false,
            CURLOPT_FORBID_REUSE   => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER         => false,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
        ];

        $curl_options = $default_curl_options;
        if (null !== $api->curl_options && is_array($api->curl_options)) {
            $curl_options = array_replace($default_curl_options, $api->curl_options);
        }

        $user_agent = __FILE__;
        $headers = [
            "X-Auth-Email: {$api->email}",
            "X-Auth-Key: {$api->auth_key}",
            "User-Agent: {$user_agent}",
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);

        $headers[] = 'Content-type: application/json';
        $json_data = json_encode($data);

        if ($method === 'post') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        } elseif ($method === 'put') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        } elseif ($method === 'delete') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        } elseif ($method === 'patch') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        } else {
            $url .= '?'.http_build_query($data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);

        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $information = curl_getinfo($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (in_array($http_code, [401, 403], true)) {
            throw new UnauthorizedException(
                'You do not have permission to perform this request'
            );
        }

        $response = json_decode($http_result);
        if (!$response) {
            $response = new \stdClass();
            $response->success = false;
        }

        curl_close($ch);
        if ($response->success !== true) {
            $response->error = $error;
            $response->http_code = $http_code;
            $response->method = $method;
            $response->information = $information;
        }

        return $response;
    }
}
