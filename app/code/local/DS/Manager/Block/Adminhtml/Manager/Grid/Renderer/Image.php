<?php
/**
 * Created by PhpStorm.
 * User: Anatoli
 * Date: 25.09.2016
 * Time: 13:43
 */


class  DS_Manager_Block_Adminhtml_Manager_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $helper = Mage::helper('dsmanager');
        $id = $row->getManagerId();
        $imageUrl = $helper->getImageUrl($id);
        $imagePath = $helper->getImagePath($id);
        if(file_exists($imagePath)){
            return "<img src=". $imageUrl ." width='97px'/>";
        }

        return null;
    }
}
