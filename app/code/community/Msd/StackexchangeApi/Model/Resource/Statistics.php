<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Resource_Statistics extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {
        $this->_init('msd_stackexchangeapi/statistics', 'id');
    }

}