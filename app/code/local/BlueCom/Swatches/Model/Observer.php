<?php

class BlueCom_Swatches_Model_Observer
{
    public function saveAttributesAfter($observer){

        $data = $observer->getControllerAction()->getRequest()->getPost();
        
        if($data['is_configurable'] && $data['is_global']){
            
            $baseDir = Mage::getBaseDir('media') . DIRECTORY_SEPARATOR . 
                                                        'swatches' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            
            if (isset($_FILES['swatches_img']) && isset($_FILES['swatches_img']['error']))
            {
                foreach($_FILES['swatches_img']['error'] as $optionId => $errorCode)
                {
                    if ($errorCode == UPLOAD_ERR_OK)
                    {
                        if (strpos($optionId, 'option') === false) {
                            move_uploaded_file($_FILES['swatches_img']['tmp_name'][$optionId], $baseDir . $optionId . '.jpg');
                        } else {
                            $newOptionId = Mage::getResourceHelper('importexport')->getNextAutoincrement(Mage::getSingleton ( 'core/resource' )->getTableName('eav/attribute_option'))-1;
                            move_uploaded_file($_FILES['swatches_img']['tmp_name'][$optionId], $baseDir . $newOptionId . '.jpg');
                        }
                    }
                }
            }

            if(Mage::app()->getRequest()->isPost('useSwatches'))
            {
                $confAttr = Mage::getModel('bluecom_swatches/attribute')->load($data['attribute_id'], 'attribute_id');
                if (!$confAttr->getId())
                {
                    $confAttr->setAttributeId($data['attribute_id']);
                }
                $confAttr->setUseSwatches(intval(Mage::app()->getRequest()->getPost('useSwatches')));
                $confAttr->save();
            }
            
            // $deleteArr = $data['swatches_img_delete'];
            if(isset($data['swatches_img_delete']) && !empty( $data['swatches_img_delete']))
            {
                foreach( $data['swatches_img_delete'] as $optionId => $value)
                {
                    if ($value)
                    {
                        unlink($baseDir . $optionId . '.jpg');
                    }
                }
            }
        }
    }

    public function onListBlockHtmlBefore($observer)    
    {
        $block              = $observer->getBlock();
        $transport          = $observer->getTransport();
        $html = $transport->getHtml();
        //$thisClass          = get_class($block);
        
        if (($block instanceof Mage_Catalog_Block_Product_List) && Mage::getStoreConfig('swatches/list/swatches_on_list')) {
            
            $collection  = null;
            if($productListlock = Mage::app()->getLayout()->getBlock('product_list')){
                // First make a copy, otherwise the rest of the page might be affected!
                $collection = clone $productListlock->getLoadedProductCollection();
            }
            elseif($productSearchlock = Mage::app()->getLayout()->getBlock('search_result_list')){
                $collection = $productSearchlock->getLoadedProductCollection();
            }
        
            foreach ($collection->getItems() as $item) {
                $productsIdList[] = $item->getEntityId();
            }
            
            foreach($productsIdList as $value => $productId){  
                $product = Mage::getModel('catalog/product')->load($productId);
                
                if($product->isSaleable() && $product->isConfigurable()){
                    $template = '@(product-price-'.$productId.'">(.*?)div>)@s';
                    preg_match_all($template, $html, $res);
                    if($res[0]){
                         $replace =  Mage::helper('swatches')->getSwatchesBlock($product, $res[1][0]);
                         if(strpos($html, $replace) === false) {
                            $html= str_replace($res[0][0], $replace, $html);
                         }
                    }
                }
            }
            $transport->setHtml($html);
        }
    }

    public function saveCatalogProductAfter($observer){
        
        $deleteArr = Mage::app()->getRequest()->getPost('swatches_img_delete');
        
        $productId = $observer->getProduct()->getData('entity_id');   
        
        $baseDir = Mage::getBaseDir('media') . DIRECTORY_SEPARATOR . 
                                                        'swatches' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;
            
        if (isset($_FILES['swatches_img']) && isset($_FILES['swatches_img']['error']))
        {
            foreach($_FILES['swatches_img']['error'] as $optionId => $errorCode)
            {
                if ($errorCode == UPLOAD_ERR_OK)
                {
                    move_uploaded_file($_FILES['swatches_img']['tmp_name'][$optionId], $baseDir . $productId.'-'.$optionId . '.jpg');
                }
            }
        }
        
        if(!empty($deleteArr))
        {
            foreach($deleteArr as $optionId => $value)
            {
                if ($value)
                {
                    unlink($baseDir . $productId.'-'.$optionId . '.jpg');
                }
            }
        }
    }
}
