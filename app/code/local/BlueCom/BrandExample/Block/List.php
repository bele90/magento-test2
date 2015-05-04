<?php
class BlueCom_BrandExample_Block_List extends Mage_Core_Block_Template
{
    public function getBrandCollection()
    {
        return Mage::getModel('bluecom_branddirectory/brand')->getCollection()
            ->addFieldToFilter('visibility', BlueCom_BrandDirectory_Model_Brand::VISIBILITY_DIRECTORY)
            ->setOrder('entity_id', 'ASC');
    }
}