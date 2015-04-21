<?php
class BlueCom_Team_Model_Mysql4_Member
    extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {  
        $this->_init('bluecom_team/member', 'id');
    }
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $condition = $this->_getWriteAdapter()->quoteInto('member_id = ?', $object->getId());
        $this->_getWriteAdapter()->delete($this->getTable('bluecom_team/memdept'), $condition);

        foreach ((array)$object->getData('departments') as $department) {
            $data = array();
            $data['member_id'] = $object->getId();
            $data['department_id'] = $department;
            $this->_getWriteAdapter()->insert($this->getTable('bluecom_team/memdept'), $data);
        }
        return parent::_afterSave($object);
    }

    protected function _beforeDelete(Mage_Core_Model_Abstract $object){
        $adapter = $this->_getReadAdapter();
        $adapter->delete($this->getTable('bluecom_team/memdept'), 'member_id='.$object->getId());
    }
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {


        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('bluecom_team/memdept'))
            ->where('member_id = ?', $object->getId());

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $departments = array();
            foreach ($data as $row) {
                $departments[] = $row['department_id'];
            }
            $object->setData('department_id', $departments);
        }

        return parent::_afterLoad($object);
    }

}