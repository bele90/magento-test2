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

class BlueCom_Team_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {

        $this->loadLayout();
        $head = $this->getLayout()->getBlock('head');
        $head->setTitle("Our Team");
        $this->renderLayout();


    }
}
