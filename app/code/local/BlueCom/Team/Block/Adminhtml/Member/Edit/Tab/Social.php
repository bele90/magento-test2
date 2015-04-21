<?php
class BlueCom_Team_Block_Adminhtml_Member_Edit_Tab_Social extends Mage_Adminhtml_Block_Widget_Form
{
    public function initForm()
    {
        $form = new Varien_Data_Form();
        $fieldset = $form->addFieldset('member_form', array('legend'=>Mage::helper('bluecom_team')->__('Social links')));

        $fieldset->addField('skype', 'text', array(
            'name'      => 'skype',
            'label'     => Mage::helper('bluecom_team')->__('Skype ID'),
            'title'     => Mage::helper('bluecom_team')->__('Skype ID'),
            'required'  => false,
        ));
        $fieldset->addField('yahoo', 'text', array(
            'name'      => 'yahoo',
            'label'     => Mage::helper('bluecom_team')->__('Yahoo ID'),
            'title'     => Mage::helper('bluecom_team')->__('Yahoo ID'),
            'required'  => false,
        ));
        $fieldset->addField('facebook', 'text', array(
            'name'      => 'facebook',
            'label'     => Mage::helper('bluecom_team')->__('Facebook'),
            'title'     => Mage::helper('bluecom_team')->__('Facebook'),
            'required'  => false,
        ));
        $fieldset->addField('youtube', 'text', array(
            'name'      => 'youtube',
            'label'     => Mage::helper('bluecom_team')->__('Youtube'),
            'title'     => Mage::helper('bluecom_team')->__('Youtube'),
            'required'  => false,
        ));
        $fieldset->addField('linkedin', 'text', array(
            'name'      => 'linkedin',
            'label'     => Mage::helper('bluecom_team')->__('LinkedIn'),
            'title'     => Mage::helper('bluecom_team')->__('LinkedIn'),
            'required'  => false,
        ));

        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
        }
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
