<?php

namespace JamesRyanBell\Cloudflare;

/**
 * CloudFlare API wrapper.
 *
 * User
 * The currently logged in/authenticated User
 *
 * @author James Bell <james@james-bell.co.uk>
 *
 * @version 1
 */
class User extends Api
{
    protected $permissionLevel = [
        'read' => null,
        'edit' => null,
    ];

    /**
     * User details.
     */
    public function user()
    {
        return $this->get('user');
    }

    /**
     * Update part of your user details.
     *
     * @param string $firstName User's first name
     * @param string $lastName  User's last name
     * @param string $telephone User's telephone number
     * @param string $country   The country in which the user lives.
     *                          (Full list is here: http://en.wikipedia.org/wiki/List_of_country_calling_codes)
     * @param string $zipcode   The zipcode or postal code where the user lives.
     *
     * @return array|mixed
     */
    public function update($firstName = null, $lastName = null, $telephone = null, $country = null, $zipcode = null)
    {
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'telephone' => $telephone,
            'country' => $country,
            'zipcode' => $zipcode,
        ];

        return $this->patch('user', $data);
    }

    /**
     * Change your email address. Note: You must provide your current password.
     *
     * @param string $email        Your contact email address
     * @param string $emailConfirm Your contact email address, repeated
     * @param string $password     Your current password
     *
     * @return array|mixed
     */
    public function changeEmail($email, $emailConfirm, $password)
    {
        $data = [
            'email' => $email,
            'confirm_email' => $emailConfirm,
            'password' => $password,
        ];

        return $this->put('user/email', $data);
    }

    /**
     * Change your password.
     *
     * @param string $oldPassword        Your current password
     * @param string $newPassword        Your new password
     * @param string $newPasswordConfirm Your new password, repeated
     *
     * @return array|mixed
     */
    public function changePassword($oldPassword, $newPassword, $newPasswordConfirm)
    {
        $data = [
            'old_password' => $oldPassword,
            'new_password' => $newPassword,
            'new_password_confirm' => $newPasswordConfirm,
        ];

        return $this->put('user/password', $data);
    }

    /**
     * Change your username. Note: You must provide your current password.
     *
     * @param string $username A username used to access other cloudflare services, like support
     * @param string $password Your current password
     *
     * @return array|mixed
     */
    public function changeUsername($username, $password)
    {
        $data = [
            'username' => $username,
            'password' => $password,
        ];

        return $this->put('user/username', $data);
    }

    /**
     * Begin setting up CloudFlare two-factor authentication with a given telephone number.
     *
     * @param int    $countryCode       The country code of your mobile phone number
     * @param string $mobilePhoneNumber Your mobile phone number
     * @param string $currentPassword   Your current CloudFlare password
     *
     * @return array|mixed
     */
    public function initializeTwoFactorAuthentication($countryCode, $mobilePhoneNumber, $currentPassword)
    {
        $data = [
            'country_code' => $countryCode,
            'mobile_phone_number' => $mobilePhoneNumber,
            'current_password' => $currentPassword,
        ];

        return $this->post('/user/two_factor_authentication', $data);
    }

    /**
     * Finish setting up CloudFlare two-factor authentication with a given telephone number.
     *
     * @param int $authToken The token provided by the two-factor authenticator
     *
     * @return array|mixed
     */
    public function finalizeTwoFactorAuthentication($authToken)
    {
        $data = [
            'auth_token' => $authToken,
        ];

        return $this->put('user/two_factor_authentication', $data);
    }

    /**
     * Disable two-factor authentication for your CloudFlare user account.
     *
     * @param int $authToken The token provided by the two-factor authenticator
     *
     * @return array|mixed
     */
    public function disableTwoFactorAuthentication($authToken)
    {
        $data = [
            'auth_token' => $authToken,
        ];

        return $this->delete('user/two_factor_authentication', $data);
    }
}
