<?php

namespace JamesRyanBell\Cloudflare;

use Exception;
use JamesRyanBell\Cloudflare\User\User;

/**
 * CloudFlare API wrapper.
 *
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Api
{
    protected $permissionLevel = [
        'read' => null,
        'edit' => null,
    ];

    public $email;
    public $authKey;
    public $curlOptions;
    private $permissions = null;

    /**
     * Make a new instance of the API client.
     *
     * This can be done via providing the email address and api key as separate parameters
     * or by passing in an already instantiated object from which the details will be extracted
     */
    public function __construct()
    {
        $num_args = func_num_args();
        if ($num_args === 1) {
            $parameters = func_get_args();
            $client = $parameters[0];
            $this->email = $client->email;
            $this->authKey = $client->authKey;
            $this->curlOptions = $client->curlOptions;
            $this->permissions = $client->permissions;
        } elseif ($num_args === 2) {
            $parameters = func_get_args();
            $this->email = $parameters[0];
            $this->authKey = $parameters[1];
        }
    }

    /**
     * Setter to allow the setting of the email address.
     *
     * @param string $email The email address associated with the Cloudflare account
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Setter to allow the setting of the Authentication Key.
     *
     * @param string $token Authentication key, can be retrieve from the 'My Account' section of the Cloudflare account
     */
    public function setAuthKey($token)
    {
        $this->authKey = $token;
    }

    /**
     * Setter to allow the adding / changing of the Curl options that will be used within the HTTP requests.
     *
     * @param long  $key   The CURLOPT_XXX option to set e.g. CURLOPT_TIMEOUT
     * @param mixed $value The value to be set on option e.g. 10
     */
    public function setCurlOption($key, $value)
    {
        $this->curlOptions[$key] = $value;
    }

    /**
     * API call method for sending requests using GET.
     *
     * @param string $path Path of the endpoint
     * @param array  $data Data to be sent along with the request
     *
     * @return array|mixed
     */
    public function get($path, array $data = [])
    {
        return $this->request($path, $data, 'get', 'read');
    }

    /**
     * API call method for sending requests using POST.
     *
     * @param string $path Path of the endpoint
     * @param array  $data Data to be sent along with the request
     *
     * @return array|mixed
     */
    public function post($path, array $data = [])
    {
        return $this->request($path, $data, 'post', 'edit');
    }

    /**
     * API call method for sending requests using PUT.
     *
     * @param string $path Path of the endpoint
     * @param array  $data Data to be sent along with the request
     *
     * @return array|mixed
     */
    public function put($path, array $data = [])
    {
        return $this->request($path, $data, 'put', 'edit');
    }

    /**
     * API call method for sending requests using DELETE.
     *
     * @param string $path Path of the endpoint
     * @param array  $data Data to be sent along with the request
     *
     * @return array|mixed
     */
    public function delete($path, array $data = [])
    {
        return $this->request($path, $data, 'delete', 'edit');
    }

    /**
     * API call method for sending requests using PATCH.
     *
     * @param string $path Path of the endpoint
     * @param array  $data Data to be sent along with the request
     *
     * @return array|mixed
     */
    public function patch($path, array $data = [])
    {
        return $this->request($path, $data, 'patch', 'edit');
    }

    /**
     * Fetch permissions from API and set them in the object.
     *
     * @return mixed|null Permissions
     */
    public function setPermissions()
    {
        if ($this->permissions) {
            return $this->permissions;
        }
        $api = new User($this->email, $this->authKey);
        $user = $api->user();
        if (isset($user->result->organisations) && count($user->result->organisations) > 0) {
            $this->permissions = $user->result->organizations[0]->permissions;
        }

        return $this->permissions;
    }

    /**
     * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH.
     *
     * @param string $path            Path of the endpoint
     * @param array  $data            Data to be sent along with the request
     * @param string $method          Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
     * @param string $permissionLevel Permission level required to preform the action
     *
     * @return array|mixed
     *
     * @throws Exception
     *
     * @codeCoverageIgnore
     */
    protected function request($path, array $data = [], $method = 'get', $permissionLevel = 'read')
    {
        if (!isset($this->email) || !isset($this->authKey)) {
            throw new Exception('Authentication information must be provided');
        }

        if (!is_null($this->permissionLevel[$permissionLevel])) {
            if (!$this->permissions) {
                $this->setPermissions();
            }
            if ($this->permissions && !in_array($this->permissionLevel[$permissionLevel], $this->permissions)) {
                throw new Exception('You do not have permission to perform this request');
            }
        }

        //Removes null entries
        $data = array_filter($data, function ($val) {
            return !is_null($val);
        });

        $url = 'https://api.cloudflare.com/client/v4/'.$path;

        $default_curl_options = [
            CURLOPT_VERBOSE => false,
            CURLOPT_FORBID_REUSE => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => false,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
        ];

        $curl_options = $default_curl_options;
        if (isset($this->curlOptions) && is_array($this->curlOptions)) {
            $curl_options = array_replace($default_curl_options, $this->curlOptions);
        }

        $headers = ["X-Auth-Email: {$this->email}", "X-Auth-Key: {$this->authKey}"];

        $ch = curl_init();

        curl_setopt_array($ch, $curl_options);

        if ($method === 'post') {
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif ($method === 'put') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
        } elseif ($method === 'delete') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            $headers[] = 'Content-type: application/json';
        } elseif ($method === 'patch') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            $headers[] = 'Content-type: application/json';
        } else {
            $url .= '?'.http_build_query($data);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);

        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $information = curl_getinfo($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if ($http_code != 200) {
            return [
                'error' => $error,
                'http_code' => $http_code,
                'method' => $method,
                'result' => $http_result,
                'information' => $information,
            ];
        }

        return json_decode($http_result);
    }
}
