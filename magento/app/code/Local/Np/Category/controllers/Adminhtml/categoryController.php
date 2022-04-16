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

 	public function saveAction()
 	{
 		echo "<pre>";
 		//$postData = $this->getRequest()->getPost();
 		//print_r($postData);
 		//exit;
 		$categoryModel = Mage::getModel('category/category');
            $request = $this->getRequest();
 			$selected_id = $request->getPost('selected_id');
 			$name = $request->getPost('name');
            $id = $request->getParam('id');
            if($request->getPost())
            {
                $postData = $request->getPost();
                unset($postData['selected_id']);
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id))
                {
                    $categoryData->category_id = $id;
                    $categoryData->updatedAt = date('y-m-d h:m:s');
                    if(!$selected_id)
                    {
                        $categoryData->parent_id = NULL;
                    }
                    else
                    {
                    	$categoryData->parent_id = $selected_id;	
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                    $allPath = $categoryModel->getResource()->getReadConnection()->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    // $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    //print_r($allPath);
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path['path']);
                        foreach ($finalPath as $subPath) 
                        {
                            if($subPath == $id)
                            {
                                if(count($finalPath) != 1)
                                {
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path['parent_id'])
                        {
                            $parentPath = $categoryModel->load($path['parent_id']);
                            $path['path'] = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path['path'] = $path['category_id'];
                        }
                        $savePath = Mage::getModel('category/category');
                        $savePath->setData($path);
                        $result = $savePath->save();
                    }
                }
                else
                {
                    $categoryData->createdAt = date('y-m-d h:m:s');
                    if(!$selected_id)
                    {
                        $insert = $categoryModel->save();
                        if(!$insert->category_id)
                        {
                            throw new Exception("system is unabel to insert your data");
                        }
                        $category_id = $insert->category_id;
                        // print_r(get_class_methods($categoryData));
                        $categoryData->unsetData();
                        $categoryData->path = $category_id;
                        $categoryData->path_name = $categoryData->getPath();
                        $categoryData->category_id = $category_id;
                        $result = $categoryModel->save();
                    }
                    else
                    {
                        $insert = $categoryModel->save();
                        print_r($insert);

                        if(!$insert->category_id)
                        {
                            throw new Exception("system is unabel to insert your data");
                        }
                        $new_id = $insert->category_id;
                        $parentPath = $categoryModel->load($selected_id);
                        $categoryData->category_id = $new_id;
                        $categoryData->parent_id = $selected_id;
                        $categoryData->name = $name;
                        $categoryData->path = $parentPath->path."/". $new_id;
                        $categoryData->path_name = $categoryData->getPath();
                        
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                }
            }
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

