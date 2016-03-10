<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 02.03.2016
 * Time: 8:44
 */
class TT_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

//    public function indexAction()
//    {
//        $testimonials = Mage::getModel('tttestimonials/testimonials')
//            ->getCollection()
//            ->setOrder('created', 'DESC');
//
//
//        $viewUrl = Mage::getUrl('testimonials/index/view');
//
//        echo '<h1>Testimonials</h1>';
//
//        foreach($testimonials as $item){
//            echo '<h2><a href="' . $viewUrl . '?id=' . $item->getId() . '">' . $item->getContent() . '</a></h2>';
//        }
//
//    }

    public function viewAction()
    {
        $testimonialsId = Mage::app()->getRequest()->getParam('id', 0);
        $testimonials = Mage::getModel('tttestimonials/testimonials')->load($testimonialsId);

        if ($testimonials->getId() > 0) {
            $this->loadLayout();
            $this->getLayout()->getBlock('testimonials.content')
                ->assign(array(
                    "testimonialsItem" => $testimonials,
                ));
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }
}