<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
class Controller_Category extends Controller_Admin_Action{

    public function __construct()
    {
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

    public function gridAction()
    {
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'grid');    
        $this->renderLayout();
    }

    public function addAction()
    {
       $categoryModel = Ccc::getModel('category');
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('Category_Edit')->setData(['category'=>$categoryModel]);
        $content->addChild($categoryAdd,'add'); 
        $this->renderLayout();
    }

    public function editAction()
    {
        $categoryModel = Ccc::getModel('Category');
        $request = $this->getRequest();
        $id = $request->getRequest('id');
        if(!(int)$id)
        {
            throw new Exception("Invalid request", 1);
        }
        $category = $categoryModel->load($id);
        if(!$category)
        {
            throw new Exception("Invalid request", 1);
        }
        $content = $this->getLayout()->getContent();
        $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
        $content->addChild($categoryEdit,'add'); 
        $this->renderLayout();
    }

    public function saveAction()
    {
        try 
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            $id = $request->getRequest('id');
            if($request->isPost())
            {
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id))
                {
                    $categoryData->categoryId = $id;
                    $categoryData->updatedAt = date('y-m-d h:m:s');
                    if(!$postData['parentId'])
                    {
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to update.',1);
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path->path);
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
                        if($path->parentId){
                            $parentPath = $categoryModel->load($path->parentId);
                            $path->path = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path->path = $path->categoryId;
                        }
                        $result = $path->save();
                    }
                    $this->getMessage()->addMessage('Data Updated Successfully.',1);
                }
                else
                {
                    $categoryData->createdAt = date('y-m-d h:m:s');
                    if(!$categoryData->parentId){
                        unset($categoryData->parentId);
                        print_r($categoryData);
                        $insert = $categoryModel->save();
                        $categoryId = $insert->categoryId;
                        if(!$insert->categoryId)
                        {
                            $this->getMessage()->addMessage('unable to Inser Data.',3);
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->resetData();
                        $categoryData->path = $categoryId;
                        $categoryData->categoryId = $categoryId;
                        $result = $categoryModel->save();
                        $this->getMessage()->addMessage('data inserted successfully',1);
                    }
                    else{
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->categoryId = $insert->categoryId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insert->categoryId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to insert data.',3);
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                }
                $this->getMessage()->addMessage('data inserted successfully',1);
                $this->redirect('grid','category',[],true);
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        try {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            if(!$request->getRequest('id')){
                throw new Exception("Invalid Request", 1);
            }
            $id = $request->getRequest('id');
            $medias = $categoryModel->fetchAll("SELECT name FROM category_media WHERE  categoryId='$id'");
            foreach ($medias as $media)
            {
                unlink($this->getView()->getBaseUrl("Media/Category/"). $media->name);
            }
            $result = $categoryModel->load($id)->delete();
            if(!$result)
            {
                $this->getMessage()->addMessage('unable to deleted.',3);
                throw new Exception("System is unable to delete data.", 1);
            }
            $this->getMessage()->addMessage('deleted succesully.',1);
            $this->redirect('grid','category',[],true);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

}

?>