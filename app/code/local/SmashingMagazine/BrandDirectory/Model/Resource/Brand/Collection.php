<?php
    class SmashingMagazine_BrandDirectory_Model_Resource_Brand_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
        protected function _construct() {
            parent::_construct();
            $this->_init(
                'smashingmagazine_branddirectory/brand',
                'smashingmagazine_branddirectory/brand'
            );
        }
    }