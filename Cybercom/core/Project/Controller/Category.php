<?php
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Admin');
Ccc::loadClass('Model_Core_Request');
?>
<?php 
class Controller_Category extends Controller_Core_Action{

    public function gridAction()
    {

        Ccc::getBlock('Category_Grid')->toHtml();
    }


    public function saveAction(){
        try {
            $request = $this->getRequest();
            $postData = $request->getPost('category');
            if(!$postData)
            {
                throw new Exception("Request Invalid.",1);
            }
            
            $adapter = new Adapter();
            
            $categoryName = $postData['name'];
            $categoryParentID = $postData['parentID'];
            $categoryStatus = $postData['status'];
            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');
            if(array_key_exists('categoryID', $postData))
            {
                $categoryID = $_GET['id'];
                if(!(int)$categoryID){
                    throw new Exception("Invalid Request.", 1);
                }
                $parent = $postData['root'];

                $data = $adapter->update("UPDATE category SET name ='$categoryName', status ='$categoryStatus', updatedDate ='$updatedDate' where categoryID = $categoryID");


                if(empty($parent))
                {
                    $path = $adapter->update("UPDATE category SET parentID = NULL,`path`='$categoryID' WHERE categoryID = '$categoryID'");

                    $parentID = $postData['parentID'];

                    $data = $adapter->fetchAll("SELECT * FROM category WHERE `path` LIKE '%$categoryID%'");

                    foreach($data as $allData)
                    {
                        $path = $allData['path'];
                        if($allData['categoryID']!=$categoryID)
                        {
                            $currentID = $allData['categoryID'];
                            $updatePath = ltrim($path , $parentID);
                            $finalPath = ltrim($updatePath , '/');
                            $parentID = $allData['parentID'];
                                        
                            $path = $adapter->update("UPDATE category SET parentID=$parentID,`path`='$finalPath' WHERE categoryID='$currentID'");
                        }
                    }
                }
                else
                {
                    $parentID = $postData['parentID'];

                    $row = $adapter->fetchAssos("SELECT * FROM category WHERE categoryID='$parent'");
                    $parentPath = $row['path'];

                    $query = $adapter->fetchAssos("SELECT * FROM category where categoryID='$categoryID'");
                    $currentpath = $query['path'];

                    $possiblePath = $adapter->fetchAll("SELECT * from category where `path` LIKE '$currentpath%'");

                    foreach($possiblePath as $allPath)
                    {
                        $currentID = $allData['categoryID'];
                        $path = $allPath['path'];

                        $updatePath = ltrim($path , $parentID);
                        $updatePath = ltrim($updatePath , '/');

                        $updatePath = explode('/', $updatePath);

                                
                        foreach ($updatePath as $value) {
                            if($value==$categoryID){
                                break;
                            }
                            array_shift($updatePath);
                        }
                        
                        $path = implode('/', $updatePath);

                        if($allPath['categoryID']!=$categoryID)
                        {
                            $parent = $allPath['parentID']; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentID = $allPath['categoryID']; 
                        }
                        else
                        {
                            $parent = $parentPath; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentID = $allPath['categoryID']; 
                        }

                        $path = $adapter->update("UPDATE category SET parentID='$parent',`path` = '$FinalUpdate' WHERE categoryID = '$currentID'");
                    }
                    if(!$path)
                    {
                        
                        throw new Exception("Data Not Upadated", 1);
                    }
                }
                    $this->redirect($this->getView()->getUrl('category','grid'));
            }
            else
            {
                if(empty($categoryParentID))
                {
                    $result = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdDate`) VALUE ('$categoryName','$categoryStatus','$createdDate')");
                    if(!$result){
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->update("UPDATE `category` SET `path` = '$result' WHERE `categoryID` = '$result' ");
                }
                
                else
                {
                    $result = $adapter->insert("INSERT INTO `category` (`parentID`,`name`,`status`,`createdDate`) VALUE ('$categoryParentID','$categoryName','$categoryStatus','$createdDate')");
                    if(!$result)
                    {
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryID` = '$categoryParentID' ");
                    $path = $path['path']."/".$result;
                    $newPath = $adapter->update("UPDATE `category` SET `path` = '$path' WHERE `categoryID` = '$result' ");
                }
                if(!$result)
                {
                    throw new Exception("Sysetm is unable to save your data", 1);   
                }
                 $this->redirect($this->getView()->getUrl('category','grid'));
            }
        } 
        catch (Exception $e) {
            echo "<pre>";
            print_r($e);
            exit;
            $this->redirect($this->getView()->getUrl('category','grid'));
        }
    }


    public function editAction()
    {
        try {
            $categoryID=(int)$this->getRequest()->getRequest('id');
            if(!isset($categoryID)){
                throw new Exception("Invalid Request.", 1);
            }
            $categoryModel = Ccc::getModel('Category');        
            $adapter = new Adapter();
            $category = $adapter->fetchAssos("SELECT * FROM `category` WHERE `categoryID` = '$categoryID'");
            $categories = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` NOT LIKE '%$categoryID%' ORDER BY `path`");
            Ccc::getBlock('Category_Edit')->addData('category',$category)->addData('categories',$categories)->toHtml();
            
        } 
        catch (Exception $e) {
            echo "<pre>";
            print_r($e);
            exit;
            $this->redirect($this->getView()->getUrl('category','grid'));
        }
    }


    public function addAction()
    { //echo "<pre>";
        $categoryModel = Ccc::getModel('Category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `parentID`");
        
        Ccc::getBlock('Category_Add')->addData('categories',$categories)->toHtml();
    }

    public function deleteAction()
    {
        try {

               $categoryID=(int)$this->getRequest()->getRequest('id');
                if(!isset($categoryID))
                {
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryModel = Ccc::getModel('Category');

                $result = $categoryModel->delete($categoryID);
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect($this->getView()->getUrl('category','grid'));
            }
         catch (Exception $e) {
            $this->redirect($this->getView()->getUrl('category','grid'));
        }
    }



}

?>
