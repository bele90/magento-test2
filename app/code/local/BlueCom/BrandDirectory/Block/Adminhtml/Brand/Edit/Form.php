<?php
    class BlueComBrandDirectory_Block_Adminhtml_Brand_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
        protected function _prepareForm() {
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl(
                    'bluecom_branddirectory_admin/brand/edit',
                    array(
                        '_current' => true,
                        'continue' => 0,
                    )
                ),
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
                    'label' => 'Name',
                    'required' => true
                )
            );

            $fieldset->addField(
                'url_key',
                'text',
                array(
                    'label' => 'URL Key',
                    'required' => true,
                )
            );

            $fieldset->addField(
                'description',
                'textarea',
                array(
                    'label' => 'Description',
                    'required' => true,
                )
            );

            $fieldset->addField(
                'visibility',
                'select',
                array(
                    'label' => 'Visibility',
                    'required' => true,
                    'options' => $brandSingleton->getAvailableVisibilies(),
                )
            );

            $fieldset->addField(
                'image',
                'image',
                array(
                    'label' => 'Upload Image',
                    'required' => false,
                )
            );


            return $fieldset;
        }
    }