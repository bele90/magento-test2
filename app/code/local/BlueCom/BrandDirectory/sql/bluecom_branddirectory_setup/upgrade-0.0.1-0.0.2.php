<?php

$this->startSetup();
$this->getConnection()
    ->addColumn($this->getTable('bluecom_branddirectory/brand'),
        'image',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'nullable' => true,
            'comment' => 'Image'
        )
    );
$this->endSetup();
