<?php

namespace Cloudflare;

/**
 * CloudFlare API wrapper
 *
 * Zone
 * A Zone is a domain name along with its subdomains and other identities
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Zone extends Api
{
    protected $permission_level = array('read' => '#zone:read', 'edit' => '#zone:edit');

    /**
     * Create a zone (permission needed: #zone:edit)
     * @param string       $domain       The domain name
     * @param boolean|null $jump_start   Automatically attempt to fetch existing DNS records
     * @param int|null     $organization To create a zone owned by an organization, specify the organization parameter. Organization objects can be found in the User or User's Organizations endpoints. You must pass at least the ID of the organization.
     */
    public function create($name, bool $jump_start = null, int $organization = null)
    {
        $data = array(
            'name'         => $name,
            'jump_start'   => $jump_start,
            'organization' => $organization
        );
        return $this->post('zones', $data);
    }

    /**
     * Initiate another zone activation check (permission needed: #zone:edit)
     * @param string $identifier API item identifier tag
     */
    public function activation_check($identifier) {
        return $this->put('zones/' . $identifier . '/activation_check');
    }

    /**
     * List zones (permission needed: #zone:read)
     * List, search, sort, and filter your zones
     * @param string|null $name      A domain name
     * @param string|null $status    Status of the zone (active, pending, initializing, moved, deleted)
     * @param int|null    $page      Page number of paginated results
     * @param int|null    $per_page  Number of zones per page
     * @param string|null $order     Field to order zones by (name, status, email)
     * @param string|null $direction Direction to order zones (asc, desc)
     * @param string|null $match     Whether to match all search requirements or at least one (any) (any, all)
     */
    public function zones($name = null, $status = null, $page = null, $per_page = null, $order = null, $direction = null, $match = null)
    {
        $data = array(
            'name'      => $name,
            'status'    => $status,
            'page'      => $page,
            'per_page'  => $per_page,
            'order'     => $order,
            'direction' => $direction,
            'match'     => $match
        );
        return $this->get('zones', $data);
    }

    /**
     * Zone details (permission needed: #zone:read)
     * @param string $zone_identifier API item identifier tag
     */
    public function zone($zone_identifier)
    {
        return $this->get('zones/' . $zone_identifier);
    }

    /**
     * Pause all CloudFlare features (permission needed: #zone:edit)
     * This will pause all features and settings for the zone. DNS will still resolve
     * @param string $zone_identifier API item identifier tag
     */
    public function pause($zone_identifier)
    {
        return $this->put('zones/' . $zone_identifier . '/pause');
    }

    /**
     * Re-enable all CloudFlare features (permission needed: #zone:edit)
     * This will restore all features and settings for the zone
     * @param string $zone_identifier API item identifier tag
     */
    public function unpause($zone_identifier)
    {
        return $this->put('zones/' . $zone_identifier . '/unpause');
    }

    /**
     * Delete a zone (permission needed: #zone:edit)
     * @param string $zone_identifier API item identifier tag
     */
    public function delete_zone($zone_identifier)
    {
        return $this->delete('zones/' . $zone_identifier);
    }

}
