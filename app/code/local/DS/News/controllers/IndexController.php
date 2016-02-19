<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 19.02.2016
 * Time: 1:37
 */
class DS_News_IndexController extends Mage_Core_Controller_Front_Action
{

//    public function indexAction()
//    {
//        $resource = Mage::getSingleton('core/resource');
//        $read = $resource->getConnection('core_read');
//        $table = $resource->getTableName('dsnews/table_news');
//
//        $select = $read->select()
//            ->from($table, array('news_id', 'title', 'content', 'created'))
//            ->order('created DESC');
//
//        $news = $read->fetchAll($select);
//        Mage::register('news', $news);
//
//        $this->loadLayout();
//        $this->renderLayout();
//    }
//
    public function indexAction()
    {
        $news = Mage::getModel('dsnews/news')->getCollection()->setOrder('created', 'DESC');
        $viewUrl = Mage::getUrl('news/index/view');

        echo '<h1>News</h1>';
        foreach ($news as $item) {
            echo '<h2><a href="' . $viewUrl . '?id=' . $item->getId() . '">' . $item->getTitle() . '</a></h2>';
        }
    }

    public function viewAction()
    {
        $newsId = Mage::app()->getRequest()->getParam('id', 0);
        $news = Mage::getModel('dsnews/news')->load($newsId);

        if ($news->getId() > 0) {
            echo '<h1>' . $news->getTitle() . '</h1>';
            echo '<div class="content">' . $news->getContent() . '</div>';
        } else {
            $this->_forward('noRoute');
        }
    }

}