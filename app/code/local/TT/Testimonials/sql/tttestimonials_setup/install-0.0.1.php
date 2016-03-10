<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 02.03.2016
 * Time: 8:50
 */

$installer = $this;
$tableName = $installer->getTable('tttestimonials/table_entities');

$installer->startSetup();
// delete table
$installer->getConnection()->dropTable($tableName);

$table = $installer->getConnection()
    ->newTable($tableName)
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  =>  true,
        'nullable'  =>  false,
        'primary'   =>  true
    ))
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  =>  false
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  =>  false
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  =>  false
    ))
;

$installer->getConnection()->createTable($table);

$installer->endsetup();