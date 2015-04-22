<?php

class BlueCom_Swatches_Block_Catalog_Product_View_Type_Configurable extends Mage_Catalog_Block_Product_View_Type_Configurable
{
    protected $childProducts;
    
    protected function _afterToHtml($html) {
        $attributeIdsWithImages = Mage::registry('swatches_allowed_ids');
        $confData = array();
        $html = parent::_afterToHtml($html);
        if ('product.info.options.configurable' == $this->getNameInLayout() && Mage::getStoreConfig('swatches/default/show_swatches')) {
            if (!empty($attributeIdsWithImages)) {
                foreach ($attributeIdsWithImages as $attrIdToHide) {
                    $html = preg_replace('@(id="attribute' . $attrIdToHide . ')(-)?([0-9]*)(")(\s+)(class=")(.*?)(super-attribute-select)(-)?([0-9]*)@', '$1$2$3$4$5$6$7$8$9$10 no-display', $html);
                }
            }
            $simpleProducts = $this->getProduct()->getTypeInstance(true)->getUsedProducts(null, $this->getProduct());

            if ($this->childProducts) {
                $this->childProducts = array_values($this->childProducts);

                foreach ($simpleProducts as $simple) {
                    $key = array();
                    for ($i = 0; $i < count($this->childProducts); $i++) {
                        foreach ($this->childProducts[$i] as $optionId => $productIds) {
                            if (in_array($simple->getId(), $productIds)) {
                                $key[] = $optionId;
                            }
                        }
                    }
                    if ($key) {
                        $strKey = implode(',', $key);

                        if ($simple->getImage()) {
                            $imgGallery = Mage::getModel('catalog/product')->load($simple->getId())->getMediaGalleryImages();
                            $i = 0;
                            if ($simple->getImage() == 'no_selection') {
                                $confData[$strKey]['media_url'][$i]['label'] = $simple->getImageLabel();
                                $confData[$strKey]['media_url'][$i]['url'] = $this->getSkinUrl('images/catalog/product/placeholder/image.jpg');
                                $confData[$strKey]['media_url'][$i]['galleryUrl'] = $this->getSkinUrl('images/catalog/product/placeholder/image.jpg');
                            } else {
                                $confData[$strKey]['media_url'][$i]['label'] = $simple->getImageLabel();
                                $confData[$strKey]['media_url'][$i]['url'] = Mage::helper('catalog/output')->productAttribute($simple, Mage::helper('catalog/image')->init($simple, 'image')->resize(265), 'image')->__toString();
                                $confData[$strKey]['media_url'][$i]['galleryUrl'] = Mage::helper('catalog/image')->init($simple, 'image');
                            }
                           
                            if(count($imgGallery) > 0) {
                            foreach ($imgGallery as $_image) {
                                ++$i;
                                $params = array('id' => $simple->getId(), 'image' => $_image->getValueId());
                                $galleryUrl = $this->getUrl('catalog/product/gallery', $params);
                                    $confData[$strKey]['media_url'][$i]['label'] = $_image->getLabel();
                                    $confData[$strKey]['media_url'][$i]['url'] = $_image->getUrl();
                                    $confData[$strKey]['media_url'][$i]['galleryUrl'] = $galleryUrl;
                            } }
                            else {
                                     $confData[$strKey]['media_url'][1]['label'] = '';
                                    $confData[$strKey]['media_url'][1]['url'] = '';
                                    $confData[$strKey]['media_url'][1]['galleryUrl'] = '';
                            }
                           
                        }
                    }
                }
                $html .= '<script type="text/javascript"> additionalData = new PDPSwatchesData(' . Zend_Json::encode($confData) . '); </script>';
            }
        }

        return $html;
    }

    public function getJsonConfig() {

        $jsonConfig = parent::getJsonConfig();
        $config = Zend_Json::decode($jsonConfig);
        $swatchesIds = array();
        if (Mage::getStoreConfig('swatches/default/show_swatches')) {
            foreach ($config['attributes'] as $attributeId => $attribute) {
                $attrSwatches = Mage::getModel('bluecom_swatches/attribute')->load($attributeId, 'attribute_id');

                if ($attrSwatches->getUseSwatches()) {
                    $config['attributes'][$attributeId]['swatches_size'] = Mage::helper('swatches')->getOptionsImageSizePDP();
                    $config['attributes'][$attributeId]['use_swatches'] = 1;
                    $swatchesIds[] = $attributeId;
                    foreach ($attribute['options'] as $i => $option) {
                        $this->childProducts[$attributeId][$option['id']] = $option['products'];
                        $config['attributes'][$attributeId]['options'][$i]['image'] = Mage::helper('swatches')->getSwatchesBasedOnPriority($option['id'], $this->getProduct()->getEntityId());
                    }
                }
            }
            Mage::unregister('swatches_allowed_ids');
            Mage::register('swatches_allowed_ids', $swatchesIds, true);
        }
        return Zend_Json::encode($config);
    }
}
