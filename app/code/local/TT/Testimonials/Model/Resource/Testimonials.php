<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 09.03.2016
 * Time: 8:33
 */

class TT_Testimonials_Model_Resource_Testimonials extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('tttestimonials/table_entities', 'id');
    }

}