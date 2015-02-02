<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     controllers
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_User_AuthenticateController extends Mage_Core_Controller_Front_Action {

    public function indexAction(){

        if (!Mage::getSingleton('customer/session')->isLoggedIn()):
            $this->_redirect('customer/account/login');
            return;
        endif;

        $this->loadLayout();
        $this->renderLayout();
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

    public function authenticateAction(){

        if (!Mage::getSingleton('customer/session')->isLoggedIn()):
            $this->_redirect('customer/account/login');
            return;
        endif;

        $stackClient = Mage::getModel('msd_stackexchangeapi/api');

        //check if user is already authenticated
        $seUser = Mage::getModel('msd_stackexchangeapi/user');

        //no data present => not authenticated before
        if(!$seUser->hasData() || !$seUser->hasData('access_token')) {
            $this->_redirectUrl($stackClient->getOauthUrl());
        }

        $this->loadLayout();
        $this->renderLayout();
    }

    /*
     *
     * StackExchange Authentication:
     * 4. POST (application/x-www-form-urlencoded) the following parameters to https://stackexchange.com/oauth/access_token
     *
     * client_id
     * client_secret
     * code - from the previous step
     * redirect_uri - must be the same as the provided in the first step
     *
     * This request is responded to with either an error (HTTP status code 400) or an access token of the form
     * access_token=...&expires=1234. expires will only be set if scope does not include no_expiry, the use of
     * which is strongly advised against unless your app truly needs perpetual access.
     */
    public function accesstokenAction() {
        $request_uri = $this->getRequest()->getRequestUri();
        $query = parse_url($request_uri, PHP_URL_QUERY);
        parse_str($query, $output);
        $code = $output['code'];

        $stackClient = Mage::getModel('msd_stackexchangeapi/api');
        $access_token = $stackClient->getAccessToken($code);

        $seUser = Mage::getModel('msd_stackexchangeapi/user');
        $session = Mage::getSingleton('customer/session');
        $seUser->setCustomerId($session->getCustomerId());
        $seUser->setAccessToken($access_token);
        $seUser->save();

        $this->loadLayout();
        $this->renderLayout();
    }

}