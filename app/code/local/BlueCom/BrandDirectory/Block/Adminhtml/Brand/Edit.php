<?php
    class BlueCom_BrandDirectory_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
        public function __construct() {
            parent::__construct();
            $this->_blockGroup = 'bluecom_branddirectory_adminhtml';
            $this->_controller = 'brand';
            $this->_mode = 'edit';

            $newOrEdit = $this->getRequest()->getParam('id')
                ? $this->__('Edit')
                : $this->__('New');
            $this->_headerText = $newOrEdit . ' ' . $this->__('Brand');
        }
    }