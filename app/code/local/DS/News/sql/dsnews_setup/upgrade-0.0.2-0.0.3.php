<?php
/**
 * Created by PhpStorm.
 * User: tolla-nout
 * Date: 20.02.2016
 * Time: 22:50
 */
//echo '<h1>Upgrade DS News to version 0.0.3</h1>';
//exit;

$installer = $this;
$tableNews = $installer->getTable('dsnews/table_news');

$installer->startSetup();
$installer->getConnection()
    ->addColumn($tableNews, 'link', array(
        'comment'   => 'News URL link',
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => '255',
        'nullable'  => true,
    ));

$installer->getConnection()
    ->addKey($tableNews, 'IDX_UNIQUE_NEWS_LINK', 'link', Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE);


foreach (Mage::getModel('dsnews/news')->getCollection() as $news) {
    try {
        $news->load($news->getId())->setDataChanges(true)->save();
    } catch (Exception $e) {
        $news->setId($news->getId())->setLink($news->getId())->save();
    }
}

$installer->endSetup();