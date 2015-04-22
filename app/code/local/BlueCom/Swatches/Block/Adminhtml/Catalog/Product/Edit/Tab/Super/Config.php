<?php


class BlueCom_Swatches_Block_Adminhtml_Catalog_Product_Edit_Tab_Super_Config extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config
{
    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setProductId($this->getRequest()->getParam('id'));
        $this->setTemplate('bluecom/catalog/product/edit/super/config.phtml');
        $this->setId('config_super_product');
        $this->setCanEditPrice(true);
        $this->setCanReadPrice(true);
    }

    /**
     * Retrieve attributes data in JSON format
     *
     * @return string
     */
    public function getAttributesJson()
    {
        $attributes = $this->_getProduct()->getTypeInstance(true)
            ->getConfigurableAttributesAsArray($this->_getProduct());

        if(!$attributes) {
            return '[]';
        } else {
            // Hide price if needed
            foreach ($attributes as &$attribute) {
                if (isset($attribute['values']) && is_array($attribute['values'])) {
                    foreach ($attribute['values'] as &$attributeValue) {
                        if (!$this->getCanReadPrice()) {
                            $attributeValue['pricing_value'] = '';
                            $attributeValue['is_percent'] = 0;
                        }
                        $attributeValue['can_edit_price'] = $this->getCanEditPrice();
                        $attributeValue['can_read_price'] = $this->getCanReadPrice();
                        $attributeValue['option_id'] = $this->getAttributeOptionId($attribute['attribute_code'],$attributeValue['label']);
                        $optionImg =  Mage::helper('swatches')->getProductImageUrl($this->getRequest()->getParam('id'),$attributeValue['option_id']);
                        $attributeValue['option_img'] = $optionImg ? $optionImg : Mage::helper('swatches')->getUploadedImageUrl($attributeValue['option_id']);
                    }
                }
            }
        }

        return Mage::helper('core')->jsonEncode($attributes);
    }

    public function getAttributeOptionId($attributeCode,$optionValue){
        $attr = Mage::getModel('catalog/product')->getResource()->getAttribute($attributeCode);
        if ($attr->usesSource()){
            return $attr->getSource()->getOptionId($optionValue);
        }
    }
}
