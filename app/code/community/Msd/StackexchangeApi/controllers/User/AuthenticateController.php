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