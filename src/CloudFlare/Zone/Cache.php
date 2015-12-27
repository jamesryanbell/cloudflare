<?php

namespace Cloudflare\Zone;

use Cloudflare\Api;
use Cloudflare\Zone;

/**
 * CloudFlare API wrapper
 *
 * Cache
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Cache extends Zone
{
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => '#zone:read', 'edit' => '#zone:edit');

    /**
     * Purge all files (permission needed: #zone:edit)
     * Remove ALL files from CloudFlare's cache
     * @param string        $identifier        API item identifier tag
     * @param boolean|null  $purge_everything  A flag that indicates all resources in CloudFlare's cache should be removed.
     *                                         Note: This may have dramatic affects on your origin server load after performing this action. (true)
     */
    public function purge($identifier, bool $purge_everything = null)
    {
        $data = array(
            'purge_everything' => $purge_everything
        );
        return $this->delete('zones/' . $identifier . '/purge_cache', $data);
    }

    /**
     * Purge individual files (permission needed: #zone:edit)
     * Remove one or more files from CloudFlare's cache
     * @param string     $identifier API item identifier tag
     * @param array|null $files      An array of URLs that should be removed from cache
     * @param array|null $tags       Any assets served with a Cache-Tag header that matches one of the provided values will be purged from the CloudFlare cache
     */
    public function purge_files($identifier, array $files = null, array $tags = null)
    {
        $data = array(
            'files' => $files,
            'tags'  => $tags
        );
        return $this->delete('zones/' . $identifier . '/purge_cache', $data);
    }
}
