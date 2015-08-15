<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Zone Plan
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Plan extends Zone
{
    protected $permissionLevel = [
        'read' => '#billing:read',
        'edit' => '#billing:edit',
    ];

    /**
     * Available plans (permission needed: #billing:read).
     *
     * List all plans the zone can subscribe to.
     *
     * @param string $zoneIdentifier
     *
     * @return array|mixed
     */
    public function available($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/plans');
    }

    /**
     * Available plans (permission needed: #billing:read).
     *
     * @param string $zoneIdentifier
     * @param string $identifier     API item identifier tag
     *
     * @return array|mixed
     */
    public function details($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/plans/'.$identifier);
    }

    /**
     * Change plan (permission needed: #billing:edit).
     *
     * Change the plan level for the zone.
     * This will cancel any previous subscriptions and subscribe the zone to the new plan.
     *
     * @param string $zoneIdentifier
     * @param string $identifier     API item identifier tag
     *
     * @return array|mixed
     */
    public function change($zoneIdentifier, $identifier)
    {
        return $this->put('zones/'.$zoneIdentifier.'/plans/'.$identifier.'/subscribe');
    }
}
