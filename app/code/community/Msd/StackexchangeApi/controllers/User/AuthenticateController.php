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

        $this->loadLayout();
        $this->renderLayout();
    }

}