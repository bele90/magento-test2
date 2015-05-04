<?php
    class SmashingMagazine_BrandDirectory_Model_Resource_Brand extends Mage_Core_Model_Resource_Db_Abstract {
        protected function _construct() {
            $this->_init('smashingmagazine_branddirectory/brand', 'entity_id');
        }
    }