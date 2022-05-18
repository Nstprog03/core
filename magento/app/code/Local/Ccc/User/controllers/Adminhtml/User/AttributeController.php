<?php
class Ccc_User_Adminhtml_User_AttributeController extends Mage_Adminhtml_Controller_Action {
	public function indexAction() {
		$this->loadLayout()
			->_setActiveMenu('user/user')
			->_addContent($this->getLayout()->createBlock('user/adminhtml_user_attribute'))
			->renderLayout();
	}
	public function preDispatch() {
		parent::preDispatch();
		$this->_entityTypeId = Mage::getModel('eav/entity')->setType(Ccc_User_Model_Resource_User::ENTITY)->getTypeId();
	}
	public function newAction() {
		$this->_forward('edit');
	}

	public function editAction() {
		$id = $this->getRequest()->getParam('attribute_id');

		$model = Mage::getModel('eav/entity_attribute')
			->setEntityTypeId($this->_entityTypeId);
		if ($id) {
			$model->load($id);

			if (!$model->getId()) {
				$this->_getSession()->addError(Mage::helper('user')->__('This Attribute No Longer Exist'));
				$this->_redirect('*/*/');
				return;
			}

			if ($model->getEntityTypeId() != $this->_entityTypeId) {
				$this->_getSession()->addError(Mage::helper('user')->__('This Entity Can not Edited'));
				$this->_redirect('*/*/');
				return;
			}

		}

		$data = Mage::getSingleton('user/session')->getAttributeData(true);

		if (!empty($data)) {
			$model->addData($data);
		}

		Mage::register('entity_attribute', $model);

		$this->loadLayout()->_setActiveMenu('user');
		$this->_title($id ? $model->getName() : $this->__('New Attribute'));

		$item = $id ? Mage::helper('user')->__('Edit user Attribute')
		: Mage::helper('user')->__('New user Attribute');

		$this->_addBreadcrumb($item, $item);
		$this->renderLayout();

	}

	protected function _filterPostData($data) {
		if ($data) {

			$helperCatalog = Mage::helper('user');

			$data['frontend_label'] = (array) $data['frontend_label'];
			foreach ($data['frontend_label'] as &$value) {
				if ($value) {
					$value = $helperCatalog->stripTags($value);
				}
			}
			if (!empty($data['option']) && !empty($data['option']['value']) && is_array($data['option']['value'])) {
				$allowableTags = isset($data['is_html_allowed_on_front']) && $data['is_html_allowed_on_front']
				? sprintf('<%s>', implode('><', $this->_getAllowedTags())) : null;
				foreach ($data['option']['value'] as $key => $values) {
					foreach ($values as $storeId => $storeLabel) {
						$data['option']['value'][$key][$storeId]
						= $helperCatalog->stripTags($storeLabel, $allowableTags);
					}
				}
			}
		}
		return $data;
	}

	public function saveAction() {

		$data = $this->getRequest()->getPost();

		if ($data) {
			$session = Mage::getSingleton('user/session');
			$model = Mage::getModel('eav/entity_attribute');
			$helper = Mage::helper('user/user');
			$id = $this->getRequest()->getParam('attribute_id');
		}

		// validate attribute code

		if (isset($data['attribute_code'])) {
			$validatorAttrCode = new Zend_Validate_Regex(array('pattern' => '/^(?!event$)[a-z][a-z_0-9]{1,254}$/'));
			if (!$validatorAttrCode->isValid($data['attribute_code'])) {
				$session->addError(Mage::helper('user')->__('Attribute code is invalid. Please use only letters (a-z), numbers (0-9) or underscore(_) in this field, first character should be a letter. Do not use "event" for an attribute code.'));
				$this->_redirect('*/*/edit', array('attribute_id' => $id, '_current' => true));
				return;
			}

		}

		// validate frontend input

		if (isset($data['frontend_input'])) {
			$validatorInputType = Mage::getModel('eav/adminhtml_system_config_source_inputtype_validator');
			if (!$validatorInputType->isValid($data['frontend_input'])) {
				foreach ($validatorInputType->getMessages() as $message) {
					$session->addError($message);
				}
				$this->_redirect('*/*/edit', array('attribute_id' => $id, '_current' => true));
				return;
			}

		}

		if ($id) {
			$model->load($id);

			if (!$model->getId()) {
				$session->addError(Mage::helper('user')->__('This attribute no longer exists'));
				$this->_redirect('*/*/');
				return;
			}

			//check entity type id

			if ($model->getEntityTypeId() != $this->_entityTypeId) {
				$session->addError(Mage::helper('user')->__('This attribute can not be update'));
				$this->_redirect('*/*/');
				return;
			}

			$data['backend_model'] = $model->getBackendModel();
			$data['is_user_defined'] = $model->getIsUserDefined();
			$data['attribute_code'] = $model->getAttributeCode();
			$data['frontend_input'] = $model->getFrontendInput();
		} else {
			$data['source_model'] = $helper->getAttributeSourceModelByInputType($data['frontend_input']);
			$data['backend_model'] = $helper->getAttributeBackendModelByInputType($data['frontend_input']);
		}

		if (is_null($model->getIsUserDefined()) || $model->getIsUserDefined() != 0) {
			$data['backend_type'] = $model->getBackendTypeByInput($data['frontend_input']);
		}

		$defaultValueField = $model->getDefaultValueByInput($data['frontend_input']);
		if ($defaultValueField) {
			$data['default_value'] = $this->getRequest()->getParam($defaultValueField);
		}

		//filter
		$data = $this->_filterPostData($data);
		$model->addData($data);

		if (!$id) {
			$model->setEntityTypeId($this->_entityTypeId);
			$model->setIsUserDefined(1);
		}

		if ($this->getRequest()->getParam('set') && $this->getRequest()->getParam('group')) {
			$model->setAttributeSetId($this->getRequest()->getParam('set'));
			$model->setAttributeGroupId($this->getRequest()->getParam('group'));
		}

		try
		{
			$model->save();
			$session->addSuccess(
				Mage::helper('user')->__('The User attribute has been saved.'));

			Mage::app()->cleanCache(array(Mage_Core_Model_Translate::CACHE_TAG));
			$session->setAttributeData(false);

			$this->_redirect('*/*/', array());

			return;
		} catch (Exception $e) {
			$session->addError($e->getMessage());
			$session->setAttributeData($data);
			$this->_redirect('*/*/edit', array('attribute_id' => $id, '_current' => true));
			return;
		}

	}

	public function deleteAction() {
		if ($id = $this->getRequest()->getParam('attribute_id')) {
			$model = Mage::getModel('eav/entity_attribute');

			// entity type check
			$model->load($id);
			if ($model->getEntityTypeId() != $this->_entityTypeId || !$model->getIsUserDefined()) {
				Mage::getSingleton('user/session')->addError(
					Mage::helper('user')->__('This attribute cannot be deleted.'));
				$this->_redirect('*/*/');
				return;
			}

			try {
				$model->delete();
				Mage::getSingleton('user/session')->addSuccess(
					Mage::helper('user')->__('The user attribute has been deleted.'));
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('user/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('attribute_id' => $this->getRequest()->getParam('attribute_id')));
				return;
			}
		}
		Mage::getSingleton('user/session')->addError(
			Mage::helper('user')->__('Unable to find an attribute to delete.'));
		$this->_redirect('*/*/');
	}
}