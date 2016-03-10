<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 09.03.2016
 * Time: 10:30
 */

class TT_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    protected function __construct(){

        print __FILE__.": ".__LINE__;
        die;
    }

    protected function _construct()
    {
        print __FILE__.": ".__LINE__;
        die;
        $this->_blockGroup = 'tttestimonials';
        $this->_controller = 'adminhtml_testimonials';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('tttestimonials');
        $model = Mage::registry('current_testimonials');

        if ($model->getId()) {
            return $helper->__("Edit Testimonials item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Testimonials item");
        }
    }

}