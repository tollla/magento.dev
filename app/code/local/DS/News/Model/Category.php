<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 22:08
 */


class DS_News_Model_Category extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        parent::_construct();
        $this->_init('dsnews/category');
    }

    protected function _afterDelete()
    {
        foreach($this->getNewsCollection() as $news){
            $news->setCategoryId(0)->save();
        }
        return parent::_afterDelete();
    }

    public function getNewsCollection()
    {
        $collection = Mage::getModel('dsnews/news')->getCollection();
        $collection->addFieldToFilter('category_id', $this->getId());
        return $collection;
    }

}