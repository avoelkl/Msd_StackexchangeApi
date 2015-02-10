<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Block
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Block_Statistics extends Mage_Core_Block_Template {

    public function getStatistics() {
        $collection = Mage::getModel('msd_stackexchangeapi/statistics')
                        ->getCollection()
                        ->addFieldToFilter('active',1);

        return $collection;
    }

}