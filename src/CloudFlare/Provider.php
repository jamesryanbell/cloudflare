<?php

	namespace Cloudflare;

	use Cloudflare\Api;

	/**
	 * CloudFlare API wrapper
	 *
	 * Provider
	 *
	 * @author Matt Saladna <matt@apisnetworks.com>
	 * @version 1
	 */

	class Provider extends Api
	{
		public function __construct($key) {
			parent::__construct($key);
			// 5 seconds is too low for admin operations like full_zone_set
			$this->setCurlOption(CURLOPT_TIMEOUT, 20);
		}

		/**
		 * Create a new CloudFlare user
		 *
		 * @return string user key
		 */
		public function create_user($email, $pass, $username = null, $uniqid = null, $clobber = false)
		{
			$data = array(
				'cloudflare_email' => $email,
				'cloudflare_pass' => $pass,
				'clobber_unique_id' => $clobber
			);

			if (!is_null($username)) {
				$data['cloudflare_username'] = $username;
			}

			if (!is_null($uniqid)) {
				$data['unique_id'] = $uniqid;
			}

			return $this->post('user_create', $data);
		}

		/**
		 * Setup a user's zone for CNAME hosting
		 *
		 * Set both $resolve_to and $subdomains to null for a full
		 * zone hosting by CF
		 *
		 * @param string $key				32-char key
		 * @param string $zone_name			zone for which CloudFlare filters
		 * @param $resolve_to string|null	target CNAME to resolve after filtering
		 * @param $subdomains array|null	subdomains CF hosts
		 * @return object					CF response
		 */
		public function zone_set($key, $zone_name, $resolve_to = null, array $subdomains = null)
		{
			$data = array(
				'user_key' => $key,
				'zone_name' => $zone_name
			);
			$method = 'full_zone_set';
			// partial zone set
			if ($resolve_to) {
				$method = 'zone_set';
				$data['resolve_to'] = $resolve_to;
				$data['subdomains'] = join(",", $subdomains);
			}

			return $this->post($method, $data);
		}

		/**
		 * Add a zone using the full setup method
		 *
		 * @param string $key		32-char auth key
		 * @param string $zone_name	zone for which CF is authoritative
		 * @return object			CF response
		 */
		public function full_zone_set($key, $zone_name) {
			return $this->zone_set($key, $zone_name);
		}

		/**
		 * Lookup a user's CF account information
		 *
		 * @param string $uniqid	user unique id set during creation
		 * @return object			CF response
		 */
		public function user_lookup($uniqid) {
			return $this->post('user_lookup', $uniqid);
		}

		public function user_auth($email, $passwd, $uniqid = null, $clobber = false) {
			$data = array(
				'cloudflare_email' => $email,
				'cloudflare_pass' => $passwd,
				'unique_id' => $uniqid,
				'clobber_unique_id' => $clobber
			);

			$this->post('user_auth', $data);
		}

		public function zone_lookup($key, $zone_name) {
			$data = array(
				'user_key' => $key,
				'zone_name' => $zone_name
			);
			return $this->post('zone_lookup', $data);
		}

		public function zone_delete($key, $zone_name) {
			$data = array(
				'user_key' => $key,
				'zone_name' => $zone_name
			);
			return $this->post('zone_delete', $data);
		}

		/**
		 * Renegerate your host key
		 *
		 * @XXX DANGEROUS!!!
		 *
		 * @return array|mixed
		 */
		public function host_key_regen() {

			return $this->post('host_key_regen');
		}

		/**
		 * List the domains currently active on CloudFlare for the given host
		 *
		 * Valid options are:
		 * limit
		 * offset
		 * zone_name
		 * sub_id
		 * zone_status
		 * sub_status
		 *
		 * Valid response zone_status codes:
		 * V: active
		 * D: deleted
		 *
		 * Valid subscription response status codes:
		 * V: active
		 * CNL: canceled
		 *
		 * @param array $options
		 * @return object
		 *
		 */
		public function zone_list(array $options = array()) {
			$myoptions = array(
				'limit' => 100,
				'offset' => 0,
				'zone_name' => NULL,
				'sub_id' => NULL,
				'zone_status' => 'ALL',
				'sub_status' => 'ALL'
			);

			foreach (array_keys($myoptions) as $k) {
				if (isset($options[$k])) {
					$myoptions[$k] = $options[$k];
				}
			}

			if (isset($options['sub_status'])) {
				$valid = array('V','CNL','ALL');
				$status = strtoupper($options['sub_status']);
				if (!in_array($status, $valid)) {
					throw new \InvalidArgumentException("unknown sub_status `" .
						$status ."'");
				}
				$myoptions['sub_status'] = $status;
			}

			if (isset($options['zone_status'])) {
				$valid = array('V', 'D', 'ALL');
				$status = strtoupper($options['zone_status']);
				if (!in_array($status, $valid)) {
					throw new \InvalidArgumentException("unknown zone_status `" .
						$status ."'");
				}
				$myoptions['zone_status'] = $status;
			}

			return $this->post('zone_list', $myoptions);
		}
	}
