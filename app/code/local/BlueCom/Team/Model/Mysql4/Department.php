<?php
class BlueCom_Team_Model_Mysql4_Department
    extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {  
        $this->_init('bluecom_team/department', 'id');
    }  
}