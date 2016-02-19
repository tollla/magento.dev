<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 17:21
 */

class DS_News_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('dsnews');
        $this->_blockGroup = 'dsnews';
        $this->_controller = 'adminhtml_news';

        $this->_headerText = $helper->__('News Management');
        $this->_addButtonLabel = $helper->__('Add News');
    }

}