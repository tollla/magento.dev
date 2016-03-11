<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 02.03.2016
 * Time: 8:44
 */
class TT_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    protected function _construct(){
//
//        // only registered user

//
    }

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

    public function addAction(){

        // check logged customer
        if(!Mage::helper('customer')->isLoggedIn()){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }

        if ($data = $this->getRequest()->getPost()) {
            try {
                $customerData = Mage::getSingleton('customer/session')->getCustomer();

                $data['user_id'] = $customerData->getId();
                $data['created'] = date('Y-m-d H:i:s');
                $data['content'] = $data['text'];
//                print"<pre>";
//                var_dump($data);
//                die;
                $model = Mage::getModel('tttestimonials/testimonials');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                $this->_redirect('*/*/');
            } catch (Exception $e) {

                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
        }


        $this->loadLayout();
        $this->getLayout()->getBlock('testimonials.add');
        $this->renderLayout();
    }
}