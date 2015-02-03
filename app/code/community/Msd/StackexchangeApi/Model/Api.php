<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Api {

    private $_config;
    private $_seClient;

    function __construct() {
        $this->_config = Mage::getModel('msd_stackexchangeapi/config');
        $this->_seClient = new Msd_StackexchangeApi_Client($this->_config);
    }


    /*
     *
     * StackExchange Authentication:
     * 1. Send a user to https://stackexchange.com/oauth, with these query string parameters
     * client_id
     * scope (details)
     * redirect_uri - must be under an apps registered domain
     * state - optional
     *
     * 2. The user approves your app
     *
     * For StackExchange Authentication, see https://api.stackexchange.com/docs/authentication
     */

    public function getOauthUrl() {
        return $this->_seClient->getOauthUrl();
    }

    public function getAccessToken($code) {
        return $this->_seClient->getAccessToken($code);
    }
/*
    public function getAccessTokenUrl() {
        return $$this->seClient->getAccessTokenUrl();
    }
*/
    public function getUserInfo($access_token) {
        return $this->_seClient->getUserInfo($access_token);
    }
}