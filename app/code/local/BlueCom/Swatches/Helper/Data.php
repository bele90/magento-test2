<?php


class BlueCom_Swatches_Helper_Data extends Mage_Core_Helper_Abstract
{    
    public function getUploadedImageUrl($attrValue)
    {
        $uploadDir = Mage::getBaseDir('media') . DIRECTORY_SEPARATOR . 
                                                    'swatches' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

        if (file_exists($uploadDir . $attrValue . '.jpg'))
        {
            return Mage::getBaseUrl('media') . 'swatches' . '/' . 'images' . '/' . $attrValue . '.jpg';
        }
        return '';
    }

    public function getSwatchesBlock($_product, $html)
    {
        $block = Mage::app()->getLayout()->createBlock(
                'BlueCom_Swatches_Block_Catalog_Product_View_Type_ConfigurableList',
                'swatches_catalog_product_view_type_configurable_list',
                array('template' => 'bluecom/swatches/configurable.phtml')
                );  
        $block->setProduct($_product);
        $block->setNameInLayout('product.info.options.configurable');
        
        $html .= '<div id="swatches-block">' . $block->toHtml() . '</div>';
        
        return $html;
    }

    public function getthumbImageSize()
    {
        return Mage::getStoreConfig('swatches/list/thumb_img_size_list');
    } 

    public function getOptionsImageSize()
    {
        return Mage::getStoreConfig('swatches/list/img_size_list');
    } 

    public function getOptionsImageSizePDP()
    {
        return Mage::getStoreConfig('swatches/pdp/img_size_pdp');
    } 

    public function getUseSwatches($attributeId)
    {
        $confAttr = Mage::getModel('bluecom_swatches/attribute')->load($attributeId, 'attribute_id');
        return array($confAttr->getUseSwatches());
    }

    public function getProductImageUrl($productId,$optionId)
    {
        $attrValue = $productId."-".$optionId;
        
        $uploadDir = Mage::getBaseDir('media') . DIRECTORY_SEPARATOR . 
                                                    'swatches' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;

        if (file_exists($uploadDir . $attrValue . '.jpg'))
        {
            return Mage::getBaseUrl('media') . 'swatches' . '/' . 'products' . '/' . $attrValue . '.jpg';
        }
        return '';
    }

    public function getSwatchesBasedOnPriority($attrValue,$productId)
    {
        $productLevelSwatches = $this->getProductImageUrl($productId,$attrValue);
        
        if(!empty($productLevelSwatches)){
            return $productLevelSwatches;
        }else{
            return $this->getUploadedImageUrl($attrValue);
        }
    }
}
