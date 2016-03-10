<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 09.03.2016
 * Time: 8:34
 */
class TT_Testimonials_Model_Resource_Testimonials_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('tttestimonials/testimonials');
    }

}