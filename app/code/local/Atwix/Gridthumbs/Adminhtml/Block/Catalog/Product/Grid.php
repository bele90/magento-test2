<?php
    class Atwix_Gridthumbs_Adminhtml_Block_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid {
        protected function _prepareColumns() {
            $this->addColumnAfter('image', array(
                'header' => Mage::helper('catalog')->__('Image'),
                'align' => 'center',
                'index' => 'entity_id',
                'filter' => false,
                'width' => '70',
                'renderer' => 'Atwix_Gridthumbs_Block_Adminhtml_Template_Grid_Renderer_Image'
            ), 'name');
            return parent::_prepareColumns();
        }
    }