<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Cache
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Cache extends Zone
{
    protected $permissionLevel = [
        'read' => '#zone:read',
        'edit' => '#zone:edit',
    ];

    /**
     * Purge all files (permission needed: #zone:edit).
     *
     * Remove ALL files from CloudFlare's cache
     *
     * @param string $identifier      API item identifier tag
     * @param bool   $purgeEverything A flag that indicates all resources in CloudFlare's cache should be removed.
     *                                Note: This may have dramatic affects on your origin server load after
     *                                performing this action. (true)
     *
     * @return array|mixed
     */
    public function purge($identifier, bool $purgeEverything = true)
    {
        $data = [
            'purgeEverything' => $purgeEverything,
        ];

        return $this->delete('zones/'.$identifier.'/purge_cache', $data);
    }

    /**
     * Purge individual files (permission needed: #zone:edit).
     *
     * Remove one or more files from CloudFlare's cache
     *
     * @param string $identifier API item identifier tag
     * @param array  $files      An array of URLs that should be removed from cache
     *
     * @return array|mixed
     */
    public function purgeFiles($identifier, array $files)
    {
        $data = [
            'files' => $files,
        ];

        return $this->delete('zones/'.$identifier.'/purge_cache', $data);
    }
}
