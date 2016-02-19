<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 16:42
 */

class DS_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('dsnews');

        $contentBlock = $this->getLayout()->createBlock('dsnews/adminhtml_news');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

}