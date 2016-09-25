<?php


/**
 * manager grid
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 */
class DS_Manager_Block_Adminhtml_Manager_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dsmanager/manager')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('dsmanager');

        $this->addColumn('manager_id', array(
            'header'        => $helper->__('Manager ID'),
            'index'         => 'manager_id',
            'type'          =>  'int'
        ));

        $this->addColumn('name', array(
            'header'        => $helper->__('Name'),
            'align'         => 'right',
            'index'         => 'name',
            'type'          => 'text',
        ));

        $this->addColumn('secondName', array(
            'header'        => $helper->__('Second Name'),
            'align'         => 'right',
            'index'         => 'secondName',
            'type'          => 'text',
        ));

        $this->addColumn('telephone', array(
            'header'        => $helper->__('Telephone'),
            'index'         => 'telephone',
            'type'          => 'text',
        ));

        $this->addColumn('email', array(
            'header'        => $helper->__('Email'),
            'index'         => 'email',
            'type'          => 'text',
        ));

        $this->addColumn('photo', array(
            'header' => Mage::helper('catalog')->__('Photo'),
            'align' => 'left',
            'index' => 'photo',
            'width'     => '97',
            'renderer' => 'DS_Manager_Block_Adminhtml_Manager_Grid_Renderer_Image'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('manager_id');
        $this->setMassactionBlock()->setFormFieldName('manager');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' =>  $this->__('Delete'),
            'url'   =>  $this->getUrl('*/*/massDelete')
        ));

        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId()
        ));
    }
}
