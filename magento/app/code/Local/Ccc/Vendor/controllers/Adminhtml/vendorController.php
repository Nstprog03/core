<?php 
class Ccc_Vendor_Adminhtml_vendorController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{

		$this->_title($this->__('Vendors'))->_title($this->__('Vendor Groups'));

      	$this->loadLayout();
      	$this->_setActiveMenu('vendor/group');
      	$this->_addBreadcrumb(Mage::helper('vendor')->__('Vendors'), Mage::helper('vendor')->__('Vendors'));
      	$this->_addBreadcrumb(Mage::helper('vendor')->__('Vendor Groups'), Mage::helper('vendor')->__('Vendor Groups'));
      	$this->renderLayout();
	}

    public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
 	{
 		$vendorId = $this->getRequest()->getParam('id');

		$vendorModel = Mage::getModel('vendor/vendor')->load($vendorId);

		if ($vendorModel->getId() || $vendorId == 0) 
		{

			Mage::register('vendor_data', $vendorModel);

			$this->loadLayout();
			$this->_setActiveMenu('vendor/vendor');

			$this->_addBreadcrumb(Mage::helper('vendor')->__('Student Information'), Mage::helper('vendor')->__('Studenet Information'));
			$this->_addBreadcrumb(Mage::helper('vendor')->__('Data News'), Mage::helper('vendor')->__('Data News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit'))
			->_addLeft($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit_tabs'));

			$this->renderLayout();
		} 
		else 
		{
	 		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Item does not exist'));
	 		$this->_redirect('*/*/');
	 	}
 	}

 	public function saveAction()
 	{
 		$postData = $this->getRequest()->getPost();
 		$vendor = Mage::getModel('vendor/vendor');
 		if($this->getRequest()->getParam('id'))
 		{
 			$postData = array_merge(['vendor_id'=>$this->getRequest()->getParam('id')],$postData);
 		}
 		$vendor->setData($postData);
 		$vendor->save();
 		$this->_redirect('*/*/');
 	}
 	public function deleteAction()
 	{
 		$id = (int)$this->getRequest()->getParam('id');
 		if($id)
 		{
 			$vendor = Mage::getModel('vendor/vendor');
 			$load = $vendor->load($id);
 			if($load)
 			{
 				$delete = $vendor->delete();
 				$this->_redirect('*/*/');
 			}
 		}
 	}


}