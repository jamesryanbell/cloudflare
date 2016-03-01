<?php

namespace Cloudflare;

/**
 * CloudFlare API wrapper
 *
 * Railguns
 * CloudFlare Railgun
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Railguns extends Api
{
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => '#railgun:read', 'edit' => '#railgun:edit');

    /**
     * Create Railgun (permission needed: #railgun:edit)
     * @param string $name Readable identifier of the railgun
     */
    public function create($name)
    {
        $data = array(
            'name' => $name
        );
        return $this->post('railguns', $data);
    }

    /**
     * List Railguns (permission needed: #railgun:read)
     * List, search, sort and filter your Railguns
     * @param int|null     $page      Page number of paginated results
     * @param int|null     $per_page  Number of items per page
     * @param string|null  $direction Direction to order Railguns (asc, desc)
     */
    public function railguns($page = null, $per_page = null, $direction = null)
    {
        $data = array(
            'page'      => $page,
            'per_page'  => $per_page,
            'direction' => $direction
        );
        return $this->get('railguns', $data);
    }

    /**
     * Railgun details (permission needed: #railgun:read)
     * @param string $identifier API item identifier tag
     */
    public function details($identifier)
    {
        return $this->get('railguns/' . $identifier);
    }

    /**
     * Get zones connected to a Railgun (permission needed: #railgun:read)
     * The zones that are currently using this Railgun
     * @param string $identifier API item identifier tag
     */
    public function zones($identifier)
    {
        return $this->get('railguns/' . $identifier . '/zones');
    }

    /**
     * Enable or disable a Railgun (permission needed: #railgun:edit)
     * Enable or disable a Railgun for all zones connected to it
     * @param string    $zone_identifier API item identifier tag
     * @param bool|null $enabled         Flag to determine if the Railgun is accepting connections
     */
    public function enabled($zone_identifier, bool $enabled = null)
    {
        $data = array(
            'enabled' => $enabled
        );
        return $this->patch('railguns/' . $identifier, $data);
    }

    /**
     * Delete Railgun (permission needed: #railgun:edit)
     * Disable and delete a Railgun. This will immediately disable the Railgun for any connected zones
     * @param string $identifier API item identifier tag
     */
    public function delete_railgun($identifier)
    {
        return $this->delete('railguns/' . $identifier);
    }

}
