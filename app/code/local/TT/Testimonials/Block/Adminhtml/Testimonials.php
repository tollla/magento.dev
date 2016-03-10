<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 07.03.2016
 * Time: 11:42
 */

class TT_Testimonials_Block_Adminhtml_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('tttestimonials');
        $this->_blockGroup = 'tttestimonials';
        $this->_controller = 'adminhtml_testimonials';

        $this->_headerText = $helper->__('Testimonials Management');
        $this->_addButtonLabel = $helper->__('Add News');
    }

}