<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 09.03.2016
 * Time: 9:51
 */
class TT_Testimonials_Block_Testimonials extends Mage_Core_Block_Template
{

    public function getNewsCollection()
    {
        $newsCollection = Mage::getModel('tttestimonials/testimonials')
            ->getCollection()
            ->setOrder('created', 'DESC');
        return $newsCollection;
    }

}