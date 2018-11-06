<?php

namespace Cloudflare\Zone\Firewall;

use Cloudflare\Api;

/**
 * CloudFlare API wrapper
 *
 * Firewall user agent rules for a Zone
 *
 * @author  Alexander Fedra <contact@dercoder.at>
 *
 * @version 1
 */
class UserAgentRules extends Api
{
    /**
     * List user agent rules (permission needed: #zone:read)
     * List the UserAgent rules on a zone.
     *
     * @param string      $zone_id
     * @param int|null    $page        Page number of paginated results.
     * @param int|null    $per_page    Number of UserAgent rules per page.
     * @param string|null $user_agent  A single UserAgent string to search for.
     * @param string|null $description A single string to search for in the description.
     *
     * @return mixed
     */
    public function rules($zone_id, $page = null, $per_page = null, $user_agent = null, $description = null)
    {
        $data = [
            'page'        => $page,
            'per_page'    => $per_page,
            'user_agent'  => $user_agent,
            'description' => $description,
        ];

        return $this->get('/zones/' . $zone_id . '/firewall/ua_rules', $data);
    }

    /**
     * Show user agent rule details (permission needed: #zone:read)
     *
     * @param string $zone_id
     * @param string $identifier
     *
     * @return mixed
     */
    public function rule($zone_id, $identifier)
    {
        return $this->get('/zones/' . $zone_id . '/firewall/ua_rules/' . $identifier);
    }

    /**
     * Create user agent rule (permission needed: #zone:edit)
     * Create a new UserAgent rule for a zone. See the record object definitions for required attributes for each
     * record type.
     *
     * @param string      $zone_id
     * @param string      $mode          The type of action to perform.
     * @param object      $configuration Target/Value pair to use for this rule. The value is the exact UserAgent to
     *                                   match.
     * @param bool|null   $paused        Whether this UA rule is currently paused.
     * @param string|null $description   Some useful information about this rule to help identify the purpose of it.
     *
     * @return mixed
     */
    public function create($zone_id, $mode, $configuration, $paused = null, $description = null)
    {
        $data = [
            'mode'          => $mode,
            'configuration' => $configuration,
            'paused'        => $paused,
            'description'   => $description,
        ];

        return $this->post('/zones/' . $zone_id . '/firewall/ua_rules', $data);
    }

    /**
     * Update user agent rule (permission needed: #zone:edit)
     * Update a UserAgent rule for a zone. See the record object definitions for required attributes for each
     * record type.
     *
     * @param string      $zone_id
     * @param string      $identifier
     * @param string      $mode          The type of action to perform.
     * @param object      $configuration Target/Value pair to use for this rule. The value is the exact UserAgent to
     *                                   match.
     * @param bool|null   $paused        Whether this UA rule is currently paused.
     * @param string|null $description   Some useful information about this rule to help identify the purpose of it.
     *
     * @return mixed
     */
    public function update($zone_id, $identifier, $mode, $configuration, $paused, $description = null)
    {
        $data = [
            'mode'          => $mode,
            'configuration' => $configuration,
            'paused'        => $paused,
            'description'   => $description,
        ];

        return $this->patch('/zones/' . $zone_id . '/firewall/ua_rules/' . $identifier, $data);
    }

    /**
     * Delete agent rule (permission needed: #zone:edit)
     *
     * @param string $zone_id
     * @param string $identifier
     *
     * @return mixed
     */
    public function delete_rule($zone_id, $identifier)
    {
        return $this->delete('/zones/' . $zone_id . '/firewall/ua_rules/' . $identifier);
    }
}
