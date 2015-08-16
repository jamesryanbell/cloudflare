<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Api;

/**
 * CloudFlare API wrapper.
 *
 * Zone
 * A Zone is a domain name along with its subdomains and other identities
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Zone extends Api
{
    protected $permissionLevel = [
        'read' => '#zone:read',
        'edit' => '#zone:edit',
    ];

    /**
     * Create a zone (permission needed: #zone:edit).
     *
     * @param $name
     * @param bool $jumpStart    Automatically attempt to fetch existing DNS records
     * @param null $organization Organization that this zone will belong to
     *
     * @return array|mixed
     *
     * @internal param string $domain The domain name
     */
    public function create($name, $jumpStart = true, $organization = null)
    {
        $data = [
            'name' => $name,
            'jump_start' => $jumpStart,
            'organization' => $organization,
        ];

        return $this->post('zones', $data);
    }

    /**
     * List zones permission needed: #zone:read.
     *
     * List, search, sort, and filter your zones
     *
     * @param string $name      A domain name
     * @param string $status    Status of the zone (active, pending, initializing, moved, deleted)
     * @param int    $page      Page number of paginated results
     * @param int    $perPage   Number of zones per page
     * @param string $order     Field to order zones by (name, status, email)
     * @param string $direction Direction to order zones (asc, desc)
     * @param string $match     Whether to match all search requirements or at least one (any) (any, all)
     *
     * @return array|mixed
     */
    public function zones(
        $name = '',
        $status = 'active',
        $page = 1,
        $perPage = 20,
        $order = 'status',
        $direction = 'desc',
        $match = 'all'
    ) {
        $data = [
            'name' => $name,
            'status' => $status,
            'page' => $page,
            'per_page' => $perPage,
            'order' => $order,
            'direction' => $direction,
            'match' => $match,
        ];

        return $this->get('zones', $data);
    }

    /**
     * Zone details (permission needed: #zone:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function zone($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier);
    }

    /**
     * Pause all CloudFlare features (permission needed: #zone:edit).
     *
     * This will pause all features and settings for the zone. DNS will still resolve
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function pause($zoneIdentifier)
    {
        return $this->put('zones/'.$zoneIdentifier.'/pause');
    }

    /**
     * Re-enable all CloudFlare features (permission needed: #zone:edit).
     *
     * This will restore all features and settings for the zone
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function unpause($zoneIdentifier)
    {
        return $this->put('zones/'.$zoneIdentifier.'/unpause');
    }

    /**
     * Delete a zone (permission needed: #zone:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function deleteZone($zoneIdentifier)
    {
        return $this->delete('zones/'.$zoneIdentifier);
    }
}
