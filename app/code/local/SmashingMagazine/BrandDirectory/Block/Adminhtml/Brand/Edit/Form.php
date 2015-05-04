<?php
    class SmashingMagazine_BrandDirectory_Block_Adminhtml_Brand_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
        protected function _prepareForm() {
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl(
                    'smashingmagazine_branddirectory_admin/brand/edit',
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
                'smashingmagazine_branddirectory/brand'
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
            /*$this->_addFieldsToFieldset($fieldset, array(
                'name' => array(
                    'label' => $this->__('Name'),
                    'input' => 'text',
                    'required' => true,
                ),

                'url_key' => array(
                    'label' => $this->__('URL Key'),
                    'input' => 'text',
                    'required' => true,
                ),

                'description' => array(
                    'label' => $this->__('Description'),
                    'input' => 'textarea',
                    'required' => true,
                ),

                'visibility' => array(
                    'label' => $this->__('Visibility'),
                    'input' => 'select',
                    'required' => true,
                    'options' => $brandSingleton->getAvailableVisibilies(),
                )
            ));*/

            return $fieldset;
        }

        /*protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields) {

            $requestData = new Varien_Object($this->getRequest()->getPost('brandData'));
            foreach($fields as $name => $_data) {
                if($requestValue = $requestData->getData($name)) {
                    $_data['value'] = $requestValue;
                }

                $_data['name'] = "brandData[$name]";

                $_data['title'] = $_data['label'];

                if(!array_key_exists('value', $_data)) {
                    $_data['value'] = $this->_getBrand()->_getData($name);
                }

                $fieldset->addField($name, $_data['input'], $_data);
            }
        }*/

        /*protected function _getBrand() {
            if(!$this->hasData('brand')) {
                $brand = Mage::registry('current_brand');

                if(!$brand instanceof SmashingMagazine_BrandDirectory_Model_Brand) {
                    $brand = Mage::getModel(
                        'smashingmagazine_branddirectory/brand'
                    );
                }
                $this->getData('brand', $brand);
            }

            return $this->getData('brand');
        }*/
    }