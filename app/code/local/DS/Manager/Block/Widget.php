<?php

class DS_Manager_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    protected $_date = '';
    protected $_title = '';

    protected function _toHtml()
    {
        $this->_title = $this->getTitle();

        if($this->getFormat() == 'localized') {
            $locale = Mage::app()->getLocale();
            $this->_date = $locale->date(new Zend_Date())->toString(
                $locale->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM)
            );
        } else {
            $this->_date = date('Y-m-d');
        }

        return parent::_toHtml();
    }
}
