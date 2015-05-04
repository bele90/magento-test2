<?php
    class Atwix_CustomGrid_model_Observer {
        public function updateCustomColumn(Varien_Event_Observer $observer) {
            $block = $observer->getBlock();
            if(!isset($block)) {
                return $this;
            }



            if($block->getType() == 'adminhtml/customer_grid') {

                $block->addColumnAfter('middlename', array(
                    'header'    => 'Middle Name',
                    'type'      => 'text',
                    'index'     => 'middlename',
                ), 'name');
                //$block->removeColumn('billing_postcode');
            }
        }
    }