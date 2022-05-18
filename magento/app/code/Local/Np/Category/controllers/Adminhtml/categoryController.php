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
 		$category_id = $this->getRequest()->getParam('id');

		$categoryModel = Mage::getModel('category/category')->load($category_id);

		if ($categoryModel->getId() || $category_id == 0) 
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

 	protected function saveCategory($id)
    {
        $categoryRow = Mage::getModel('category/category');
        $category=$categoryRow->load($id);
        $categoryId = $category->category_id;
        if ($category->parent_id == NULL) 
        {
            $path = $category->category_id;
        }
        else
        {
            $result=$categoryRow->load($category->parent_id);
            $path = $result->path.'/'.$categoryId;
        }
        $category=$categoryRow->load($categoryId);
        $category->path = $path;
        $update = $category->save();
        if(!$update)
        {
            throw new Exception("System is unable to update.", 1);
        }
        
    }

    public function saveAction()
    {
        try 
        {
            if (!$this->getRequest()->getPost()) 
            {
                throw new Exception("Invalid request.", 1);
            }
            $path = '';
            $postData = $this->getRequest()->getPost();
            unset($postData['form_key']);
            $categoryRow = Mage::getModel('category/category');
            $adapter = $categoryRow->getResource()->getReadConnection();
            $id = $this->getRequest()->getParam('id');
            if($id)
            {
                $categoryPath = $adapter->fetchOne("SELECT `path` FROM `category` WHERE `category_id` = {$id}");
                $categoryRow->setData($postData);
                if ($categoryRow->parent_id == NULL) 
                {
                    $categoryRow->parent_id = null;
                }
                $categoryRow->category_id = $id;
                $categoryRow->updated_at = date('Y-m-d H:i:s');
                $category = $categoryRow->save();
                $this->saveCategory($category->category_id);
                $query= $categoryRow->getCollection()->getSelect()->where("`path` LIKE '".$categoryPath.'/%'."'")->order('path');
                $subcategories = $adapter->fetchAll($query);
                foreach ($subcategories as $row) 
                {
                    $query= $categoryRow->getCollection()->getSelect()->where("`category_id` = {$row['parent_id']}")->order('path');
                    $parent = $adapter->fetchRow($query);
                    $newPath = $parent['path'].'/'.$row['category_id'];
                    $row['path'] = $newPath;
                    $row['updated_at'] = date('Y-m-d H:i:s');
                    Mage::getModel('category/category')->setData($row)->save();
                }
                
            }
            else
            {
                if ($postData['parent_id'] == null) 
                {
                    unset($postData['parent_id']);
                }
                $categoryRow->setData($postData);
                $categoryRow->created_at = date('Y-m-d H:i:s');
                $category = $categoryRow->save();
                if(!$category)
                {
                    throw new Exception("System is unable to insert.", 1);          
                }
                $this->saveCategory($category->category_id);
            }
            $this->_redirect('*/*/');
        } 
        catch (Exception $e) 
        {
            $this->_redirect('*/*/');
        }
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

