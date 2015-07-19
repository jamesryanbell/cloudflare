<?php

namespace CloudFlare\Zone;

use CloudFlare\Api;

/**
 * CloudFlare API wrapper
 *
 * Zone Settings
 *
 * @author  James Bell <james@james-bell.co.uk>
 * @version 1
 */
class Settings extends Api {

	protected $permission_level = ['read' => '#zone_settings:read', 'edit' => '#zone_settings:edit'];

	/**
	 * Zone settings (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function settings($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings');

	}

	/**
	 * Advanced DDOS setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function advanced_ddos($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/advanced_ddos');

	}

	/**
	 * Get Always Online setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function always_online($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/always_online');
	}

	/**
	 * Get Browser Cache TTL setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function browser_cache_ttl($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/browser_cache_ttl');

	}

	/**
	 * Get Browser Check setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function browser_check($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/browser_check');

	}

	/**
	 * Get Cache Level setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function cache_level($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/cache_level');

	}

	/**
	 * Get Challenge TTL setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function challenge_ttl($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/challenge_ttl');

	}

	/**
	 * Get Development Mode setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function development_mode($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/development_mode');

	}

	/**
	 * Get Email Obfuscation setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function email_obfuscation($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/email_obfuscation');

	}

	/**
	 * Get Hotlink Protection setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function hotlink_protection($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/hotlink_protection');

	}

	/**
	 * Get IP Geolocation setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function ip_geolocation($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/ip_geolocation');

	}

	/**
	 * Get IP IPv6 setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function ipv6($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/ipv6');

	}

	/**
	 * Get IP Minify setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function minify($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/minify');

	}

	/**
	 * Get Mobile Redirect setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function mobile_redirect($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/mobile_redirect');

	}

	/**
	 * Get Mirage setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function mirage($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/mirage');

	}

	/**
	 * Get Polish setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function polish($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/polish');

	}

	/**
	 * Get Rocket Loader setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function rocket_loader($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/rocket_loader');

	}

	/**
	 * Get Security Level setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function security_level($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/security_level');

	}

	/**
	 * Get Server Side Exclude setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function server_side_exclude($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/server_side_exclude');

	}

	/**
	 * Get SSL setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function ssl($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/ssl');

	}

	/**
	 * Get Web Application Firewall (WAF) setting (permission needed: #zone_settings:read)
	 *
	 * @param string $zone_identifier API item identifier tag
	 *
	 * @return array|mixed
	 */
	public function waf($zone_identifier) {

		return $this->get('zones/' . $zone_identifier . '/settings/waf');

	}

	/**
	 * Get Web Application Firewall (WAF) setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param array  $data            One or more zone setting objects. Must contain an ID and a value.
	 *
	 * @return array|mixed
	 */
	public function edit($zone_identifier, array $data) {

		return $this->patch('zones/' . $zone_identifier . '/settings', $data);

	}

	/**
	 * Change Always Online setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_always_on($zone_identifier, $value = 'on') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/always_online', $data);

	}

	/**
	 * Change Browser Cache TTL setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param int    $value           Value of the zone setting (default: 14400)
	 *
	 * @return array|mixed
	 */
	public function change_browser_cache_ttl($zone_identifier, $value = 14400) {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/browser_cache_ttl', $data);

	}

	/**
	 * Change Browser Check setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_browser_check($zone_identifier, $value = 'on') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/browser_check', $data);

	}

	/**
	 * Change Cache Level setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_cache_level($zone_identifier, $value = 'aggressive') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/cache_level', $data);

	}

	/**
	 * Change Challenge TTL setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param int    $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_challenge_ttl($zone_identifier, $value = 1800) {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/challenge_ttl', $data);

	}

	/**
	 * Change Development Mode setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_development_mode($zone_identifier, $value = 'off') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/development_mode', $data);

	}

	/**
	 * Change Email Obfuscation setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_email_obfuscation($zone_identifier, $value = 'on') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/email_obfuscation', $data);

	}

	/**
	 * Change Hotlink Protection setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_hotlink_protection($zone_identifier, $value = 'off') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/hotlink_protection', $data);

	}

	/**
	 * Change IP Geolocation setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_ip_geolocation($zone_identifier, $value = 'on') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/ip_geolocation', $data);

	}

	/**
	 * Change IP Geolocation setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_ipv6($zone_identifier, $value = 'off') {

		$data = ['value' => $value];

		return $this->patch('zones/' . $zone_identifier . '/settings/ipv6', $data);

	}

	/**
	 * Change Minify setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting
	 *
	 * @return array|mixed
	 */
	public function change_minify($zone_identifier, $value) {

		return $this->patch('zones/' . $zone_identifier . '/settings/minify', $value);

	}

	/**
	 * Change Mobile Redirect setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_mobile_redirect($zone_identifier, $value) {

		return $this->patch('zones/' . $zone_identifier . '/settings/minify', $value);

	}

	/**
	 * Change Mirage setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: off)
	 *
	 * @return array|mixed
	 */
	public function change_mirage($zone_identifier, $value = 'off') {

		return $this->patch('zones/' . $zone_identifier . '/settings/mirage', $value);

	}

	/**
	 * Change Polish setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: off)
	 *
	 * @return array|mixed
	 */
	public function change_polish($zone_identifier, $value = 'off') {

		return $this->patch('zones/' . $zone_identifier . '/settings/polish', $value);

	}

	/**
	 * Change Rocket Loader setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: off)
	 *
	 * @return array|mixed
	 */
	public function change_rocket_loader($zone_identifier, $value = 'off') {

		return $this->patch('zones/' . $zone_identifier . '/settings/rocket_loader', $value);

	}

	/**
	 * Change Security Level setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: medium)
	 *
	 * @return array|mixed
	 */
	public function change_security_level($zone_identifier, $value = 'medium') {

		return $this->patch('zones/' . $zone_identifier . '/settings/security_level', $value);

	}

	/**
	 * Change Server Side Exclude setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: on)
	 *
	 * @return array|mixed
	 */
	public function change_server_side_exclude($zone_identifier, $value = 'on') {

		return $this->patch('zones/' . $zone_identifier . '/settings/server_side_exclude', $value);

	}

	/**
	 * Change SSL setting (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: off)
	 *
	 * @return array|mixed
	 */
	public function change_ssl($zone_identifier, $value = 'off') {

		return $this->patch('zones/' . $zone_identifier . '/settings/ssl', $value);

	}

	/**
	 * Change Web Application Firewall (WAF) (permission needed: #zone_settings:edit)
	 *
	 * @param string $zone_identifier API item identifier tag
	 * @param string $value           Value of the zone setting (default: off)
	 *
	 * @return array|mixed
	 */
	public function change_waf($zone_identifier, $value = 'off') {

		return $this->patch('zones/' . $zone_identifier . '/settings/waf', $value);

	}

}
