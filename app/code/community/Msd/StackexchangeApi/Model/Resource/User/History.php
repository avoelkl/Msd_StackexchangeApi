<?php
/**
 * @category    Msd_StackexchangeApi
 * @package     Model
 * @author      Anna Völkl / @rescueAnn
 */
class Msd_StackexchangeApi_Model_Resource_User_History extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {
        $this->_init('msd_stackexchangeapi/user_history', 'id');
    }

    protected function _getLoadSelect($field, $value, $object) {
        $select = parent::_getLoadSelect($field, $value, $object);

        $select->joinLeft(
            array('se_user' => 'stackexchange_user'),
            $this->getMainTable() . '.se_id = se_user.id',
            array('id'));
        return $select;
    }
}