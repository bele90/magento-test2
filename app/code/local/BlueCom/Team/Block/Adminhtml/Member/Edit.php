<?php
class BlueCom_Team_Block_Adminhtml_Member_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'bluecom_team';
        $this->_controller = 'adminhtml_member';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Member'));
        $this->_updateButton('delete', 'label', $this->__('Delete Member'));
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('clnews_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'clnews_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'clnews_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }

            function checkboxSwitch(){
                if (jQuery('#use_full_img').is(':checked')) {
                    jQuery('#image_short_content').parent().parent().css('display','none');
                } else {
                    jQuery('#image_short_content').parent().parent().css('display', 'table-row');
                    jQuery('#image_short_content').siblings('a').css('float', 'left');
                    jQuery('#image_short_content').siblings('a').css('margin-right', '4px');
                    jQuery('#image_short_content').parent().parent().css('width','155px');
                }
            }
        ";
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('bluecom_team_member_data') && Mage::registry('bluecom_team_member_data')->getId()) {
            return Mage::helper('bluecom_team')->__("Edit Member'%s'",
                $this->htmlEscape(Mage::registry('bluecom_team_member_data')->getTitle()));
        } else {
            return Mage::helper('bluecom_team')->__('Add Member');
        }

    }
}