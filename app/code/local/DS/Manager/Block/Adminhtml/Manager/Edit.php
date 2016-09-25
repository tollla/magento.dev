<?php


class DS_Manager_Block_Adminhtml_Manager_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'dsmanager';
        $this->_controller = 'adminhtml_manager';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('dsmanager');
        $model = Mage::registry('current_manager');

        if ($model->getId()) {
            return $helper->__("Edit Manager item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Manager item");
        }
    }

}
