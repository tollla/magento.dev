<?php

/**
 * Adminhtml manager page content block
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 **/

class DS_Manager_Block_Adminhtml_Manager extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('dsmanager');

        $this->_blockGroup = 'dsmanager';
        $this->_controller = 'adminhtml_manager';

        $this->_headerText = $helper->__('Managers');
        $this->_addButtonLabel = $helper->__('AddManager');
    }
}
