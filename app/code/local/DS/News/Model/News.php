<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 15:34
 */
class DS_News_Model_News extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        parent::_construct();
        $this->_init('dsnews/news');
    }

    protected function _afterDelete()
    {
        $helper = Mage::helper('dsnews');
        @unlink($helper->getImagePath($this->getId()));
        return parent::_afterDelete();
    }

    protected function _beforeSave()
    {
        $helper = Mage::helper('dsnews');

        if (!$this->getData('link')) {
            $this->setData('link', $helper->prepareUrl($this->getTitle()));
        } else {
            $this->setData('link', $helper->prepareUrl($this->getData('link')));
        }
        return parent::_beforeSave();
    }

    public function getImageUrl()
    {
        $helper = Mage::helper('dsnews');
        if ($this->getId() && file_exists($helper->getImagePath($this->getId()))) {
            return $helper->getImageUrl($this->getId());
        }
        return null;
    }
}