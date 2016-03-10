<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 03.03.2016
 * Time: 0:04
 */
class TT_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction(){
        $this->loadLayout();
        $this->_setActiveMenu('tttestimonials');


        $contentBlock = $this
            ->getLayout()
            ->createBlock('tttestimonials/adminhtml_testimonials');

        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction(){
        $this->_forward('edit');
    }

    public function editAction(){

        $this->loadLayout();
        $this->_setActiveMenu('tttestimonials');

        $id = (int) $this->getRequest()->getParam('id');

        Mage::register(
            'current_testimonials'
            , Mage::getModel('tttestimonials/testimonials')
                ->load($id)
        );


        $this->_addContent(
            $this->getLayout()
                ->createBlock('tttestimonials/adminhtml_testimonials_edit')
        );

        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('tttestimonials/testimonials');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('tttestimonials/testimonials')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('News was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('testimonials', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('tttestimonials/testimonials')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d testimonials have been deleted', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select testimonials'));
        }
        $this->_redirect('*/*');
    }
}