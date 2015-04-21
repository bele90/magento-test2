<?php
class BlueCom_Team_Block_Adminhtml_Department_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'bluecom_team';
        $this->_controller = 'adminhtml_department';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Department'));
        $this->_updateButton('delete', 'label', $this->__('Delete Department'));
    }  
     
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('bluecom_team')->getId()) {
            return $this->__('Edit Department');
        }  
        else {
            return $this->__('New Department');
        }  
    }  
}