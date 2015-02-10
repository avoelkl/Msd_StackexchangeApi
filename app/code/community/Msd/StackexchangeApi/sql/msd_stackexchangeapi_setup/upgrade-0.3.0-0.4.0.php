<?php
/**
 * StackExchange user data history
 * StackExchange site info
 * API: https://api.stackexchange.com/docs/types/user
 *
 * @category    Msd_StackexchangeApi
 * @package     msd_stackexchangeapi_setup
 * @author      Anna Völkl / @rescueAnn
 */

$installer = $this;
$installer->startSetup();

/*
 * Update table definition, date column was accidentally created as int, not datetime in v0.3.0
 */
$table = $installer->getConnection()
    ->modifyColumn($installer->getTable('msd_stackexchangeapi/statistics'),
        'date', Varien_Db_Ddl_Table::TYPE_DATETIME, true);

$installer->endSetup();
