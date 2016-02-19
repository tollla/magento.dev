<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 15:35
 */
class DS_News_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('dsnews/table_news', 'news_id');
    }

}