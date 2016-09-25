<?php


/**
 * DSManager Manager model
 *
 * @category    DS
 * @package     DS_Manager
 * @author      Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_Resource_Manager_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Resource collection initialization
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('dsmanager/manager');
    }
}// Class DS_Manager_Model_Resource_Manager_Collection End
