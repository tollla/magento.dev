<?php



/**
 * DSManager main controller
 *
 * @category   DS
 * @package    DSManager
 * @author     Team <anatolii.web@gmail.com>
 */
class DS_Manager_Adminhtml_ManagerController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Show list managers
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('dsmanager');

        $contentBlock = $this->getLayout()->createBlock('dsmanager/adminhtml_manager');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    /**
     * Create new field
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit field
     */
    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('dsmanager/manager');

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $model->setData($data)->setId($id);
        } else {
            $model->load($id);
        }

        Mage::register('current_manager', $model);

        $this->loadLayout()->_setActiveMenu('dsmanager');
        $this->_addLeft($this->getLayout()->createBlock('dsmanager/adminhtml_manager_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('dsmanager/adminhtml_manager_edit'));
        $this->renderLayout();
    }

    /**
     * Save all the entities in the collection
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                // unset field photo
                unset($data['photo']);

                $helper = Mage::helper('dsmanager');
                $model = Mage::getModel('dsmanager/manager');
                $modelManagerToCategory = Mage::getModel('dsmanager/managerToCategory');
                $collectionManagerToCategory = $modelManagerToCategory->getCollection();

                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();

                $id = $model->getId();

                // clear
                foreach ($collectionManagerToCategory->addManagerIdFilter($id) as $row) {
                    $modelManagerToCategory->setId($row->getId())->delete();
                }

                if (isset($data['category'])) {
                    foreach ($data['category'] as $category_id) {
                        $modelManagerToCategory->setData(array('manager_id'=>$id, 'category_id'=>$category_id));
                        if (!$modelManagerToCategory->getCreated()) {
                            $modelManagerToCategory->setCreated(now());
                        }
                        $modelManagerToCategory->save();
                    }
                }

                if (empty($_FILES['photo']['error']) && $_FILES['photo']['name'] != '') {

                    $uploader = new Varien_File_Uploader('photo');

                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg'); // Upload the image
                    $model->setData(array('photo' => 'ds_manager/'.$id.'.jpg'))->setId($id);
                    $model->save();
                } else {
                    if (isset($data['photo']['delete']) && $data['photo']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Manager was saved successfully'));
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

    /**
     * Remove field
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('dsmanager/manager')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Manager was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Remove checked field
     */
    public function massDeleteAction()
    {
        $manager = $this->getRequest()->getParam('manager', null);

        if (is_array($manager) && sizeof($manager) > 0) {
            try {
                foreach ($manager as $id) {
                    Mage::getModel('dsmanager/manager')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d manager have been deleted', sizeof($manager)));
            } catch (Exception $e){
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select manager'));
        }

        $this->_redirect('*/*');
    }
} // Class DS_Manager_Adminhtml_ManagerController End
