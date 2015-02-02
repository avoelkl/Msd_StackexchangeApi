<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Block
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Block_Authentication extends Mage_Core_Block_Template {

    public function isUserAuthenticated() {
        $session = Mage::getSingleton('customer/session');

        //@TODO: Needs a fix
        //$model = Mage::getModel('msd_stackexchangeapi/user');
        //$model->load($session->getCustomerId(), 'customer_id');
        //error: Column not found: 1054 Unknown column 'ce.columnA' in 'field list'

        $model = Mage::getModel('msd_stackexchangeapi/user')
            ->getCollection()
            ->addFieldToFilter('customer_id', $session->getCustomerId())
            ->getFirstItem();

        return $model->hasData('access_token');
    }

}