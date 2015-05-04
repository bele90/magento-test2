<?php
    class Basetut_Salestaff_Adminhtml_StaffController extends Mage_Adminhtml_Controller_Action {
        public function indexAction() {
            $this->loadLayout();
            $this->_setActiveMenu('salestaff_menu')->renderLayout();
        }

        public function exportCsvAction() {
            $filename = 'salestaff.csv';
            $content = $this->getLayout()->createBlock('salestaff/adminhtml_staff_grid')->getCsv();
            $this->_prepareDownloadResponse($filename, $content);
        }

        public function exportXmlAction() {
            $filename = 'salestaff.xml';
            $content = $this->getLayout()->createBlock('salestaff/adminhtml_staff_grid')->getXml();
            $this->_prepareDownloadResponse($filename, $content);
        }

        public function massDeleteAction() {
            $staffIds = $this->getRequest()->getParam('staff');
            if(!is_array($staffIds)) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select staff(s)'));
            } else {
                try{
                    foreach($staffIds as $staffId) {
                        $staff = Mage::getModel('salestaff/staff')->load($staffId);
                        $staff->delete();
                    }

                    Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($staffIds))
                    );
                } catch(Exception $ex) {
                    Mage::getSingleton('adminhtml/session')->addError($ex->getMessage());
                }
            }
            $this->_redirect('*/*/index');
        }

        public function massStatusAction() {
            $staffIds = $this->getRequest()->getParam('staff');
            if(!is_array($staffIds)) {
                $this->_getSession()->addError(Mage::helper('adminhtml')->__('Please select staff(s)'));
            } else {
                try{
                    foreach($staffIds as $staffId) {
                        Mage::getSingleton('salestaff/staff')
                            ->load($staffId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                    }
                    $this->_getSession()->addSuccess(
                        $this->__('Total of %d record(s) were successfully updated', count($staffIds))
                    );
                } catch(Exception $ex) {
                    $this->_getSession()->addError($ex->getMessage());
                }
            }
            $this->_redirect('*/*/index');
        }

        public function newAction() {
            $this->_forward('edit');
        }

        public function editAction(){
            $salestaffId = $this->getRequest()->getParam('id');
            $model = Mage::getModel('salestaff/staff')->load($salestaffId);

            if ($model->getId() || $salestaffId == 0) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if (!empty($data)) {
                    $model->setData($data);
                }
                Mage::register('salestaff_data', $model);

                $this->loadLayout();
                $this->_setActiveMenu('salestaff/salestaff');

                $this->_addBreadcrumb(
                    Mage::helper('adminhtml')->__('Staff Manager'),
                    Mage::helper('adminhtml')->__('Staff Manager')
                );

                $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
                $this->_addContent($this->getLayout()->createBlock('salestaff/adminhtml_staff_edit'))
                    ->_addLeft($this->getLayout()->createBlock('salestaff/adminhtml_staff_edit_tabs'));
                    //->_addContent($this->getLayout()->createBlock('salestaff/adminhtml_staff_edit_tab_form'));

                $this->renderLayout();
            } else {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('salestaff')->__('Staff does not exist')
                );
                $this->_redirect('*/*/');
            }
        }

        public function saveAction(){
            if($data = $this->getRequest()->getPost()) {
                $model = Mage::getModel('salestaff/staff');
                $id = $this->getRequest()->getParam('id');
                if($id) {
                    $model->load($id);
                }
                $model->setData($data);

                Mage::getSingleton('adminhtml/session')->setFormData($data);
                try{
                    if($id) {
                        $model->setId($id);
                    }
                    $model->save();

                    if(!$model->getId()) {
                        Mage::throwException(Mage::helper('salestaff')->__('Error saving example'));
                    }

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('salestaff')->__('Example was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);

                    if($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    } else {
                        $this->_redirect('*/*/');
                    }
                } catch(Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    if($model && $model->getId()) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    } else {
                        $this->_redirect('*/*/');
                    }
                }
                return;
            }
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salestaff')->__('No data found to save'));
            $this->_redirect('*/*/');
        }

        public function deleteAction() {
            if($this->getRequest()->getParam('id') > 0) {
                try{
                    $model = Mage::getModel('salestaff/staff');
                    $model->setId($this->getRequest()->getParam('id'))->delete();

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Staff was successfully deleted'));
                    $this->_redirect('*/*/');
                } catch(Exception $ex) {
                    Mage::getSingleton('adminhtml/session')->addError($ex->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            }
            $this->_redirect('*/*/');
        }

    }