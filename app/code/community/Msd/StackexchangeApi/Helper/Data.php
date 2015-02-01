<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Helper
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Helper_Data extends Mage_Core_Helper_Abstract {

    const XML_PATH_CLIENT_ID        = 'stackexchangeapi/settings/client_id';
    const XML_PATH_CLIENT_SECRET    = 'stackexchangeapi/settings/client_secret';
    const XML_PATH_KEY              = 'stackexchangeapi/settings/key';
    const XML_PATH_OAUTH_URL        = 'global/stackexchangeapi/settings/oauth_url';
    const XML_PATH_ACCESSTOKEN_URL  = 'global/stackexchangeapi/settings/accesstoken_url';
    const XML_PATH_SCOPE            = 'global/stackexchangeapi/settings/scope';


    /*
     * @TODO: future check if stackexchange auth is enabled
     */
    //const XML_PATH_ACTIVATION       = 'stackexchangeapi/settings/activation';

    public function getAppDataClientId() {
        return Mage::getStoreConfig(self::XML_PATH_CLIENT_ID);
    }

    public function getAppDataClientSecret() {
        return Mage::getStoreConfig(self::XML_PATH_CLIENT_SECRET);
    }

    public function getAppDataKey() {
        return Mage::getStoreConfig(self::XML_PATH_KEY);
    }

    public function getAppDataScope() {
        return (string) Mage::getConfig()->getNode(self::XML_PATH_SCOPE);
    }

    public function getAppDataOauthUrl() {
        return (string)Mage::getConfig()->getNode(self::XML_PATH_OAUTH_URL);
    }

    public function getAppDataAccesstokenUrl() {
        return (string)Mage::getConfig()->getNode(self::XML_PATH_ACCESSTOKEN_URL);
    }

    public function getAppDataRedirectUri() {
        return Mage::getUrl('stackexchangeapi/user_authenticate/accesstoken');
    }


}