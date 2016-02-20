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
        $this->setDefaultFilter(array('ajax_grid_in_category' => 1));
        $this->setId('categoryNewsGrid');
        $this->setSaveParametersInSession(false);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dsnews/news')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('dsnews');

        $this->addColumn('ajax_grid_in_category', array(
            'align' => 'center',
            'header_css_class' => 'a-center',
            'index' => 'news_id',
            'type' => 'checkbox',
            'values' => $this->getSelectedNews(),
        ));

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

    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'ajax_grid_in_category') {
            $collection = $this->getCollection();
            $selectedNews = $this->getSelectedNews();
            if ($column->getFilter()->getValue()) {
                $collection->addFieldToFilter('news_id', array('in' => $selectedNews));
            } elseif (!empty($selectedNews)) {
                $collection->addFieldToFilter('news_id', array('nin' => $selectedNews));
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }
        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/news', array('_current' => true, 'grid_only' => 1));
    }

    public function getSelectedNews()
    {
        if (!isset($this->_data['selected_news'])) {
            $selectedNews = Mage::app()->getRequest()->getParam('selected_news', null);
            if(is_null($selectedNews) || !is_array($selectedNews)){
                $category = Mage::registry('current_category');
                $selectedNews = $category->getNewsCollection()->getAllIds();
            }
            $this->_data['selected_news'] = $selectedNews;
        }
        return $this->_data['selected_news'];
    }

}