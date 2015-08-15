<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Custom Pages for a Zone
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class CustomPages extends Zone
{
    protected $permissionLevel = [
        'read' => '#zone_settings:read',
        'edit' => '#zone_settings:edit',
    ];

    /**
     * Available Custom Pages (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function customPages($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/custom_pages');
    }

    /**
     * Custom Page details (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     *
     * @return array|mixed
     */
    public function details($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/custom_pages/'.$identifier);
    }

    /**
     * Update Custom page URL (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     * @param string $url            A URL that is associated with the Custom Page.
     * @param string $state          The Custom Page state
     *
     * @return array|mixed
     */
    public function update($zoneIdentifier, $identifier, $url, $state)
    {
        $data = [
            'url' => $url,
            'state' => $state,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/custom_pages/'.$identifier, $data);
    }
}
