<?php
    class BlueCom_BrandDirectory_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action {
        public function indexAction() {
            $brandBlock = $this->getLayout()->createBlock('bluecom_branddirectory_adminhtml/brand');

            $this->loadLayout()->_addContent($brandBlock)->renderLayout();
        }

        public function editAction() {
            $brand = Mage::getModel('bluecom_branddirectory/brand');
            if($brandId = $this->getRequest()->getParam('id', false)) {
                $brand->load($brandId);

                if($brand->getId() < 1){
                    $this->_getSession()->addError($this->__('This brand no longer exists.'));
                    return $this->_redirect('bluecom_branddirectory_admin/brand/index');
                }
            }

            Mage::register('brand_data', $brand);

            $brandEditBlock = $this->getLayout()->createBlock('bluecom_branddirectory_adminhtml/brand_edit');

            $this->loadLayout()->_addContent($brandEditBlock)->renderLayout();
        }

        public function saveAction() {
           if($this->getRequest()->getPost()) {
               $postData = $this->getRequest()->getPost();
               $brandId = $this->getRequest()->getParam('id');
               $brandModel = Mage::getModel('bluecom_branddirectory/brand');
               if($_FILES['image']['name'] != '') {
                   $path = Mage::getBaseDir('media') . DS . 'brand';
                   if(!file_exists($path)) {
                       mkdir($path, 0777, true);
                   }
                   $postData['image'] = $this->uploadImgAction($_FILES['image']['name'], 'image', $path);
                   $brandModel->setImage($postData['image']);
               }
               try {
                   $brandModel->setId($this->getRequest()->getParam('id'))
                       ->setName($postData['name'])
                       ->setUrlKey($postData['url_key'])
                       ->setDescription($postData['description'])
                       ->setVisibility($postData['visibility'])
                       ->save();

                   Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                   Mage::getSingleton('adminhtml/session')->setBrandData(false);

                   $this->_redirect('*/*/');
                   return;
               } catch(Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setBrandData($this->getRequest()->getPost());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                   return;
               }
           }
        }

        public function deleteAction() {
            $brand = Mage::getModel('bluecom_branddirectory/brand');
            if($brandId = $this->getRequest()->getParam('id', false)) {
                $brand->load($brandId);
            }

            if($brand->getId() < 1) {
                $this->_getSession()->addError($this->__('This brand no longer exists'));
                return $this->_redirect(
                    'bluecom_branddirectory_admin/brand/index'
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
                'bluecom_branddirectory_admin/brand/index'
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
                    $isAllowed = $adminSession->isAllowed('bluecom_branddirectory/brand');
                    break;
            }
            return $isAllowed;
        }

        public function uploadImgAction($files_name, $prefix_name, $path) {
            try {
                $fileName = $files_name;
                $fileExt = strtolower(substr(strrchr($fileName, "."), 1));
                $fileNamewoe = uniqid($prefix_name);
                $fileName = str_replace(' ', '', $fileNamewoe) . '.' . $fileExt;
                $uploader = new Varien_File_Uploader($prefix_name);
                $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);
                $uploader->save($path, $fileName);
                return $fileName;
            } catch(Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
    }