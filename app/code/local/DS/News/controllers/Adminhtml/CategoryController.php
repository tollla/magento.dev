<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 23:13
 */

class DS_News_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('dsnews');

        $contentBlock = $this->getLayout()->createBlock('dsnews/adminhtml_category');
        $this->_addContent($contentBlock);

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('dsnews/category');

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $model->setData($data)->setId($id);
        } else {
            $model->load($id);
        }
        Mage::register('current_category', $model);

        $this->loadLayout()->_setActiveMenu('dsnews');

        $this->_addLeft($this->getLayout()->createBlock('dsnews/adminhtml_category_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('dsnews/adminhtml_category_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $categoryId = $this->getRequest()->getParam('id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('dsnews');
                $model = Mage::getModel('dsnews/category');

                $model->setData($data)->setId($categoryId);
                $model->save();

                $categoryId = $model->getId();
                $categoryNews = $model->getNewsCollection()->getAllIds();
                if ($selectedNews = $this->getRequest()->getParam('selected_news', null)) {
                    $selectedNews = Mage::helper('adminhtml/js')->decodeGridSerializedInput($selectedNews);
                } else {
                    $selectedNews = array();
                }

                $setCategory = array_diff($selectedNews, $categoryNews);
                $unsetCategory = array_diff($categoryNews, $selectedNews);

                foreach($setCategory as $id){
                    Mage::getModel('dsnews/news')->setId($id)->setCategoryId($categoryId)->save();
                }
                foreach($unsetCategory as $id){
                    Mage::getModel('dsnews/news')->setId($id)->setCategoryId(0)->save();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Category was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $categoryId
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
                Mage::getModel('dsnews/category')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Category was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('category', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('dsnews/category')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d news have been deleted', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select news'));
        }
        $this->_redirect('*/*');
    }

    public function newsAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('dsnews/category')->load($id);
        $request = Mage::app()->getRequest();

        Mage::register('current_category', $model);

        if ($request->isAjax()) {

            $this->loadLayout();
            $layout = $this->getLayout();

            $root = $layout->createBlock('core/text_list', 'root', array('output' => 'toHtml'));

            $grid = $layout->createBlock('dsnews/adminhtml_category_edit_tabs_news');
            $root->append($grid);

            if (!$request->getParam('grid_only')) {
                $serializer = $layout->createBlock('adminhtml/widget_grid_serializer');
                $serializer->initSerializerBlock($grid, 'getSelectedNews', 'selected_news', 'selected_news');
                $root->append($serializer);
            }

            $this->renderLayout();
        }
    }

}