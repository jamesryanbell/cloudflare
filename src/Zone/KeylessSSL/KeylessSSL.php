<?php

namespace JamesRyanBell\Cloudflare\Zone\KeylessSSL;

use JamesRyanBell\Cloudflare\Zone\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Keyless SSL for a Zone
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class KeylessSSL extends Zone
{
    protected $permissionLevel = [
        'read' => '#ssl:read',
        'edit' => '#ssl:edit',
    ];

    /**
     * List Keyless SSLs (permission needed: #ssl:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function certificates($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/keyless_certificates');
    }

    /**
     * Keyless SSL details (permission needed: #ssl:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     *
     * @return array|mixed
     */
    public function details($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/keyless_certificates/'.$identifier);
    }

    /**
     * Create a Keyless SSL configuration (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $certificate    The zone's SSL certificate or certificate and the intermediate(s)
     * @param string $host           The keyless SSL hostname
     * @param int    $port           The keyless SSL port used for CloudFlare <=> client's Keyless SSL server comm
     * @param string $name           The keyless SSL name
     * @param string $certificate    The zone's SSL certificate or SSL certificate and intermediate(s)
     *
     * @return array|mixed
     */
    public function create($zoneIdentifier, $host, $port, $name, $certificate)
    {
        $data = [
            'host' => $host,
            'port' => $port,
            'name' => $name,
            'certificate' => $certificate,
        ];

        return $this->post('zones/'.$zoneIdentifier.'/keyless_certificates', $data);
    }

    /**
     * Update SSL configuration (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     * @param string $host           The keyless SSL hostname
     * @param string $name           The keyless SSL name
     * @param int    $port           The keyless SSL port used for CloudFlare <=> client's Keyless SSL server comm
     * @param bool   $enabled        Whether or not the Keyless SSL is on or off
     *
     * @return array|mixed
     */
    public function update($zoneIdentifier, $identifier, $host, $name, $port, $enabled = false)
    {
        $data = [
            'host' => $host,
            'port' => $port,
            'name' => $name,
            'enabled' => $enabled,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/keyless_certificates/'.$identifier, $data);
    }

    /**
     * Delete an SSL certificate (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     *
     * @return array|mixed
     */
    public function delete($zoneIdentifier, $identifier)
    {
        return $this->delete('zones/'.$zoneIdentifier.'/keyless_certificates/'.$identifier);
    }
}
