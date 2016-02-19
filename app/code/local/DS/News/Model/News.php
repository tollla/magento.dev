<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 15:34
 */
class DS_News_Model_News extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('dsnews/news');
    }

}