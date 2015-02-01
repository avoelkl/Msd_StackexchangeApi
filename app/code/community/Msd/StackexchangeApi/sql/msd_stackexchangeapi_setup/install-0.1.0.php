<?php
/**
 * StackExchange user data
 * API: https://api.stackexchange.com/docs/types/user
 *
 * @category    Msd_StackexchangeApi
 * @package     msd_stackexchangeapi_setup
 * @author      Anna Völkl / @rescueAnn
 */

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('msd_stackexchangeapi/user'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'User ID')
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'User ID')
    ->addColumn('access_token', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
    ), 'Access Token')
    ->addColumn('display_name', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
    ), 'Display Name')
    ->addColumn('reputation', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Reputation')
    ->addForeignKey($installer->getFkName('msd_stackexchangeapi/user', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('StackExchange Type user');
$installer->getConnection()->createTable($table);
$installer->endSetup();
