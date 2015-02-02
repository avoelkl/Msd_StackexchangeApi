<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Api {
    /* AppData */
    private $client_id;
    private $client_secret;
    private $scope;
    private $oauth_url;
    private $accesstoken_url;
    private $redirect_uri;
    private $state;
    private $key;

    private $seClient;

    //@TODO: refactor
    function __construct() {
        $helper = Mage::helper('msd_stackexchangeapi');

        $this->client_id        = $helper->getAppDataClientId();
        $this->client_secret    = $helper->getAppDataClientSecret();
        $this->scope            = $helper->getAppDataScope();
        $this->oauth_url        = $helper->getAppDataOauthUrl();
        $this->accesstoken_url  = $helper->getAppDataAccesstokenUrl();
        $this->redirect_uri     = $helper->getAppDataRedirectUri();
        $this->key              = $helper->getAppDataKey();
        $this->state            = ''; //currently not in use

        $this->seClient = new Msd_StackexchangeApi_Client(
            $this->client_id,
            $this->client_secret,
            $this->scope,
            $this->redirect_uri,
            $this->state,
            $this->oauth_url,
            $this->accesstoken_url);
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
        return $this->seClient->getOauthUrl();
    }

    public function getAccessToken($code) {
        return $this->seClient->getAccessToken($code);
    }
/*
    public function getAccessTokenUrl() {
        return $$this->seClient->getAccessTokenUrl();
    }
*/
}