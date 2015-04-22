<?php
class BlueCom_Swatches_Block_Adminhtml_Catalog_Product_Attribute_Edit_Tab_Main extends Mage_Adminhtml_Block_Catalog_Product_Attribute_Edit_Tab_Main
{
    /**
     * Preparing default form elements for editing attribute
     *
     * @return Mage_Eav_Block_Adminhtml_Attribute_Edit_Main_Abstract
     */
    protected function _prepareForm()
    {
        parent::_prepareForm();
        if (Mage::registry('entity_attribute')->getIsGlobal() && Mage::registry('entity_attribute')->getIsConfigurable()) {
            $attributeId = Mage::app()->getRequest()->getParams();
            /* @var $form Varien_Data_Form */
            $form = $this->getForm();
            /* @var $fieldset Varien_Data_Form_Element_Fieldset */
            $fieldset = $form->addFieldset('swatches_fieldset',
                array('legend'=>Mage::helper('eav')->__('Swatches Properties'))
            );
           

            //$fieldset = $form->getElement('base_fieldset');
            $fieldset->addField(
                'useSwatches', 'select', array(
                'name' => 'useSwatches',
                'label' => $this->__('Use Swatches'),
                'title' => $this->__('Use Swatches'),
                'note' => $this->__('Keeping this yes will replace dropdowns to swatches for configurable products'),
                'values' => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
                'value' => Mage::helper('swatches')->getUseSwatches($attributeId['attribute_id'])
                 ));
             
        }
        return $this;
    }
}
