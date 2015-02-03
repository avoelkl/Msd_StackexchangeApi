<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Block
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Block_User_List extends Mage_Core_Block_Template {

    public function getAuthenticatedUserList() {
        $collection = Mage::getModel('msd_stackexchangeapi/user')->getCollection();

        return $collection;
    }

}