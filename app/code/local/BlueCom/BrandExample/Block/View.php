<?php
class BlueCom_BrandExample_Block_View extends Mage_Core_Block_Template
{
    public function __construct() {
        parent::__construct();
        $collection = $this->getProductCollection();
        $this->setCollection($collection);
    }

    public function _prepareLayout() {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'bluecom.brandexample.pager');
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }

    public function getPagerHtml() {
        return $this->getChildHtml('pager');
    }

    public function getCurrentBrand()
    {
        return Mage::registry('current_brand');
    }
    
    public function getProductCollection()
    {
        $brand = $this->getCurrentBrand();
        if (!$brand) {
            return array();
        }
        
        return Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('brand_id', $brand->getId())
            ->setOrder('name', 'ASC');
    }
}