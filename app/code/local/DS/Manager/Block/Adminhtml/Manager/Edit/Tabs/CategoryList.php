<?php


class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs_CategoryList extends Mage_Adminhtml_Block_Widget
{

    protected function _toHtml()
    {
        $helper = Mage::helper('dsmanager');
        $model = Mage::registry('current_manager');

        $collection = Mage::getResourceModel('catalog/category_collection');

        $modelManagerToCategory = Mage::getModel('dsmanager/managerToCategory');
        $collectionManagerToCategory = $modelManagerToCategory->getCollection()->addManagerIdFilter($model->getManagerId());

        $collection->addAttributeToSelect('name')->load();

        $categories = array();
        foreach ($collectionManagerToCategory->getData() as $row) {
            $categories[$row['category_id']] = true;
        }

        $html = '';
        foreach ($collection as $category) {
            $html .= '<input type="checkbox" name="category[]" value="'.$category->getEntityId().'"';
            if (isset($categories[$category->getEntityId()])) {
                $html .= 'checked="checked"';
            }
            $html .= '> ';
            $level = $category->getLevel();
            for ($a = 0; $level > $a; $a++) {
                $html .='--';
            }
            $html .=' <label>'.$category->getName().'</label>';
            $html .= '<br>';
        }

        return $html;
    }

}// Class DS_Manager_Block_Adminhtml_Manager_Edit_Tabs_Custom End
