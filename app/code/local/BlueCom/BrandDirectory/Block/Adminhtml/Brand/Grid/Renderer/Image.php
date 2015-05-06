<?php
    class BlueCom_BrandDirectory_Block_Adminhtml_Brand_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
        public function render(Varien_Object $row) {
            $_brand = Mage::getModel('bluecom_branddirectory/brand')->load($row->getId());

            if($_brand->getImage() != null && $_brand->getImage() != 'no_selection') {
                $image = "<img src='".Mage::getBaseUrl('media')."brand/".$_brand->getImage()."' width='60px' height='60px'/>";
            } else {
                $image = "<img src='' width='60px' height='60px' />";
            }
            return $image;
        }
    }