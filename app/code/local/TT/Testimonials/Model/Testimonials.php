<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 09.03.2016
 * Time: 8:31
 */
class TT_Testimonials_Model_Testimonials extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('tttestimonials/testimonials');
    }

}