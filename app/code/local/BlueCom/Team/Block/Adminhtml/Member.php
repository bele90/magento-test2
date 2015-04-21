<?php
class BlueCom_Team_Block_Adminhtml_Member
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz

        $this->_blockGroup = 'bluecom_team';
        $this->_controller = 'adminhtml_member';
        $this->_headerText = $this->__('Member');
         
        parent::__construct();
    }
}