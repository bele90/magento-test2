<?php
$installer = $this;
$installer->startSetup();
$installer->run("CREATE TABLE IF NOT EXISTS `{$this->getTable('bluecom_swatches/attribute')}` (
  `entity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) unsigned NOT NULL,
  `use_swatches` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
");

$installer->endSetup();
