<?php
class Np_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action {
	public function indexAction() {
		$this->loadLayout();
		// $this->getLayout()->getBlock('content')->append($this->getLayout()->createBlock('vendor/adminhtml_vendor'));
		//$this->_setActiveMenu('vendor/vendor');
		$this->renderLayout();
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() {

		$vendorId = $this->getRequest()->getParam('id');
		$vendor = Mage::getModel('vendor/vendor')
			->setStoreId($this->getRequest()->getParam('store', 0))
			->load($vendorId);

		Mage::register('current_vendor', $vendor);
		Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));

		if ($vendorId && !$vendor->getId()) {
			$this->_getSession()->addError(Mage::helper('vendor')->__('This vendor no longer exists'));
			$this->_redirect('*/*/');
			return;
		}
		$this->loadLayout();
		$this->renderLayout();
	}

	public function saveAction() {

		try {

			$vendorData = $this->getRequest()->getPost('account');
			$vendor = Mage::getSingleton('vendor/vendor');
			$vendorId = $this->getRequest()->getParam('id');
			if ($vendorId = $this->getRequest()->getParam('id')) {

				if (!$vendor->load($vendorId)) {
					throw new Exception("No Row Found");
				}
				Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

			}

			$vendor->addData($vendorData);
			$vendor->entity_id = $vendorId;
			$vendor->save();

			Mage::getSingleton('core/session')->addSuccess("vendor data added.");
			$this->_redirect('*/*/');

		} catch (Exception $e) {
			Mage::getSingleton('core/session')->addError($e->getMessage());
			$this->_redirect('*/*/');
		}

	}

	public function deleteAction() {
		try {

			$vendorModel = Mage::getModel('vendor/vendor');

			if (!($vendorId = (int) $this->getRequest()->getParam('id'))) {
				throw new Exception('Id not found');
			}

			if (!$vendorModel->load($vendorId)) {
				throw new Exception('vendor does not exist');
			}

			if (!$vendorModel->delete()) {
				throw new Exception('Error in delete record', 1);
			}

			Mage::getSingleton('core/session')->addSuccess($this->__('The vendor has been deleted.'));

		} catch (Exception $e) {
			Mage::logException($e);
			$Mage::getSingleton('core/session')->addError($e->getMessage());
		}

		$this->_redirect('*/*/');
	}
}