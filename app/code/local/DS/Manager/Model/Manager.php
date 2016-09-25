<?php


/**
 * Manager model
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 */
class DS_Manager_Model_Manager extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('dsmanager/manager');

    }

    protected function _afterDelete()
    {
        $helper = Mage::helper('dsmanager');
        @unlink($helper->getImagePath($this->getId()));
        return parent::_afterDelete();
    }

    public function getImageUrl()
    {
        $helper = Mage::helper('dsmanager');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }

}// Class DS_Manager_Model_Manager End
