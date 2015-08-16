<?php

namespace JamesRyanBell\Cloudflare\Zone\Settings;

use JamesRyanBell\Cloudflare\Zone\Zone;

/**
 * CloudFlare API wrapper.
 *
 * Zone Settings
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class Settings extends Zone
{
    protected $permissionLevel = [
        'read' => '#zone_settings:read',
        'edit' => '#zone_settings:edit',
    ];

    /**
     * Zone settings (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function settings($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings');
    }

    /**
     * Advanced DDOS setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function advancedDdos($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/advanced_ddos');
    }

    /**
     * Get Always Online setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function alwaysOnline($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/always_online');
    }

    /**
     * Get Browser Cache TTL setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function browserCacheTtl($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/browser_cache_ttl');
    }

    /**
     * Get Browser Check setting (permission needed: #zone_settings:read).
     *
     * @param string $zone_identifier API item identifier tag
     *
     * @return array|mixed
     */
    public function browserCheck($zone_identifier)
    {
        return $this->get('zones/'.$zone_identifier.'/settings/browser_check');
    }

    /**
     * Get Cache Level setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function cacheLevel($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/cache_level');
    }

    /**
     * Get Challenge TTL setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function challengeTtl($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/challenge_ttl');
    }

    /**
     * Get Development Mode setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function developmentMode($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/development_mode');
    }

    /**
     * Get Email Obfuscation setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function emailObfuscation($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/email_obfuscation');
    }

    /**
     * Get Hotlink Protection setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function hotlinkProtection($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/hotlink_protection');
    }

    /**
     * Get IP Geolocation setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function ipGeolocation($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/ip_geolocation');
    }

    /**
     * Get IP IPv6 setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function ipv6($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/ipv6');
    }

    /**
     * Get IP Minify setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function minify($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/minify');
    }

    /**
     * Get Mobile Redirect setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function mobileRedirect($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/mobile_redirect');
    }

    /**
     * Get Mirage setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function mirage($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/mirage');
    }

    /**
     * Get Polish setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function polish($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/polish');
    }

    /**
     * Get Rocket Loader setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function rocketLoader($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/rocket_loader');
    }

    /**
     * Get Security Level setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function securityLevel($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/security_level');
    }

    /**
     * Get Server Side Exclude setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function serverSideExclude($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/server_side_exclude');
    }

    /**
     * Get SSL setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function ssl($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/ssl');
    }

    /**
     * Get Web Application Firewall (WAF) setting (permission needed: #zone_settings:read).
     *
     * @param string $zoneIdentifier API item identifier tag
     *
     * @return array|mixed
     */
    public function waf($zoneIdentifier)
    {
        return $this->get('zones/'.$zoneIdentifier.'/settings/waf');
    }

    /**
     * Get Web Application Firewall (WAF) setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param array  $data           $items One or more zone setting objects. Must contain an ID and a value.
     *
     * @return array|mixed
     */
    public function edit($zoneIdentifier, array $data)
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings', $data);
    }

    /**
     * Change Always Online setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeAlwaysOn($zoneIdentifier, $value = 'on')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/always_online', $data);
    }

    /**
     * Change Browser Cache TTL setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param int    $value          Value of the zone setting (default: 14400)
     *
     * @return array|mixed
     */
    public function changeBrowserCacheTtl($zoneIdentifier, $value = 14400)
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/browser_cache_ttl', $data);
    }

    /**
     * Change Browser Check setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeBrowserCheck($zoneIdentifier, $value = 'on')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/browser_check', $data);
    }

    /**
     * Change Cache Level setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeCacheLevel($zoneIdentifier, $value = 'aggressive')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/cache_level', $data);
    }

    /**
     * Change Challenge TTL setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param int    $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeChallengeTtl($zoneIdentifier, $value = 1800)
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/challenge_ttl', $data);
    }

    /**
     * Change Development Mode setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeDevelopmentMode($zoneIdentifier, $value = 'off')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/development_mode', $data);
    }

    /**
     * Change Email Obfuscation setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeEmailObfuscation($zoneIdentifier, $value = 'on')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/email_obfuscation', $data);
    }

    /**
     * Change Hotlink Protection setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeHotlinkProtection($zoneIdentifier, $value = 'off')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/hotlink_protection', $data);
    }

    /**
     * Change IP Geolocation setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeIpGeolocation($zoneIdentifier, $value = 'on')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/ip_geolocation', $data);
    }

    /**
     * Change IP Geolocation setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeIpv6($zoneIdentifier, $value = 'off')
    {
        $data = [
            'value' => $value,
        ];

        return $this->patch('zones/'.$zoneIdentifier.'/settings/ipv6', $data);
    }

    /**
     * Change Minify setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting
     *
     * @return array|mixed
     */
    public function changeMinify($zoneIdentifier, $value)
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/minify', $value);
    }

    /**
     * Change Mobile Redirect setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeMobileRedirect($zoneIdentifier, $value = 'on')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/mobile_redirect', $value);
    }

    /**
     * Change Mirage setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: off)
     *
     * @return array|mixed
     */
    public function changeMirage($zoneIdentifier, $value = 'off')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/mirage', $value);
    }

    /**
     * Change Polish setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: off)
     *
     * @return array|mixed
     */
    public function changePolish($zoneIdentifier, $value = 'off')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/polish', $value);
    }

    /**
     * Change Rocket Loader setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: off)
     *
     * @return array|mixed
     */
    public function changeRocketLoader($zoneIdentifier, $value = 'off')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/rocket_loader', $value);
    }

    /**
     * Change Security Level setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: medium)
     *
     * @return array|mixed
     */
    public function changeSecurityLevel($zoneIdentifier, $value = 'medium')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/security_level', $value);
    }

    /**
     * Change Server Side Exclude setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: on)
     *
     * @return array|mixed
     */
    public function changeServerSideExclude($zoneIdentifier, $value = 'on')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/server_side_exclude', $value);
    }

    /**
     * Change SSL setting (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: off)
     *
     * @return array|mixed
     */
    public function changeSsl($zoneIdentifier, $value = 'off')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/ssl', $value);
    }

    /**
     * Change Web Application Firewall (WAF) (permission needed: #zone_settings:edit).
     *
     * @param string $zoneIdentifier API item identifier tag
     * @param string $value          Value of the zone setting (default: off)
     *
     * @return array|mixed
     */
    public function changeWaf($zoneIdentifier, $value = 'off')
    {
        return $this->patch('zones/'.$zoneIdentifier.'/settings/waf', $value);
    }
}
