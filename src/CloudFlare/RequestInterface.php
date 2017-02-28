<?php

namespace Cloudflare;

/**
 * CloudFlare API wrapper
 *
 * RequestInterface
 * The interface to perform API requests
 *
 * @author Tang Rufus <tangrufus@gmail.com>
 */
interface RequestInterface
{
    /**
     * API call method for sending requests using GET, POST, PUT, DELETE OR PATCH
     *
     * @param Api         $api    The client object
     * @param string      $path   Path of the endpoint
     * @param array|null  $data   Data to be sent along with the request
     * @param string|null $method Type of method that should be used ('GET', 'POST', 'PUT', 'DELETE', 'PATCH')
     *
     * @return mixed
     */
    public function perform($api, $path, array $data = null, $method = null);
}
