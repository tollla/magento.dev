<?php



class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs_General extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {

        $helper = Mage::helper('dsmanager');
        $model = Mage::registry('current_manager');


        $form = new Varien_Data_Form();

        // title name tab
        $fieldset = $form->addFieldset('general_form', array(
            'legend' => $helper->__('General Information')
        ));

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

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}// Class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs_General End
