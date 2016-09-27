<?php


class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        $helper = Mage::helper('dsmanager');

        parent::__construct();
        $this->setId('manager_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Manager Information'));
    }

    protected function _prepareLayout()
    {
        $helper = Mage::helper('dsmanager');

        $this->addTab('general_section', array(
            'label' => $helper->__('General Information'),
            'title' => $helper->__('General Information'),
            'content' => $this->getLayout()->createBlock('dsmanager/adminhtml_manager_edit_tabs_general')->toHtml(),
        ));
        $this->addTab('custom_section', array(
            'label' => $helper->__('Category Information'),
            'title' => $helper->__('Category Information'),
            'content' => $this->getLayout()->createBlock('dsmanager/adminhtml_manager_edit_tabs_categoryList')->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}// Class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs End
