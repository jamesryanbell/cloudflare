<?php

namespace Cloudflare\Zone\SSL;

use Cloudflare\Api;
use Cloudflare\Zone;
use Cloudflare\Zone\SSL;

/**
 * CloudFlare API wrapper
 *
 * Certificate Packs
 *
 * @author James Bell <james@james-bell.co.uk>
 * @version 1
 */

class CertificatePacks extends Api
{
    /**
     * Default permissions level
     * @var array
     */
    protected $permission_level = array('read' => '#ssl:read', 'edit' => '#ssl:edit');

    /**
     * List all certificate packs (permission needed: #ssl:read)
     * For a given zone, list all certificate packs
     * @param string      $identifier
     */
    public function certificate_packs($identifier)
    {
        return $this->get('/zones/' . $identifier . '/ssl/certificate_packs');
    }
}
