<?php

class Ccc_User_Adminhtml_User_SetController extends Mage_Adminhtml_Controller_Action {

	protected function _setTypeId() {
		Mage::register('entityType', Mage::getModel('user/user')->getResource()->getTypeId());
	}

	public function indexAction() {
		$this->loadLayout()->_setActiveMenu('user');
		$this->_setTypeId();

		$this->_addContent($this->getLayout()->createBlock('adminhtml/catalog_product_attribute_set_toolbar_main'));

		$this->_addContent($this->getLayout()->createBlock('user/adminhtml_user_attribute_set_grid'));

		$this->renderLayout();
	}

	public function addAction() {
		$this->_title('User')
			->_title('Attribute')
			->_title('Manage User Attribute Set')
			->_title('New Set');
		$this->loadLayout()->_setActiveMenu('user');
		$this->_setTypeId();

		$this->_addContent($this->getLayout()->createBlock('adminhtml/catalog_product_attribute_set_toolbar_add'));
		$this->renderLayout();

	}

	public function editAction() {
		$this->_title(Mage::helper('user')->__('User'))
			->_title(Mage::helper('user')->__('Attributes'))
			->_title(Mage::helper('user')->__('Manage Attribute Sets'));

		$this->_setTypeId();
		$attributeSet = Mage::getModel('eav/entity_attribute_set')
			->load($this->getRequest()->getParam('id'));

		if (!$attributeSet->getId()) {
			$this->_redirect('*/*/');
			return;
		}

		$this->_title($attributeSet->getId() ? $attributeSet->getAttributeSetName() : Mage::helper('user')->__('New Set'));

		Mage::register('current_attribute_set', $attributeSet);

		$this->loadLayout();
		$this->_setActiveMenu('user');

		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper('user')->__('user'), Mage::helper('user')->__('user'));
		$this->_addBreadcrumb(
			Mage::helper('user')->__('Manage User Attribute Sets'),
			Mage::helper('user')->__('Manage User Attribute Sets'));

		$this->_addContent($this->getLayout()->createBlock('user/adminhtml_user_attribute_set_main'));

		$this->renderLayout();
	}

	protected function _getEntityTypeId() {
		if (!Mage::registry('entityType')) {
			$this->_setTypeId();
		}
		return Mage::registry('entityType');
	}

	public function saveAction() {
		$entityTypeId = $this->_getEntityTypeId();
		$hasError = false;
		$attributeSetId = $this->getRequest()->getParam('id', false);
		$isNewSet = $this->getRequest()->getParam('gotoEdit', false) == '1';

		$model = Mage::getModel('eav/entity_attribute_set')
			->setEntityTypeId($entityTypeId);

		$helper = Mage::helper('user');
		try
		{
			if ($isNewSet) {
				$name = $helper->stripTags($this->getRequest()->getParam('attribute_set_name'));
				$model->setAttributeSetName(trim($name));

			} else {
				if ($attributeSetId) {
					$model->load($attributeSetId);
				}
				if (!$model->getId()) {
					Mage::throwException(Mage::helper('salesman')->__('This attribute set no longer exists.'));
				}
				$data = Mage::helper('core')->jsonDecode($this->getRequest()->getPost('data'));

				$data['attribute_set_name'] = $helper->stripTags($data['attribute_set_name']);

				$model->organizeData($data);
			}
			$model->validate();
			if ($isNewSet) {
				$model->save();
				$model->initFromSkeleton($this->getRequest()->getParam('skeleton_set'));
			}

			$model->save();
			$this->_getSession()->addSuccess($helper->__('The attribute set has been saved.'));
		} catch (Mage_Core_Exception $e) {
			$this->_getSession()->addError($e->getMessage());
			$hasError = true;
		} catch (Exception $e) {
			$this->_getSession()->addException($e,
				$helper->__('An error occurred while saving the attribute set.'));
			$hasError = true;
		}

		if ($isNewSet) {
			if ($hasError) {
				$this->_redirect('*/*/add');
			} else {
				$this->_redirect('*/*/edit', array('id' => $model->getId()));
			}
		} else {
			$response = array();
			if ($hasError) {
				$this->_initLayoutMessages('adminhtml/session');
				$response['error'] = 1;
				$response['message'] = $this->getLayout()->getMessagesBlock()->getGroupedHtml();
			} else {
				$response['error'] = 0;
				$response['url'] = $this->getUrl('*/*/');
			}
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
		}

	}

	public function deleteAction() {
		$setId = $this->getRequest()->getParam('id');
		try {
			Mage::getModel('eav/entity_attribute_set')
				->setId($setId)
				->delete();

			$this->_getSession()->addSuccess($this->__('The attribute set has been removed.'));
			$this->getResponse()->setRedirect($this->getUrl('*/*/'));
		} catch (Exception $e) {
			$this->_getSession()->addError($this->__('An error occurred while deleting this set.'));
			$this->_redirectReferer();
		}
	}
}