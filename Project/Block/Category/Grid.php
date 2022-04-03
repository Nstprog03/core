<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Category_Grid extends Block_Core_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {

        $this->addColumn([
        'title' => 'Category Id',
        'type' => 'int',
        'key' =>'categoryId'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'finalPath'
        ],'Name');
        $this->addColumn([
        'title' => 'Base Image',
        'type' => 'varchar',
        'key' =>'base'
        ],'Base Image');
        $this->addColumn([
        'title' => 'Thumb Image',
        'type' => 'varchar',
        'key' =>'thumb'
        ],'Thumb Image');
        $this->addColumn([
        'title' => 'Small Image',
        'type' => 'varchar',
        'key' =>'small'
        ],'Small Image');
        $this->addColumn([
        'title' => 'Status',
        'type' => 'int',
        'key' =>'status'
        ],'Status');
        $this->addColumn([
        'title' => 'Created Date',
        'type' => 'datetime',
        'key' =>'createdAt'
        ],'Created Date');
        $this->addColumn([
        'title' => 'Updated Date',
        'type' => 'datetime',
        'key' =>'updatedAt'
        ],'Updated Date');
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'category' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'category' ],'Delete');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $categorys = $this->getCategorys();
        $this->setCollection($categorys);
        return $this;
    }
    

    public function getCategorys()
    {   
        $categoryModel = Ccc::getModel('Category');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('categoryId') FROM `category`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $categorys = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`  LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $categoryColumn = [];
        foreach ($categorys as $category) 
        {
            $category->finalPath = $this->getPath($category->categoryId,$category->path);
            array_push($categoryColumn,$category);
        }        
        return $categoryColumn;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1)
         {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$path1' ");
            if($path1 != $categoryId)
            {
                $finalPath .= $category->name ."=>";
            }
            else
            {
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
    
}


?>