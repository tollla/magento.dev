<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 16:21
 */
class DS_News_Block_News extends Mage_Core_Block_Template
{

    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('dsnews/news')->getCollection();
        $newsCollection->setOrder('created', 'DESC');
        return $newsCollection;
    }

}