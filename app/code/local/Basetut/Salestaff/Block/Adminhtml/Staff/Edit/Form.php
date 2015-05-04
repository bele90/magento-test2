<?php
    class Basetut_Salestaff_Block_Adminhtml_Staff_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

        protected function _prepareForm()
        {
            $form = new Varien_Data_Form(array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post'
            ));
            $form->setUseContainer(true);
            $this->setForm($form);

            if (Mage::getSingleton('adminhtml/session')->getSalestaffData()) {
                $data = Mage::getSingleton('adminhtml/session')->getSalestaffData();
                Mage::getSingleton('adminhtml/session')->setSalestaffData(null);
            } elseif (Mage::registry('salestaff_data')) {
                $data = Mage::registry('salestaff_data')->getData();
            }
            $fieldset = $form->addFieldset('salestaff_form', array(
                'legend'=>Mage::helper('salestaff')->__('Staff Information')
            ));

            /*Edit truong kieu text*/
            $fieldset->addField('firstname', 'text', array(
                'label' => Mage::helper('salestaff')->__('First Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'firstname',
            ));

            $fieldset->addField('lastname', 'text', array(
                'label' => Mage::helper('salestaff')->__('Last Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'lastname',
            ));

            /*Edit truong kieu date*/
            $fieldset->addField('birthday', 'date', array(
                'label' => Mage::helper('salestaff')->__('Birthday'),
                'name' => 'birthday',
                'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                'image' => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'/adminhtml/default/default/images/grid-cal.gif',
            ));
            /*Edit truong kieu select*/
            $fieldset->addField('sex', 'select', array(
                'label' => Mage::helper('salestaff')->__('Sex'),
                'name' => 'sex',
                'onclick' => "",
                'onchange' => "",
                'values' => array('-1'=>'Please Select..','1' => 'Male','2' => 'Female'),
                'disabled' => false,
                'readonly' => false,
                'tabindex' => 1
            ));

            $fieldset->addField('status', 'select', array(
                'label' => Mage::helper('salestaff')->__('Status'),
                'name' => 'status',
                'onclick' => "",
                'onchange' => "",
                'values' => array('-1'=>'Please Select..','1' => 'Enable','2' => 'Disable'),
                'disabled' => false,
                'readonly' => false,
                'tabindex' => 1
            ));

            $form->setValues($data);
            return parent::_prepareForm();
        }
    }