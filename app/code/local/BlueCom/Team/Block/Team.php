<?php
/**
 * CommerceLab Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the CommerceLab License Agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://commerce-lab.com/LICENSE.txt
 *
 * @category   CommerceLab
 * @package    CommerceLab_News
 * @copyright  Copyright (c) 2012 CommerceLab Co. (http://commerce-lab.com)
 * @license    http://commerce-lab.com/LICENSE.txt
 */

class BlueCom_Team_Block_Team extends Mage_Core_Block_Template
{
    public function __construct() {
        parent::__construct();
        $collection = $this->getMemberCollection();
        $this->setCollection($collection);
    }

    public function _preparelayout() {
        parent::_prepareLayout();
        $this->getCollection()->load();
        return $this;
    }

    public function getPagerHtml() {
        return $this->getChildHtml('pager');
    }

    public function getMemberCollection() {
        $collection = Mage::getModel('bluecom_team/member')->getCollection();
        $collection->setOrder('lastname', 'desc');
        $tableMemDept = Mage::getSingleton('core/resource')->getTableName('bluecom_team_memdept');
        $depts =  Mage::getModel('bluecom_team/department')->getCollection();
        foreach($depts as $dep)
         $dep->members =   Mage::getModel('bluecom_team/member')->getCollection();//->addFieldToFilter('member_id',$dep->getId())->getSelect()->join($tableMemDept,'main_table.id='.$tableMemDept.'.member_id');

        return $depts;
    }

}
