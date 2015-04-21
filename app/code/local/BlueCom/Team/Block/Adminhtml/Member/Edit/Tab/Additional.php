<?php
class BlueCom_Team_Block_Adminhtml_Member_Edit_Tab_Additional extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('member_form', array('legend'=>Mage::helper('bluecom_team')->__('Social links')));

        $fieldset->addField('birthdate', 'date', array(
            'name'      => 'birthdate',
            'label'     => Mage::helper('bluecom_team')->__('Birthday'),
            'title'     => Mage::helper('bluecom_team')->__('Birthday'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'required'  => false,
        ));
        $fieldset->addField('joineddate', 'date', array(
            'name'      => 'joineddate',
            'label'     => Mage::helper('bluecom_team')->__('Joined date'),
            'title'     => Mage::helper('bluecom_team')->__('Joined date'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'required'  => false,
        ));
        $fieldset->addField('taxid', 'text', array(
            'name'      => 'taxid',
            'label'     => Mage::helper('bluecom_team')->__('Personal tax ID'),
            'title'     => Mage::helper('bluecom_team')->__('Personal tax ID'),
            'required'  => false,
        ));
        $fieldset->addField('personalid', 'text', array(
            'name'      => 'personalid',
            'label'     => Mage::helper('bluecom_team')->__('Personal ID'),
            'title'     => Mage::helper('bluecom_team')->__('Personal ID'),
            'required'  => false,
        ));
        $fieldset->addField('address', 'editor', array(
            'name'      => 'address',
            'label'     => Mage::helper('bluecom_team')->__('Address'),
            'title'     => Mage::helper('bluecom_team')->__('Address'),
            'required'  => false,
        ));

        $fieldset->addField('material_status', 'select', array(
            'label'     => Mage::helper('bluecom_team')->__('Marial Status'),
            'name'      => 'material_status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('bluecom_team')->__('Single'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('bluecom_team')->__('Available'),
                ),
                array(
                    'value'     => 3,
                    'label'     => Mage::helper('bluecom_team')->__('Married'),
                ),
                array(
                    'value'     => 4,
                    'label'     => Mage::helper('bluecom_team')->__('Devorced'),
                ),
            ),
        ));
        /*
        $memberCollection = Mage::getModel('bluecom_team/member')->getCollection()
            ->addFieldToFilter('id', $this->getRequest()->getParam('id'));
        $file = $memberCollection->getData();
        if ($this->getRequest()->getParam('id')) {
            $documents = $file[0]['document'];
            $full_path = $file[0]['avatar'];
            $tag = $file[0]['tags'];
        } else {
            $documents = NULL;
            $full_path = '';
            $tag = '';
        }
        if ($documents) {
            $fieldset->addField('is_delete', 'checkbox', array(
                'name'      => 'is_delete',
                'label'     => Mage::helper('bluecom_team')->__('Delete File'),
                'after_element_html' => '<a href="' . Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'bluecom' . DS . $documents . '" >' . $documents. '</a>',
            ));

            $fieldset->addField('avatar', 'hidden', array(
                'name'       => 'avatar',
                'value'      => $full_path,
            ));
        }
        */

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

        $this->setForm($form);
        return $this;
    }

}
