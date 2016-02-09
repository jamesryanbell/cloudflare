<?php

namespace Cloudflare;

use Cloudflare\User;
use \Exception;

/**
 * CloudFlare API wrapper
 *
 * A work in progress library for the Cloudflare API. The documentation for the API can be found at https://www.cloudflare.com/docs/.
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Api
{
    /**
     * Endpoint for a hosting partner
     */
    const ENDPOINT_HOSTING_PARTNER = 'https://api.cloudflare.com/host-gw.html';
    /**
     * Default API endpoint
     */
    const ENDPOINT_DEFAULT = 'https://api.cloudflare.com/client/v4/%s';
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => null, 'edit' => null);

    /**
     * Holds the provided email address for API authentication
     * @var string
     */
    public $email;

    /**
     * olds the provided auth_key for API authentication
     * @var string
     */
    public $auth_key;

    /**
     * Holds the curl options
     * @var array
     */
    public $curl_options;

    /**
     * Holds the users permission levels
     * @var null|array
     */
    private $permissions = null;

    /**
     * Default API endpoint
     */
    protected $endpoint = self::ENDPOINT_DEFAULT;

    /**
     * Make a new instance of the API client
     * This can be done via providing the email address and api key as seperate parameters
     * or by passing in an already instantiated object from which the details will be extracted
     *
     * Signature 1:
     * @param $arg1 Object client object
     *
     * Signature 2:
     * @param $arg1 string hosting partner key
     *
     * Signature 3:
     * @param $arg1 string user email
     * @param $arg2 string user auth key
     */
    public function __construct($arg1, $arg2 =  null, $arg3 = null)
    {
        if (is_object($arg1)) {
            $this->email = $arg1->email;
            $this->auth_key = $arg1->auth_key;
            $this->curl_options = $arg1->curl_options;
            $this->permissions = $arg1->permissions;
        } else if (is_null($arg2)) {
            $this->auth_key = $arg1;
            $this->endpoint = self::ENDPOINT_HOSTING_PARTNER;
        } else {
            if (false !== strpos($arg2, '@')) {
                // reversed arguments
                $this->email = $arg2;
                $this->auth_key = $arg1;
            } else {
                $this->email = $arg1;
                $this->auth_key = $arg2;
            }

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
    public function setCurlOption($key, $value)
    {
        $this->curl_options[$key] = $value;
    }

    /**
     * API call method for sending requests using GET
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     */
    public function get($path, array $data = null)
    {
        return $this->request($path, $data, 'get', 'read');
    }

    /**
     * API call method for sending requests using POST
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     */
    public function post($path, array $data = null)
    {
        return $this->request($path, $data, 'post', 'edit');
    }

    /**
     * API call method for sending requests using PUT
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     */
    public function put($path, array $data = null)
    {
        return $this->request($path, $data, 'put', 'edit');
    }

    /**
     * API call method for sending requests using DELETE
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     */
    public function delete($path, array $data = null)
    {
        return $this->request($path, $data, 'delete', 'edit');
    }

    /**
     * API call method for sending requests using PATCH
     * @param string     $path Path of the endpoint
     * @param array|null $data Data to be sent along with the request
     */
    public function patch($path, array $data = null)
    {
        return $this->request($path, $data, 'patch', 'edit');
    }

    /**
     * Retrieves the users' permisison levels
     */
    public function permissions()
    {
        if(!$this->permissions) {
            $api = new User($this->email, $this->auth_key);
            $user = $api->user();
            if(!$user->result->organizations[0]) {
                $this->permissions = array('read' => true, 'write' => true);
            } else {
                $this->permissions = $user->result->organizations[0]->permissions;
            }
        }
        return $this->permissions;
    }

    /**
     * API in client mode
     *
     * @return bool
     */
    public function isClient() {
        return isset($this->email);
    }

    /**
     * API in provider mode
     *
     * @return bool
     */
    public function isProvider() {
        return !$this->isClient();
    }

    /**
     *
     * @codeCoverageIgnore
     *
     * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH
     * @param string      $path             Path of the endpoint
     * @param array|null  $data             Data to be sent along with the request
     * @param string|null $method           Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
     * @param string|null $permission_level Permission level required to preform the action
     */
    protected function request($path = null, array $data = null, $method = null, $permission_level = null)
    {
        if(!isset($this->auth_key)) {
            throw new Exception('Authentication information must be provided');
            return false;
        }
        $data = (is_null($data) ? array() : (array)$data);
        $method = (is_null($method) ? 'get' : $method);
        $permission_level = (is_null($permission_level) ? 'read' : $permission_level);

        if(!$this->isProvider() && !is_null($this->permission_level[$permission_level])) {
            if(!$this->permissions) {
                $this->permissions();
            }
            if(!isset($this->permissions) || !in_array($this->permission_level[$permission_level], $this->permissions)) {
                throw new Exception('You do not have permission to perform this request');
                return false;
            }
        }

        //Removes null entries
        $data = array_filter($data, function ($val) {
            return !is_null($val);
        });

        $headers = array('X-Auth-Key: ' . $this->auth_key);
        if ($this->isProvider()) {
            // no path is ever given, everything operates on host-gw.html
            $data['host_key'] = $this->auth_key;
            $data['act'] = $path;
        } else {
            $headers[] = "X-Auth-Email: " . $this->email;
        }

        $url = sprintf($this->endpoint, $path);

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
            $curl_options = array_replace($default_curl_options, $this->curl_options);
        }

        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);

        if($method === 'post') {
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($method === 'put') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
        } else if ($method === 'delete') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $headers[] = "Content-type: application/json";
        } else if ($method === 'patch') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            $headers[] = "Content-type: application/json";
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
                'error'       => $error,
                'http_code'   => $http_code,
                'method'      => $method,
                'result'      => $http_result,
                'information' => $information
            );
        } else {
            return json_decode($http_result);
        }
    }
}
