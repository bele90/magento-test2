<?php
class BlueCom_Team_Model_Mysql4_Member_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {  
        $this->_init('bluecom_team/member');
    }  
}