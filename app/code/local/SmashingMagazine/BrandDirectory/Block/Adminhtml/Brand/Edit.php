<?php
    class SmashingMagazine_BrandDirectory_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
        protected function _construct() {
            $this->_blockGroup = 'smashingmagazine_branddirectory_adminhtml';
            $this->_controller = 'brand';
            $this->_mode = 'edit';

            $newOrEidt = $this->getRequest()->getParam('id')
                ? $this->__('Edit')
                : $this->__('New');
            $this->_headerText = $newOrEidt . ' ' . $this->__('Brand');
        }
    }