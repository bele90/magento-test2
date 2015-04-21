<?php
class BlueCom_Team_Block_Adminhtml_Department
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'bluecom_team';
        $this->_controller = 'adminhtml_department';
        $this->_headerText = $this->__('Department');
         
        parent::__construct();
    }
}