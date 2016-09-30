<?php


/**
 * DSManager Manager model
 *
 * @category    DS
 * @package     DS_Manager
 * @author      Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_Resource_ManagerToCategory_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * Resource collection initialization
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('dsmanager/managerToCategory');
    }

    /**
     * Add manager filter
     *
     * @param  $managerId
     * @return Mage_XmlConnect_Model_Mysql4_ConfigData_Collection
     */
    public function addManagerIdFilter($managerId)
    {
        $this->getSelect()->where('manager_id=?', $managerId);
        return $this;
    }

    /**
     * Add manager filter
     *
     * @param  $categoryId
     * @return Mage_XmlConnect_Model_Mysql4_ConfigData_Collection
     */
    public function addCategoryIdFilter($categoryId)
    {
        $this->getSelect()->where('category_id=?', $categoryId);
        return $this;
    }



}// Class DS_Manager_Model_Resource_ManagerToCategory_Collection End
