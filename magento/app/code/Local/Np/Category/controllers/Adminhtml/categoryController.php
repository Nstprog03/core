<?php 
class Np_Category_Adminhtml_categoryController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->_title($this->__('Category'))->_title($this->__('Category Info'));
		$this->loadLayout();
		$this->_setActiveMenu('category/group');
		$this->renderLayout();
	}

	 public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
 	{
 		$categoryId = $this->getRequest()->getParam('id');

		$categoryModel = Mage::getModel('category/category')->load($categoryId);

		if ($categoryModel->getId() || $categoryId == 0) 
		{

			Mage::register('category_data', $categoryModel);

			$this->loadLayout();
			$this->_setActiveMenu('category/category');

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('category/adminhtml_category_index_edit'))
			->_addLeft($this->getLayout()->createBlock('category/adminhtml_category_index_edit_tabs'));

			$this->renderLayout();
		} 
		else 
		{
	 		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Item does not exist'));
	 		$this->_redirect('*/*/');
	 	}
 	}

 	public function saveAction()
 	{
 		$postData = $this->getRequest()->getPost();
 		$category = Mage::getModel('category/category');
 		if($this->getRequest()->getParam('id'))
 		{
 			$postData = array_merge(['category_id'=>$this->getRequest()->getParam('id'),'updatedAt'=>date("Y-m-d H:i:s")],$postData);
 		}
 		else
 		{
 			$postData = array_merge(['createdAt'=>date("Y-m-d H:i:s")],$postData);
 		}
 		$category->setData($postData);
 		$category->save();
 		$this->_redirect('*/*/');
 	}
 	public function deleteAction()
 	{
 		$id = (int)$this->getRequest()->getParam('id');
 		if($id)
 		{
 			$category = Mage::getModel('category/category');
 			$load = $category->load($id);
 			if($load)
 			{
 				$delete = $category->delete();
 				$this->_redirect('*/*/');
 			}
 		}
 	}
}

