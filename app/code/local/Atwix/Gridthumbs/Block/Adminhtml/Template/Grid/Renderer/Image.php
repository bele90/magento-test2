<?php
    class Atwix_Gridthumbs_Block_Adminhtml_Template_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
        public function render(Varien_Object $row)
        {
            $_product = Mage::getModel('catalog/product')->load($row->getEntityId());
            if($_product->getImage() != null && $_product->getImage() != 'no_selection'){
                $image = "<img src='".Mage::helper('catalog/image')->init($_product, 'thumbnail')->resize(60)."' title='".$_product->getName()."' width='60px' height='60px' />";
            } else {
                $image = "<img src='' width='60px' height='60px' />";
            }
            return $image;
        }
    }