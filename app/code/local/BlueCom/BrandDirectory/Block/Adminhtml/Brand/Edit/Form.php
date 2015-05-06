<?php
    class BlueCom_BrandDirectory_Block_Adminhtml_Brand_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

        public function _prepareForm() {
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ));
            $form->setUseContainer(true);
            $this->setForm($form);

            $fieldset = $form->addFieldset(
                'general',
                array(
                    'legend' => $this->__('Brand Details')
                )
            );

            $brandSingleton = Mage::getSingleton(
                'bluecom_branddirectory/brand'
            );

            $fieldset->addField(
                'name',
                'text',
                array(
                    'label' => Mage::helper('bluecom_brandexample/brand')->__('Name'),
                    'required' => true,
                    'name' => 'name',
                )
            );

            $fieldset->addField(
                'url_key',
                'text',
                array(
                    'label' => Mage::helper('bluecom_brandexample/brand')->__('URL Key'),
                    'required' => true,
                    'name' => 'url_key',
                )
            );

            $fieldset->addField(
                'description',
                'textarea',
                array(
                    'label' => Mage::helper('bluecom_brandexample/brand')->__('Description'),
                    'required' => true,
                    'name' => 'description',
                )
            );

            $fieldset->addField(
                'visibility',
                'select',
                array(
                    'label' => Mage::helper('bluecom_brandexample/brand')->__('Visibility'),
                    'required' => true,
                    'options' => $brandSingleton->getAvailableVisibilies(),
                    'name' => 'visibility'
                )
            );

            $fieldset->addField(
                'image',
                'image',
                array(
                    'label' => Mage::helper('bluecom_brandexample/brand')->__('Upload Image'),
                    'required' => false,
                    'name' => 'image',
                )
            );
            if(Mage::getSingleton('adminhtml/session')->getBrandData()) {
                $form->setValues(Mage::getSingleton('adminhtml/session')->getBrandData());
                Mage::getSingleton('adminhtml/session')->setBrandData(null);
            } elseif(Mage::registry('brand_data')) {
                $form->setValues(Mage::registry('brand_data')->getData());
            }

            return parent::_prepareForm();
        }
    }