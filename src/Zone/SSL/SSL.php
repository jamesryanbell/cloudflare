<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Api;
use JamesRyanBell\Cloudflare\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Custom SSL for a Zone
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class SSL extends Zone
{
    protected $permissionLevel = [
        'read' => '#ssl:read',
        'edit' => '#ssl:edit',
    ];

    /**
     * List SSL configurations (permission needed: #ssl:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function certificates($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/custom_certificates');
    }

    /**
     * List SSL configuration details (permission needed: #ssl:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     *
     * @return array|mixed
     */
    public function details($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/custom_certificates/'.$identifier);
    }

    /**
     * Create SSL configuration (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $certificate    The zone's SSL certificate or certificate and the intermediate(s)
     * @param string $privateKey     The zone's private key
     *
     * @return array|mixed
     */
    public function create($zoneIdentifier, $certificate, $privateKey)
    {
        $data = [
            'certificate' => $certificate,
            'private_key' => $privateKey,
        ];

        return $this->post('zones/'.$zoneIdentifier.'/custom_certificates', $data);
    }

    /**
     * Update SSL configuration (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $identifier
     * @param string $certificate    The zone's SSL certificate or certificate and the intermediate(s)
     * @param string $privateKey     The zone's private key
     *
     * @return array|mixed
     */
    public function update($zoneIdentifier, $identifier, $certificate, $privateKey)
    {
        $data = [
            'certificate' => $certificate,
            'private_key' => $privateKey,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/custom_certificates/'.$identifier, $data);
    }

    /**
     * Re-prioritize SSL certificates (permission needed: #ssl:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $certificates   Array of ordered certificates
     *
     * @return array|mixed
     */
    public function prioritize($zoneIdentifier, $certificates)
    {
        $data = [
            'certificates' => $certificates,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/custom_certificates/prioritize', $data);
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
        return $this->delete('zones/'.$zoneIdentifier.'/custom_certificates/'.$identifier);
    }
}
