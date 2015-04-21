<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 16/04/2015
 * Time: 11:24 AM
 */
class BlueCom_Team_Block_Adminhtml_Member_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('member_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('bluecom_team')->__('Main Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('info', array(
            'label'     => Mage::helper('bluecom_team')->__('Personal'),
            'content'   => $this->getLayout()->createBlock('bluecom_team/adminhtml_member_edit_tab_info')->initForm()->toHtml(),
        ));
        $this->addTab('social', array(
            'label'     => Mage::helper('bluecom_team')->__('Social'),
            'content'   => $this->getLayout()->createBlock('bluecom_team/adminhtml_member_edit_tab_social')->initForm()->toHtml(),
        ));
        $this->addTab('additional', array(
            'label'     => Mage::helper('bluecom_team')->__('Additional'),
            'content'   => $this->getLayout()
                ->createBlock('bluecom_team/adminhtml_member_edit_tab_additional')->initForm()->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}