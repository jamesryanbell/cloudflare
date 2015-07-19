<?php

namespace CloudFlare\Zone;

use CloudFlare\Api;

/**
 * CloudFlare API wrapper
 *
 * Railguns for a Zone
 *
 * @author  James Bell <james@james-bell.co.uk>
 * @version 1
 */
class Railgun extends Api {

	protected $permission_level = ['read' => '#zone_settings:read', 'edit' => '#zone_settings:edit'];

	/**
	 * Get available Railguns (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 */
	public function railguns($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/railguns');
	}

	/**
	 * Get Railgun details (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $identifier
	 */
	public function railgun_details($zone_identifier, $identifier) {

		return $this->get('zones/' . $zone_identifier . '/railguns/' . $identifier);
	}

	/**
	 * Connect or disconnect a Railgun (permission needed: #zone_settings:edit)
	 *
	 * @param string $identifier API item identifier tag
	 * @param bool   $connected  A flag indicating whether the given zone is connected to the Railgun [valid values: (true,false)]
	 */
	public function railgun_connected($zone_identifier, $identifier, bool $connected) {

		$data = [
			'connected' => $connected
		];

		return $this->get('zones/' . $zone_identifier . '/railguns/' . $identifier, $data);
	}

}
