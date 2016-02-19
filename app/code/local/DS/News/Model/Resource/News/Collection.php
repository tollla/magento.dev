<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 15:36
 */
class DS_News_Model_Resource_News_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('dsnews/news');
    }

}