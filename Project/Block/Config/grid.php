<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Config_Grid extends Block_Core_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        
        $this->addColumn([
        'title' => 'Config Id',
        'type' => 'int',
        'key' =>'configId'
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
        'title' => 'Value',
        'type' => 'varchar',
        'key' =>'value'
        ],'Value');
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
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'config' ],'Delete');
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'config' ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $configs = $this->getConfigs();
        $this->setCollection($configs);
        return $this;
    }

    public function getConfigs()
    {
        $configModel = Ccc::getModel('Config');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('configId') FROM `config`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $configs = $configModel->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $configColumn = [];
        if($configs)
        {
            foreach ($configs as $config) 
            {
                array_push($configColumn,$config);
            }  
        }
              
        return $configColumn;
    }
    public function getAdapter()
    {
        global $adapter;
        return $adapter;
    }
    
}


?>
