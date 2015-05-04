<?php
    class Atwix_ExtendedGrid_Helper_Data extends Mage_Core_Helper_Abstract {
        public function getSkusColumnParams() {
            return array(
                'header' => 'SKUs',
                'index' => 'skus',
                'type' => 'text',
                'filter_condition_callback' => array('Atwix_ExtendedGrid_Model_Observer', 'filterSkus'),
            );
        }
    }