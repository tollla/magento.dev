<?php


/**
 * Manager model
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_ManagerToCategory extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('dsmanager/managerToCategory');
    }
}// Class DS_Manager_Model_ManagerToCategory End
