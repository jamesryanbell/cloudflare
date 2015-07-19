<?php

namespace CloudFlare\Zone;

use CloudFlare\Api;

/**
 * CloudFlare API wrapper
 *
 * Keyless SSL for a Zone
 *
 * @author  James Bell <james@james-bell.co.uk>
 * @version 1
 */
class KeylessSSL extends Api {

	protected $permission_level = ['read' => '#ssl:read', 'edit' => '#ssl:edit'];

	/**
	 * List Keyless SSLs (permission needed: #ssl:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 */
	public function certificates($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/keyless_certificates');
	}

	/**
	 * Keyless SSL details (permission needed: #ssl:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 */
	public function details($zone_identifier, $identifier) {

		return $this->get('zones/' . $zone_identifier . '/keyless_certificates/' . $identifier);
	}

	/**
	 * Create a Keyless SSL configuration (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $certificate     The zone's SSL certificate or certificate and the intermediate(s)
	 * @param string $host            The keyless SSL hostname
	 * @param int    $port            The keyless SSL port used to commmunicate between CloudFlare and the client's Keyless SSL server
	 * @param string $name            The keyless SSL name
	 * @param string $certificate     The zone's SSL certificate or SSL certificate and intermediate(s)
	 */
	public function create($zone_identifier, $host, $port, $name, $certificate) {

		$data = [
			'host' => $host,
			'port' => $port,
			'name' => $name,
			'certificate' => $certificate
		];

		return $this->post('zones/' . $zone_identifier . '/keyless_certificates', $data);
	}

	/**
	 * Delete an SSL certificate (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 */
	public function delete($zone_identifier, $identifier) {

		return $this->delete('zones/' . $zone_identifier . '/keyless_certificates/' . $identifier);
	}

	/**
	 * Update SSL configuration (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 * @param string $host            The keyless SSL hostname
	 * @param string $name            The keyless SSL name
	 * @param int    $port            The keyless SSL port used to commmunicate between CloudFlare and the client's Keyless SSL server
	 * @param bool   $enabled         Whether or not the Keyless SSL is on or off
	 */
	public function update($zone_identifier, $identifier, $host, $name, $port, $enabled = false) {

		$data = [
			'host' => $host,
			'port' => $port,
			'name' => $name,
			'enabled' => $enabled
		];

		return $this->patch('zones/' . $zone_identifier . '/keyless_certificates/' . $identifier, $data);
	}

}
