<?php
    class Basetut_Salestaff_Block_Adminhtml_Staff extends Mage_Adminhtml_Block_Widget_Grid_Container {
        public function __construct() {
            $this->_controller = 'adminhtml_staff';
            $this->_blockGroup = 'salestaff'; //tên module
            $this->_headerText = Mage::helper('salestaff')->__('Staff Manager');
            parent::__construct();
            //$this->removeButton('add');
        }
    }