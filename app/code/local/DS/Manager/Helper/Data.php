<?php


/**
 * DSManager Data helper
 *
 * @category   DS
 * @package    DS_Manager
 * @author     Team <anatolii.web@gmail.com>
 */
class DS_Manager_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getImagePath($id = 0)
    {
        $path = Mage::getBaseDir('media').'/ds_manager';
        if ( $id ) {
            return "{$path}/{$id}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'ds_manager/';
        if (empty($id)) {
            return $url;
        } else {
            return $url . $id . '.jpg';
        }
    }

}// Class DS_Manager_Helper_Data End
