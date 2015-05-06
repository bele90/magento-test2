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

            $collection = Mage::getModel('bluecom_branddirectory/brand')->getCollection()
                ->addFieldToFilter('visibility', BlueCom_BrandDirectory_Model_Brand::VISIBILITY_DIRECTORY)
                ->setOrder('entity_id', 'ASC');

            foreach($collection as $brand) {
                $tree = $node->getTree();
                $data = array(
                    'name' => $brand->getName(),
                    'id' => 'brand-node-'.$brand->getId(),
                    'url' => Mage::getUrl().'brand/index/view/url/'.$brand->getUrlKey(),
                );

                $subNode = new Varien_Data_Tree_Node($data, 'id', $tree, $node);
                $node->addChild($subNode);
            }
        }
    }