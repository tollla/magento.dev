<?php




class DS_Manager_Block_Adminhtml_Manager_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('dsmanager');
        $model = Mage::registry('current_manager');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('manager_form', array('legend' => $helper->__('Manager Information')));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('secondName', 'text', array(
            'label' => $helper->__('Second Name'),
            'name' => 'secondName',
        ));

        $fieldset->addField('telephone', 'text', array(
            'label' => $helper->__('Telephone'),
            'name' => 'telephone',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => $helper->__('Email'),
            'name' => 'email',
        ));

        $fieldset->addField('photo', 'image', array(
            'label' => $helper->__('Photo'),
            'name' => 'photo',
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}
