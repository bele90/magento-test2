<?php
    class SmashingMagazine_BrandDirectory_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container {
        public function _construct() {
            parent::_construct();
            $this->_blockGroup = 'smashingmagazine_branddirectory_adminhtml';
            $this->_controller = 'brand';
            $this->_headerText = Mage::helper('smashingmagazine_branddirectory')->__('Brand Directory');
        }

        public function getCreateUrl() {
            return $this->getUrl('smashingmagazine_branddirectory_admin/brand/edit');
        }
    }