<?php

namespace JamesRyanBell\Cloudflare\Zone;
use JamesRyanBell\Cloudflare\Api;

/**
 * CloudFlare API wrapper
 *
 * Cache
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class Cache extends Api
{

	/**
	 * Purge all files (permission needed: #zone:edit)
	 * Remove ALL files from CloudFlare's cache
	 * @param  string  $identifier API item identifier tag
	 * @param  boolean A flag that indicates all resources in CloudFlare's cache should be removed.
	 *                 Note: This may have dramatic affects on your origin server load after
	 *                 performing this action. (true)
	 */
	public function purge($identifier, $purge_everything = true)
	{
		$data = array(
			'purge_everything' => $purge_everything
		);
		return $this->delete('zones/' . $identifier . '/purge_cache', $data);
	}

	/**
	 * Purge individual files (permission needed: #zone:edit)
	 * Remove one or more files from CloudFlare's cache
	 * @param  string $identifier API item identifier tag
	 * @param  array  $files      An array of URLs that should be removed from cache
	 */
	public function purge_files($identifier, array $files)
	{
		$data = array(
			'files' => $files
		);
		return $this->delete('zones/' . $identifier . '/purge_cache', $data);
	}


}
