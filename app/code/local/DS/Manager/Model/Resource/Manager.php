<?php


/**
 * AdminNotification Inbox model
 *
 * @category    DS
 * @package     DS_Manager
 * @author      Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_Resource_Manager extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * DSManager Resource initialization
     *
     */
    protected function _construct()
    {
        $this->_init('dsmanager/table_manager', 'manager_id');
    }
}// Class DS_Manager_Model_Resource_Manager End
