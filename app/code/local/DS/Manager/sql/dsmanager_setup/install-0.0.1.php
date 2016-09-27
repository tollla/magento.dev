<?php
/**
 * @category   DS
 * @package    DS_Manager
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

/**
 * Create table 'manager'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('dsmanager/table_manager'))
    ->addColumn('manager_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Manager ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
    ), 'Name ')
    ->addColumn('secondName', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
    ), 'Second Name ')
    ->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Telephone')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Email')
    ->addColumn('photo', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Photo')
    ->setComment('Manager Table');
$installer->getConnection()->createTable($table);

/**
 * Create table 'manager to category'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('dsmanager/table_managerToCategory'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'ID')
    ->addColumn('manager_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'Manager ID')
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    ), 'Category ID')
    ->setComment('Category to manager Table');
$installer->getConnection()->createTable($table);
