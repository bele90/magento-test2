<?php
class BlueCom_Team_Adminhtml_MemberController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }

    public function newAction()
    {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('bluecom_team/member');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This member no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Member'));

        $data = Mage::getSingleton('adminhtml/session')->getMemberData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        Mage::register('bluecom_team_member', $model);
        /*
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('clnews/adminhtml_news_edit'))
            ->_addLeft($this->getLayout()->createBlock('clnews/adminhtml_news_edit_tabs'))
            ->renderLayout();
        */
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('bluecom_team/adminhtml_member_edit'))
            ->_addLeft($this->getLayout()->createBlock('bluecom_team/adminhtml_member_edit_tabs'))
            ->renderLayout();

    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('bluecom_team/member');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Member has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this member.'));
            }

            Mage::getSingleton('adminhtml/session')->setMemberData($postData);
            $this->_redirectReferer();
        }
    }
    public function deleteAction() {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('bluecom_team/member');
                $model->load($id);
                $model->delete();

                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('adminhtml')->__('Item has been successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    public function messageAction()
    {
        $data = Mage::getModel('bluecom_team/member')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout();

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('bluecom_team_member');
    }
}