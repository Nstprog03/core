<?php 
class Np_Salesman_Adminhtml_salesmanController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->_title($this->__('Salesman'))->_title($this->__('Salesman Group'));
		$this->loadLayout();
		$this->_setActiveMenu('salesman/group');
		$this->renderLayout();
	}

	 public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
 	{
 		$salesmanId = $this->getRequest()->getParam('id');

		$salesmanModel = Mage::getModel('salesman/salesman')->load($salesmanId);

		if ($salesmanModel->getId() || $salesmanId == 0) 
		{

			Mage::register('salesman_data', $salesmanModel);

			$this->loadLayout();
			$this->_setActiveMenu('salesman/salesman');

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_salesman_index_edit'))
			->_addLeft($this->getLayout()->createBlock('salesman/adminhtml_salesman_index_edit_tabs'));

			$this->renderLayout();
		} 
		else 
		{
	 		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Item does not exist'));
	 		$this->_redirect('*/*/');
	 	}
 	}

 	public function saveAction()
 	{
 		$postData = $this->getRequest()->getPost();
 		$salesman = Mage::getModel('salesman/salesman');
 		if($this->getRequest()->getParam('id'))
 		{
 			$postData = array_merge(['salesman_id'=>$this->getRequest()->getParam('id')],$postData);
 		}
 		$salesman->setData($postData);
 		$salesman->save();
 		$this->_redirect('*/*/');
 	}
 	public function deleteAction()
 	{
 		$id = (int)$this->getRequest()->getParam('id');
 		if($id)
 		{
 			$salesman = Mage::getModel('salesman/salesman');
 			$load = $salesman->load($id);
 			if($load)
 			{
 				$delete = $salesman->delete();
 				$this->_redirect('*/*/');
 			}
 		}
 	}
}

