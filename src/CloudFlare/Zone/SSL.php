<?php

namespace CloudFlare\Zone;

use CloudFlare\Api;

/**
 * CloudFlare API wrapper
 *
 * Custom SSL for a Zone
 *
 * @author  James Bell <james@james-bell.co.uk>
 * @version 1
 */
class SSL extends Api {

	protected $permission_level = ['read' => '#ssl:read', 'edit' => '#ssl:edit'];

	/**
	 * List SSL configurations (permission needed: #ssl:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 */
	public function certificates($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/custom_certificates');
	}

	/**
	 * List SSL configuration details (permission needed: #ssl:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 */
	public function details($zone_identifier, $identifier) {

		return $this->get('zones/' . $zone_identifier . '/custom_certificates/' . $identifier);
	}

	/**
	 * Create SSL configuration (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $certificate     The zone's SSL certificate or certificate and the intermediate(s)
	 * @param string $private_key     The zone's private key
	 */
	public function create($zone_identifier, $certificate, $private_key) {

		$data = [
			'certificate' => $certificate,
			'private_key' => $private_key
		];

		return $this->post('zones/' . $zone_identifier . '/custom_certificates', $data);
	}

	/**
	 * Delete an SSL certificate (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 */
	public function delete($zone_identifier, $identifier) {

		return $this->delete('zones/' . $zone_identifier . '/custom_certificates/' . $identifier);
	}

	/**
	 * Update SSL configuration (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 * @param string $certificate     The zone's SSL certificate or certificate and the intermediate(s)
	 * @param string $private_key     The zone's private key
	 */
	public function update($zone_identifier, $identifier, $certificate, $private_key) {

		$data = [
			'certificate' => $certificate,
			'private_key' => $private_key
		];

		return $this->patch('zones/' . $zone_identifier . '/custom_certificates/' . $identifier, $data);
	}

	/**
	 * Re-prioritize SSL certificates (permission needed: #ssl:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $certificates    Array of ordered certificates
	 */
	public function prioritize($zone_identifier, $certificates) {

		$data = [
			'certificates' => $certificates
		];

		return $this->patch('zones/' . $zone_identifier . '/custom_certificates/prioritize', $data);
	}

}
