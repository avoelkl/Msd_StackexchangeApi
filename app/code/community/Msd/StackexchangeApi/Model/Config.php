<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Config {

    /* AppData */
    protected $_clientId;
    protected $_clientSecret;
    protected $_scope;
    protected $_oauthUrl;
    protected $_accesstokenUrl;
    protected $_redirectUri;
    protected $_userMeUrl;
    protected $_key;
    protected $_state;

    function __construct() {
        $helper = Mage::helper('msd_stackexchangeapi');

        $this->_clientId        = $helper->getAppDataClientId();
        $this->_clientSecret    = $helper->getAppDataClientSecret();
        $this->_scope           = $helper->getAppDataScope();
        $this->_oauthUrl        = $helper->getAppDataOauthUrl();
        $this->_accesstokenUrl  = $helper->getAppDataAccesstokenUrl();
        $this->_redirectUri     = $helper->getAppDataRedirectUri();
        $this->_userMeUrl       = $helper->getAppDataUserMeUrl();
        $this->_key             = $helper->getAppDataKey();
        $this->_state           = ''; //currently not in use
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->_scope;
    }

    /**
     * @return mixed
     */
    public function getOauthUrl()
    {
        return $this->_oauthUrl;
    }

    /**
     * @return mixed
     */
    public function getAccesstokenUrl()
    {
        return $this->_accesstokenUrl;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->_redirectUri;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @return mixed
     */
    public function getGetUserMeUrl()
    {
        return $this->_userMeUrl;
    }



}