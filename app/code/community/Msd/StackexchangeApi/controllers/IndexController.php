<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     controllers
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_IndexController extends Mage_Core_Controller_Front_Action {

    /*
     * Default action: Statistics page
     */
    public function indexAction(){
/*
        if (!Mage::getSingleton('customer/session')->isLoggedIn()):
            $this->_redirect('customer/account/login');
            return;
        endif;*/

        $this->loadLayout();
        $this->renderLayout();
    }

}