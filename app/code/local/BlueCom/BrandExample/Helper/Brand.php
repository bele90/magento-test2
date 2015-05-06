<?php
class BlueCom_BrandExample_Helper_Brand extends Mage_Core_Helper_Abstract
{
    public function getBrandUrl(BlueCom_BrandDirectory_Model_Brand $brand)
    {
        if (!$brand instanceof BlueCom_BrandDirectory_Model_Brand) {
            return '#';
        }
        
        return $this->_getUrl(
            'bluecom_brandexample/index/view',
            array(
                'url' => $brand->getUrlKey(),
            )
        );
    }
}