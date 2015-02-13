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

    public function setUserInfo($access_token) {
        $userInfo = $this->_seClient->getUserInfo($access_token);
        $info = json_decode($userInfo,true);
        $data = $info["items"]["0"];

        $seUser = Mage::getModel('msd_stackexchangeapi/user');
        $session = Mage::getSingleton('customer/session');
        $seUser->setCustomerId($session->getCustomerId());
        $seUser->setAccessToken($access_token);
        $seUser->setUserId($data["user_id"]);
        $seUser->setAccountId($data["account_id"]);
        $seUser->setDisplayName($data["display_name"]);
        $seUser->setLocation($data["location"]);
        $seUser->setWebsiteUrl($data["website_url"]);
        $seUser->setProfileImage($data["profile_image"]);
        $seUser->setLink($data["link"]);
        $seUser->setUserId($info);
        $seUser->save();

        return;
    }

    /*
     * Get user info via access token
     */
    public function getUserInfo($access_token) {
        $userInfo = $this->_seClient->getUserInfo($access_token);

        $seInfo = Zend_Json::decode($userInfo);
        $data = $seInfo["items"][0];

        return $data;
    }

    /*
     * Retrieve data from URL
     */
    public function getDataFromUrl($url) {
        return $this->_seClient->getDataFromUrl($url);
    }
}