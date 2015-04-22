<?php


class BlueCom_Swatches_Helper_Product extends Mage_Catalog_Helper_Product
{
    /**
     * Added a condition which will return true if products 
     * is child of configurable product.
     * Check if a product can be shown
     *
     * @param  Mage_Catalog_Model_Product|int $product
     * @return boolean
     */
    public function canShow($product, $where = 'catalog')
    {
        if (is_int($product)) {
            $product = Mage::getModel('catalog/product')->load($product);
        }

        /* @var $product Mage_Catalog_Model_Product */

        if (!$product->getId()) {
            return false;
        }

        if(!$product->isVisibleInCatalog() || !$product->isVisibleInSiteVisibility()){
            $productType = $this->getProductInfo($product->getId());
            if($productType == "configurable"){
                return true;
            }
        }
        return $product->isVisibleInCatalog() && $product->isVisibleInSiteVisibility();
    }

    /* 
        Get Parent id for give child
        returns : product type
    */
    public function getProductInfo($id) {
        $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($id);
        
        $parentProductInfo = Mage::getModel("catalog/product")->load($parentIds[0]);
        if(!empty($parentIds)){
            return $parentProductInfo->getTypeId();
        }else{
            return "";
        }
        
    }
}
