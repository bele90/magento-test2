<?php
    class BlueCom_BrandExample_Model_Observer {
        public function addToTopMenu(Varien_Event_Observer $observer) {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $node = new Varien_Data_Tree_Node(array(
                'name' => 'BRANDS',
                'id' => 'brands',
                'url' => Mage::getUrl().'brand/',
            ), 'id', $tree, $menu);

            $menu->addChild($node);
        }
    }