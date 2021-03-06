<?php
class BlueCom_Swatches_Block_Adminhtml_Catalog_Product_Attribute_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm() 
    {
        $form = new Varien_Data_Form(
            array(
                    'id' => 'edit_form', 
                    'action' => $this->getData('action'), 
                    'method' => 'post', 
                    'enctype' => "multipart/form-data"
                 )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
