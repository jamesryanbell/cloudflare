<?php

namespace JamesRyanBell\Cloudflare\Zone;

use JamesRyanBell\Cloudflare\Zone;

/**
 * CloudFlare API wrapper.
 *
 * DNS Record
 * CloudFlare DNS records
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Dns extends Zone
{
    protected $permissionLevel = [
        'read' => '#dns_records:read',
        'edit' => '#dns_records:edit',
    ];

    /**
     * Create DNS record (permission needed: #dns_records:edit).
     *
     * @param string $zoneIdentifier
     * @param string $type           DNS record type (A, AAAA, CNAME, TXT, SRV, LOC, MX, NS, SPF)
     * @param string $name           DNS record name
     * @param string $content        DNS record content
     * @param int    $ttl            Time to live for DNS record. Value of 1 is 'automatic'
     *
     * @return array|mixed
     */
    public function create($zoneIdentifier, $type, $name, $content, $ttl = 1)
    {
        $data = [
            'type' => strtoupper($type),
            'name' => $name,
            'content' => $content,
            'ttl' => $ttl,
        ];

        return $this->post('zones/'.$zoneIdentifier.'/dns_records', $data);
    }

    /**
     * List DNS Records (permission needed: #dns_records:read).
     *
     * List, search, sort, and filter a zones' DNS records.
     *
     * @param string $zoneIdentifier
     * @param string $type                   DNS record type (A, AAAA, CNAME, TXT, SRV, LOC, MX, NS, SPF)
     * @param string $name                   DNS record name
     * @param string $content                DNS record content
     * @param string $vanityNameServerRecord Flag for records created for the vanity name server feature (true, false)
     * @param int    $page                   Page number of paginated results
     * @param int    $perPage                Number of DNS records per page
     * @param string $order                  Field to order records by (type, name, content, ttl, proxied)
     * @param string $direction              Direction to order domains (asc, desc)
     * @param string $match                  Whether to match all search requirements or at least one (any) (any, all)
     *
     * @return array|mixed
     */
    public function listRecords(
        $zoneIdentifier,
        $type = 'A',
        $name = null,
        $content = null,
        $vanityNameServerRecord = null,
        $page = 1,
        $perPage = 20,
        $order = '',
        $direction = 'desc',
        $match = 'all'
    ) {
        $data = [
            'type' => $type,
            'name' => $name,
            'content' => $content,
            'vanity_name_server_record' => $vanityNameServerRecord,
            'page' => $page,
            'per_page' => $perPage,
            'order' => $order,
            'direction' => $direction,
            'match' => $match,
        ];

        return $this->get('zones/'.$zoneIdentifier.'/dns_records', $data);
    }

    /**
     * DNS record details (permission needed: #dns_records:read).
     *
     * @param string $zoneIdentifier
     * @param string $identifier     API item identifier tag
     *
     * @return array|mixed
     */
    public function details($zoneIdentifier, $identifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/dns_records/'.$identifier);
    }

    /**
     * Update DNS record (permission needed: #dns_records:edit).
     *
     * @param string $zoneIdentifier
     * @param string $identifier     API item identifier tag
     *
     * @return array|mixed
     */
    public function update($zoneIdentifier, $identifier)
    {
        return $this->put('zones/'.$zoneIdentifier.'/dns_records/'.$identifier);
    }

    /**
     * Update DNS record (permission needed: #dns_records:edit).
     *
     * @param string $zoneIdentifier
     * @param string $identifier     API item identifier tag
     *
     * @return array|mixed
     */
    public function deleteRecord($zoneIdentifier, $identifier)
    {
        return $this->delete('zones/'.$zoneIdentifier.'/dns_records/'.$identifier);
    }
}
