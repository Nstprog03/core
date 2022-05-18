<?php
class Ccc_User_Adminhtml_UserController extends Mage_Adminhtml_Controller_Action {
	public function indexAction() {
		$this->loadLayout();
		$this->_setActiveMenu('user/user');
		$this->renderLayout();
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() {

		$userId = $this->getRequest()->getParam('id');
		$user = Mage::getModel('user/user')
			->setStoreId($this->getRequest()->getParam('store', 0))
			->load($userId);

		Mage::register('current_user', $user);
		Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));

		if ($userId && !$user->getId()) {
			$this->_getSession()->addError(Mage::helper('user')->__('This user no longer exists'));
			$this->_redirect('*/*/');
			return;
		}
		$this->loadLayout();
		$this->renderLayout();
	}

	public function saveAction() {

		try {

			$userData = $this->getRequest()->getPost('account');
			$user = Mage::getSingleton('user/user');
			$userId = $this->getRequest()->getParam('id');
			if ($userId = $this->getRequest()->getParam('id')) {

				if (!$user->load($userId)) {
					throw new Exception("No Row Found");
				}
				Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

			}

			$user->addData($userData);
			$user->entity_id = $userId;
			$user->save();

			Mage::getSingleton('core/session')->addSuccess("user data added.");
			$this->_redirect('*/*/');

		} catch (Exception $e) {
			Mage::getSingleton('core/session')->addError($e->getMessage());
			$this->_redirect('*/*/');
		}

	}

	public function deleteAction() {
		try {

			$userModel = Mage::getModel('user/user');

			if (!($userId = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception('Id not found');
			}

			if (!$userModel->load($userId)) {
				throw new Exception('user does not exist');
			}

			if (!$userModel->delete()) {
				throw new Exception('Error in delete record', 1);
			}

			Mage::getSingleton('core/session')->addSuccess($this->__('The user has been deleted.'));

		} catch (Exception $e) {
			Mage::logException($e);
			$Mage::getSingleton('core/session')->addError($e->getMessage());
		}

		$this->_redirect('*/*/');
	}
}