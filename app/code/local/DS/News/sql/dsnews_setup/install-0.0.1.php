<?php
/**
 * Created by PhpStorm.
 * User: Anatoli
 * Date: 18.02.2016
 * Time: 17:45
 */
//die("module !!!".__FILE__.":".__LINE__);
$installer = $this;
$installer->startSetup();
$installer->run("
    create table ds_news_entities(
      `news_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `title` VARCHAR(255) NOT NULL,
      `content` TEXT NOT NULL,
      `created` DATETIME,
      PRIMARY KEY (`news_id`)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();