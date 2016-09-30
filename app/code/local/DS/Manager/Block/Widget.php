<?php

/**
 * html manager page content block
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 **/

class DS_Manager_Block_Widget extends  Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    protected $_managers = array();
    /**
     * Get block manager widget
     *
     * @return string
     */
    protected function _toHtml()
    {
        $_category = Mage::registry('current_category');

        if ($_category !== NULL) {
            $modelManagerToCategory = Mage::getModel('dsmanager/managerToCategory');

            $flag = true;

            while ($flag) {

                if ($_category === NULL) {
                    return '';
                }
                $collectionManagerToCategory = $modelManagerToCategory->getCollection();
                $collectionManagerToCategory->resetData()->addCategoryIdFilter($_category->getId());

                if ($collectionManagerToCategory->count() < 1) {
                    $_category = $_category->getParentCategory();
                } else {
                    $flag = false;
                }
            }

            if ($collectionManagerToCategory->count() > 0) {
                foreach ($collectionManagerToCategory as $managerToCategory) {
                    $managerId = $managerToCategory->getManagerId();
                    $manager = Mage::getModel('dsmanager/manager');
                    $this->_managers[$managerId] = $manager->load($managerId);
                }
            }

            $this->assign('managers', $this->_managers);

            return parent::_toHtml();
        }
        return '';
    }
}
