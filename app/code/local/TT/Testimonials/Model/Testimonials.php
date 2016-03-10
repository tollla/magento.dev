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

    public function toOptionArray()
    {
        $customerCollection = Mage::getModel('customer/customer')->getCollection()
                ->addAttributeToSelect('firstname')
                ->addAttributeToSelect('lastname');

        $customerArray = array(array('value'=>-1, 'label'=>'Please Select'));

        foreach ($customerCollection as $customerList){

            $customerArray[] = array('value'=>$customerList->getId(),'label'=>$customerList->getFirstname()." ".$customerList->getLastname());
        }

        return $customerArray;
    }

    public function getListTestimonials(){

        $collection = Mage::getModel('tttestimonials/testimonials')
            ->getCollection()
        ;

        return $collection;
    }
}