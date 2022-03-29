<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Page_Grid extends Block_Core_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        
        $this->addColumn([
        'title' => 'Page Id',
        'type' => 'int',
        'key' =>'pageId'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'name'
        ],'Name');
        $this->addColumn([
        'title' => 'Code',
        'type' => 'varchar',
        'key' =>'code'
        ],'Code');
        $this->addColumn([
        'title' => 'Content',
        'type' => 'varchar',
        'key' =>'content'
        ],'Content');
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
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'page' ],'Delete');
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'page' ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $pages = $this->getPages();
        $this->setCollection($pages);
        return $this;
    }

    public function getPages()
    {
        $pageModel = Ccc::getModel('Page');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('pageId') FROM `page`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $pageColumn = [];
        foreach ($pages as $page) 
        {
            array_push($pageColumn,$page);
        }        
        return $pageColumn;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
    
}


?>
