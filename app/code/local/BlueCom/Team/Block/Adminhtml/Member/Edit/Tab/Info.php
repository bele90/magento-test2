<?php
class BlueCom_Team_Block_Adminhtml_Member_Edit_Tab_Info extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('member_form', array('legend'=>Mage::helper('bluecom_team')->__('Personal information')));
        $model =  Mage::registry('bluecom_team_member');
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('firstname', 'text', array(
            'name'      => 'firstname',
            'label'     => Mage::helper('bluecom_team')->__('First Name'),
            'title'     => Mage::helper('bluecom_team')->__('First Name'),
            'required'  => true,
        ));
        $fieldset->addField('lastname', 'text', array(
            'name'      => 'lastname',
            'label'     => Mage::helper('bluecom_team')->__('Last Name'),
            'title'     => Mage::helper('bluecom_team')->__('Last Name'),
            'required'  => true,
        ));
        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('bluecom_team')->__('Email'),
            'title'     => Mage::helper('bluecom_team')->__('Email'),
            'required'  => true,
        ));
        $fieldset->addField('cellphone', 'text', array(
            'name'      => 'cellphone',
            'label'     => Mage::helper('bluecom_team')->__('Cell Phone'),
            'title'     => Mage::helper('bluecom_team')->__('Cell Phone'),
            'required'  => false,
        ));
        $fieldset->addField('gender', 'select', array(
            'label'     => Mage::helper('bluecom_team')->__('Gender'),
            'name'      => 'gender',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('bluecom_team')->__('Male'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('bluecom_team')->__('Female'),
                ),
            ),
        ));
        $departments = array();
        $collection = Mage::getModel('bluecom_team/department')->getCollection()->setOrder('name', 'asc');
        $nonEscapableNbspChar = html_entity_decode('&#160;', ENT_NOQUOTES, 'UTF-8');
        foreach ($collection as $dep) {
            $departments[] = ( array(
                'label' => $dep->getName(),
                'value' => $dep->getId()
            ));
        }
        $fieldset->addField('department_id', 'multiselect', array(
            'name'      => 'departments[]',
            'label'     => Mage::helper('bluecom_team')->__('Department'),
            'title'     => Mage::helper('bluecom_team')->__('Department'),
            'required'  => false,
            'values'    => $departments,
            'size'      => 10,
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('bluecom_team')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('bluecom_team')->__('Enabled'),
                ),

                array(
                    'value'     => 2,
                    'label'     => Mage::helper('bluecom_team')->__('Disabled'),
                ),
            ),
        ));

        if (Mage::getSingleton('adminhtml/session')->getMemberData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getMemberData());
            Mage::getSingleton('adminhtml/session')->getMemberData(null);
        } elseif ( Mage::registry('bluecom_team_member') ) {
            $data = Mage::registry('bluecom_team_member');
            if (($data->getImageShortContent() == $data->getImageFullContent()) || $data->getImageShortContent() == '' || !$data->getImageShortContent()) {
                $data->setUseFullImg(1);
            }
            $form->setValues($data->getData());
        }

        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
        }

        $this->setForm($form);
        return $this;
    }
}
