<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php
class Controller_Category extends Controller_Core_Action{

    public function gridAction()
    {
        Ccc::getBlock('Category_Grid')->toHtml();
    }

    public function addAction()
    {
        $categoryModel = Ccc::getModel('Category');
        $category = $categoryModel;
        Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
    }

    public function editAction()
    {
        $categoryModel = Ccc::getModel('Category');
        $request = $this->getRequest();
        $id = $request->getRequest('id');
        if(!$id){
            throw new Exception("Invalid request", 1);
        }
        if(!(int)$id){
            throw new Exception("Invalid request", 1);
        }
        $category = $categoryModel->load($id);
        if(!$category){
            throw new Exception("Invalid request", 1);
        }
        Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
    }

    public function saveAction()
    {
        try {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            $id = $request->getRequest('id');
            if($request->isPost()){
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id)){
                    $categoryData->categoryId = $id;
                    $categoryData->updatedAt = date('y-m-d h:m:s');
                    if(!$postData['parentId']){
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result){
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) {
                            if($subPath == $id){
                                if(count($finalPath) != 1){
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
                        else{
                            $path->path = $path->categoryId;
                        }
                        $result = $path->save();
                    }
                }
                else{
                    $categoryData->createdAt = date('y-m-d h:m:s');
                    if(!$categoryData->parentId){
                        unset($categoryData->parentId);
                        $insertId = $categoryModel->save();
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->resetData();
                        $categoryData->path = $insertId;
                        $categoryData->categoryId = $insertId;
                        $result = $categoryModel->save();
                    }
                    else{
                        $insertId = $categoryModel->save();
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $categoryData->categoryId = $insertId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insertId;
                        $result = $categoryData->save();
                    }
                    if(!$result){
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                }
                $this->redirect($this->getView()->getUrl('grid','category',[],true));
            }
        } catch (Exception $e) {
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
            if(!$result){
                throw new Exception("System is unable to delete data.", 1);
            }
            $this->redirect($this->getView()->getUrl('grid','category',[],true));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>