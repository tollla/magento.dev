<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 20.02.2016
 * Time: 1:16
 */

class DS_News_Block_Adminhtml_Category_Edit_Tabs_News extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('categoryNewsGrid');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::registry('current_category')->getNewsCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('dsnews');

        $this->addColumn('ajax_grid_news_id', array(
            'header' => $helper->__('News ID'),
            'index' => 'news_id',
            'width' => '100px',
        ));

        $this->addColumn('ajax_grid_title', array(
            'header' => $helper->__('Title'),
            'index' => 'title',
            'type' => 'text',
        ));

        $this->addColumn('ajax_grid_created', array(
            'header' => $helper->__('Created'),
            'index' => 'created',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/news', array('_current' => true));
    }

}