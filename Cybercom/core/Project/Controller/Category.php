<?php
Ccc::loadClass('Controller_Core_Action');

class Controller_Category extends Controller_Core_Action{

    public function gridAction()
    {
        $adapter = new Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY `path`");

        
        $view = $this->getView();
        $view->setTemplate('view/category/grid.php');
        $view->addData('categories',$categories);
        $view->toHtml();
    }

    public function pathAction()
    {
        $adapter = new Adapter();
        $categoryName = $adapter->fetchPair('SELECT `categoryID`, `name` FROM `category`');
        $categoryPath = $adapter->fetchPair('SELECT `categoryID`, `path` FROM `category`');
        $categories=[];
        foreach ($categoryPath as $key => $value) {
                $explodeArray=explode('/', $value);
                $tempArray = [];

                foreach ($explodeArray as $keys => $value) {
                    if(array_key_exists($value,$categoryName)){
                        array_push($tempArray,$categoryName[$value]);
                    }
                }

                $implodeArray = implode('/', $tempArray);
                $categories[$key]= $implodeArray;
        }
        return $categories;
    }


    protected function saveCategory(){
        try {
            if(!isset($_POST['category']))
            {
                throw new Exception("Request Invalid.",1);
            }
            
            $adapter = new Adapter();

            $row = $_POST['category'];
            
            $categoryName = $_POST['category']['name'];
            $categoryParentID = $_POST['category']['parentID'];
            $categoryStatus = $_POST['category']['status'];
            $createdDate = date('y-m-d h:m:s');
            $updatedDate = date('y-m-d h:m:s');

            if(isset($_GET['id']))
            {
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryID = $_GET['id'];
                $parent = $_POST['category']['root'];

                $data = $adapter->update("UPDATE category SET name ='$categoryName', status ='$categoryStatus', updatedDate ='$updatedDate' where categoryID = $categoryID");


                if(empty($parent))
                {
                    $path = $adapter->update("UPDATE category SET parentID = NULL,`path`='$categoryID' WHERE categoryID = '$categoryID'");

                    $parentID = $_POST['category']['parentID'];

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
                    $parentID = $_POST['category']['parentID'];

                    $row = $adapter->fetchAssos("SELECT * FROM category WHERE categoryID='$parent'");
                    $parentPath = $row['path'];

                    $query = $adapter->fetchAssos("SELECT * FROM category where categoryID='$categoryID'");
                    $currentpath = $query['path'];

                    $possiblePath = $adapter->fetchAll("SELECT * from category where `path` LIKE '$currentpath%'");

                    foreach($possiblePath as $allPath)
                    {
                        //$currentID = $allData['categoryID'];
                        $path = $allPath['path'];

                        $updatePath = ltrim($path , $parentID);
                        $updatePath = ltrim($updatePath , '/');

                        if($allPath['categoryID']!=$categoryID)
                        {
                            $parent = $allPath['parentID']; //Parent Id
                            $FinalUpdate = $parentPath.'/'.$updatePath; // Updated Path
                            $currentID = $allPath['categoryID']; // Current Id
                        }
                        else
                        {
                            $parent = $parentPath; // Parent Id
                            $FinalUpdate = $parentPath.'/'.$updatePath; //Updated Path
                            $currentID = $allPath['categoryID']; // Current Id
                        }

                        $path = $adapter->update("UPDATE category SET parentID='$parent',`path` = '$FinalUpdate' WHERE categoryID = '$currentID'");
                    }
                    if($data)
                    {
                        $this->redirect('index.php?c=category&a=grid');
                    }
                    else{
                        throw new Exception("Data Not Upadated", 1);
                    }
                }
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
                
                return $result;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function saveAction()
    {
        try
        {
            $this->saveCategory();
            $this->redirect('index.php?c=category&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function editAction()
    {
        try {
            if(!isset($_GET['id'])){
                throw new Exception("Invalid Request.", 1);
            }
            if(!(int)$_GET['id']){
                throw new Exception("Invalid Request.", 1);
            }

            $categoryID = $_GET['id'];

            $adapter = new Adapter();
            $row = $adapter->fetchAssos("SELECT * FROM category WHERE categoryID = $categoryID");
            $categories = $adapter->fetchAll("SELECT * FROM category ORDER BY `path`");

            $view = $this->getView();
            $view->addData('categories',$row);
            $view->addData('allData',$categories);
            $view->setTemplate('view/category/edit.php');
            $view->toHtml();
            
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function addAction()
    {
        $adapter = new Adapter();
        $categories = $adapter->fetchAll("SELECT * FROM `category` ORDER BY `parentID`");
        

        $view = $this->getView();
        $view->addData('categories',$categories);
        $view->setTemplate('view/category/add.php');
        $view->toHtml();
    }

    protected function deleteCategory()
    {
        try {
            if($_SERVER['REQUEST_METHOD']=='GET')
            {
                if(!isset($_GET['id'])){
                    throw new Exception("Invalid Request.", 1);
                }
                if(!(int)$_GET['id']){
                    throw new Exception("Invalid Request.", 1);
                }
                $categoryID = $_GET['id'];
                $adapter = new Adapter();
                $result = $adapter->delete("DELETE FROM category WHERE categoryID = '$categoryID'");
                if(!$result)
                {
                    throw new Exception("System is unable to delete record.",1);
                }
                $this->redirect('index.php?c=category&a=grid');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->redirect('category-index.php?a=gridAction');
        }
    }

    public function deleteAction()
    {
        try
        {
            $this->deleteCategory();
            $this->redirect('index.php?c=category&a=grid');
        }
        catch (Exception $e) 
        {
            $this->redirect('index.php?c=category&a=grid');
        }
    }


    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }


    public function errorAction()
    {
        echo "404<br>Not Found.";
    }
}

?>
