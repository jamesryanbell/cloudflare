<?php

namespace JamesRyanBell\Cloudflare\Zone\Railgun;

use JamesRyanBell\Cloudflare\Zone\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Railguns for a Zone
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Railgun extends Zone
{
    protected $permissionLevel = [
        'read' => '#zone_settings:read',
        'edit' => '#zone_settings:edit',
    ];

    /**
     * Get available Railguns (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function railguns($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/railguns');
    }

    /**
     * Get Railgun details (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     *
     * @return array|mixed
     */
    public function railgunDetails($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/railguns/'.$identifier);
    }

    /**
     * Connect or disconnect a Railgun (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     * @param bool   $connected      Flag indicating whether the zone is connected to the Railgun
     *
     * @return array|mixed
     */
    public function railgunConnected($zoneIdentifier, $identifier, bool $connected)
    {
        $data = [
            'connected' => $connected,
        ];

        return $this->get('zones/'.$zoneIdentifier.'/railguns/'.$identifier, $data);
    }
}
