<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Block
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Block_Authentication extends Mage_Core_Block_Template {

    public function isUserAuthenticated() {
        $session = Mage::getSingleton('customer/session');

        $model = Mage::getModel('msd_stackexchangeapi/user')->load($session->getCustomerId(), 'customer_id');

        return $model->hasData('access_token');
    }

}