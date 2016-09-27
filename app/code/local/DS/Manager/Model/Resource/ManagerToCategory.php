<?php


/**
 * AdminNotification Inbox model
 *
 * @category    DS
 * @package     DS_Manager
 * @author      Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_Resource_ManagerToCategory extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * DSManager Resource initialization
     *
     */
    protected function _construct()
    {
        $this->_init('dsmanager/table_managerToCategory', 'id');
    }

    public function setIdFieldName($field = ''){
        $this->_idFieldName = $field;
    }

}// Class DS_Manager_Model_Resource_ManagerToCategory End
