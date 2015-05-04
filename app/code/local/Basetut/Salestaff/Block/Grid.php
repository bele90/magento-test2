<?php
    class Basetut_Salestaff_Block_Grid extends Mage_Core_Block_Template {
        public function __construct() {
            parent::__construct();
            $collection = $this->getStaffCollection();
            $this->setCollection($collection);
        }

        public function _preparelayout() {
            parent::_prepareLayout();
            $pager = $this->getLayout()->createBlock('page/html_pager', 'salestaff.pager');
            $pager->setAvailableLimit(array(5=>5, 10=>10, 20=>20, 50=>50, 'All'=>'All'));
            $pager->setCollection($this->getCollection());
            $this->setChild('pager', $pager);
            $this->getCollection()->load();
            return $this;
        }

        public function getPagerHtml() {
            return $this->getChildHtml('pager');
        }

        public function getStaffCollection() {
            $collection = Mage::getModel('salestaff/staff')->getCollection();
            $collection->setOrder('staff_id', 'desc');
            return $collection;
        }

        public function getSexLabel($staff) {
            if($staff->getId()) {
                if($staff->getSex() == 1) {
                    return Mage::helper('salestaff')->__('Male');
                } else {
                    return Mage::helper('salestaff')->__('Female');
                }
            }
        }

        public function getStatusLabel($staff) {
            if($staff->getId()) {
                if($staff->getStatus() == 1) {
                    return Mage::helper('salestaff')->__('Enable');
                } else {
                    return Mage::helper('salestaff')->__('Disable');
                }
            }
        }
    }