<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 20.02.2016
 * Time: 0:38
 */

class DS_News_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('dsnews');
        $this->_blockGroup = 'dsnews';
        $this->_controller = 'adminhtml_category';

        $this->_headerText = $helper->__('Category Management');
        $this->_addButtonLabel = $helper->__('Add Category');
    }

}