<?php
    class BlueCom_BrandDirectory_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container {
        public function _construct() {
            parent::_construct();
            $this->_blockGroup = 'bluecom_branddirectory_adminhtml';
            $this->_controller = 'brand';
            $this->_headerText = Mage::helper('bluecom_branddirectory')->__('Brand Directory');
        }

        public function getCreateUrl() {
            return $this->getUrl('bluecom_branddirectory_admin/brand/edit');
        }
    }