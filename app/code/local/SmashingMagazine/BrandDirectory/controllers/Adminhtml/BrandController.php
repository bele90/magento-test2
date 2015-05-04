<?php
    class SmashingMagazine_BrandDirectory_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action {
        public function indexAction() {
            $brandBlock = $this->getLayout()->createBlock('smashingmagazine_branddirectory_adminhtml/brand');

            $this->loadLayout()->_addContent($brandBlock)->renderLayout();
        }

        public function editAction() {
            $brand = Mage::getModel('smashingmagazine_branddirectory/brand');
            if($brandId = $this->getRequest()->getParam('id', false)) {
                $brand->load($brandId);

                if($brand->getId() < 1){
                    $this->_getSession()->addError($this->__('This brand no longer exists.'));
                    return $this->_redirect('smashingmagazine_branddirectory_admin/brand/index');
                }
            }

            if($postData = $this->getRequest()->getPost('brandData')) {
                try{
                    $brand->addData($postData);
                    $brand->save();

                    $this->_getSession()->addSuccess($this->__('The brand has been saved'));
                    return $this->_redirect(
                        'smashingmagazine_branddirectory_admin/brand/edit',
                        array('id' => $brand->getId())
                    );
                } catch(Exception $ex) {
                    Mage::logException($ex);
                    $this->_getSession()->addError($ex->getMessage());
                }
            }

            Mage::register('current_brand', $brand);

            $brandEditBlock = $this->getLayout()->createBlock('smashingmagazine_branddirectory_adminhtml/brand_edit');

            $this->loadLayout()->_addContent($brandEditBlock)->renderLayout();
        }

        public function deleteAction() {
            $brand = Mage::getModel('smashingmagazine_branddirectory/brand');
            if($brandId = $this->getRequest()->getParam('id', false)) {
                $brand->load($brandId);
            }

            if($brand->getId() < 1) {
                $this->_getSession()->addError($this->__('This brand no longer exists'));
                return $this->_redirect(
                    'smashingmagazine_branddirectory_admin/brand/index'
                );
            }

            try {
                $brand->delete();
                $this->_getSession()->addSuccess($this->__('The brand has been deleted'));
            } catch(Exception $ex) {
                Mage::logException($ex);
                $this->_getSession()->addError($ex->getMessage());
            }

            return $this->_redirect(
                'smashingmagazine_branddirectory_admin/brand/index'
            );
        }

        public function _isAllowed() {
            $actionName = $this->getRequest()->getActionName();
            switch($actionName) {
                case 'index':
                case 'edit':
                case 'delete':
                default:
                    $adminSession = Mage::getSingleton('admin/session');
                    $isAllowed = $adminSession->isAllowed('smashingmagazine_branddirectory/brand');
                    break;
            }
            return $isAllowed;
        }
    }