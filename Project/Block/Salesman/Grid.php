<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Salesman_Grid extends Block_Core_Grid {

	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

    public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Salesman Id',
		'type' => 'int',
		'key' =>'salesmanId'
		],'id');
		$this->addColumn([
		'title' => 'First Name',
		'type' => 'varchar',
		'key' =>'firstName'
		],'First Name');
		$this->addColumn([
		'title' => 'Last Name',
		'type' => 'varchar',
		'key' =>'lastName'
		],'Last Name');
		$this->addColumn([
		'title' => 'Email',
		'type' => 'varchar',
		'key' =>'email'
		],'Email');
		$this->addColumn([
		'title' => 'Mobile',
		'type' => 'int',
		'key' =>'mobile'
		],'Mobile');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'int',
		'key' =>'status'
		],'Status');
		$this->addColumn([
		'title' => 'Percentage',
		'type' => 'float',
		'key' =>'discount'
		],'Percentage');
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
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'salesman' ],'Delete');
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'salesman' ],'Edit');
		$this->addAction(['title' => 'Manage','method' => 'getCustomerUrl','class' => 'salesman_salesmanCustomer' ],'Customer');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $salesmans = $this->getSalesmans();
        $this->setCollection($salesmans);
        return $this;
    }
    

    public function getSalesmans()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('salesmanId') FROM `salesman`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $salesmans = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $salesmanColumn = [];
        if($salesmans)
        {	
	        foreach ($salesmans as $salesman) 
	        {
	            array_push($salesmanColumn,$salesman);
	        }        
        }
        return $salesmanColumn;
    }
    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }
	
}


?>