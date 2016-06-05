<?php

namespace Cloudflare\User;

use Cloudflare\Api;
use Cloudflare\User;

/**
 * CloudFlare API wrapper
 *
 * Virtual DNS (Users)
 * User-level Virtual DNS Management
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Virtual_Dns extends Api
{
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => '#dns_records:read', 'edit' => '#dns_records:edit');

    /**
     * Get Virtual DNS Clusters (permission needed: #dns_records:read)
     * List configured Virtual DNS clusters for a user
     */
    public function clusters()
    {
        return $this->get('/user/virtual_dns');
    }

    /**
     * Create a Virtual DNS Cluster (permission needed: #dns_records:edit)
     * Create a configured Virtual DNS Cluster
     * @param string $name       Virtual DNS Cluster Name
     * @param array  $origin_ips
     * @param integer|null $minimum_cache_ttl Minimum DNS Cache TTL
     * @param integer|null $maximum_cache_ttl Maximum DNS Cache TTL
     * @param bool|null $deprecate_any_request Deprecate the response to ANY requests
     */
    public function create($name, $origin_ips, $minimum_cache_ttl = null, $maximum_cache_ttl = null, $deprecate_any_request = null)
    {
        $data = array(
            'name'                  => $name,
            'origin_ips'            => $origin_ips,
            'minimum_cache_ttl'     => $minimum_cache_ttl,
            'maximum_cache_ttl'     => $maximum_cache_ttl,
            'deprecate_any_request' => $deprecate_any_request
        );
        return $this->post('/user/virtual_dns', $data);
    }

    /**
     * Get a Virtual DNS Cluster (permission needed: #dns_records:read)
     * List a single configured Virtual DNS clusters for a user
     * @param string $identifier Identifier tag
     */
    public function cluster($identifier)
    {
        return $this->get('/user/virtual_dns/' . $identifier);
    }

    /**
     * Modify a Virtual DNS Cluster
     * Modify a Virtual DNS Cluster configuration (permission needed: #dns_records:edit)
     * @param string $identifier Identifier tag
     * @param string $name       Virtual DNS Cluster Name
     * @param array  $origin_ips
     * @param integer $minimum_cache_ttl Minimum DNS Cache TTL
     * @param integer $maximum_cache_ttl Maximum DNS Cache TTL
     * @param bool $deprecate_any_request Deprecate the response to ANY requests
     */
    public function modify($identifier, $name, $origin_ips, $minimum_cache_ttl, $maximum_cache_ttl, $deprecate_any_request)
    {
        $data = array(
            'name'                  => $name,
            'origin_ips'            => $origin_ips,
            'minimum_cache_ttl'     => $minimum_cache_ttl,
            'maximum_cache_ttl'     => $maximum_cache_ttl,
            'deprecate_any_request' => $deprecate_any_request
        );
        return $this->patch('/user/virtual_dns/' . $identifier, $data);
    }

    /**
     * Delete a Virtual DNS Cluster (permission needed: #dns_records:edit)
     * Delete a configured Virtual DNS cluster
     * @param string $identifier Identifier tag
     */
    public function delete_cluster($identifier)
    {
        return $this->delete('/user/virtual_dns/' . $identifier);
    }
}
