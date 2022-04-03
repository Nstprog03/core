<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Admin_Grid extends Block_Core_Grid {

	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

    public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Admin Id',
		'type' => 'int',
		'key' =>'adminId'
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
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'admin' ],'Delete');
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'admin' ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        $this->setCollection($admins);
        return $this;
    }

    public function getAdmins()
    {
        $adminModel = Ccc::getModel('Admin');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->	getAdapter()->fetchOne("SELECT COUNT('adminId') FROM `admin`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $adminColumn = [];
        foreach ($admins as $admin) 
        {
            array_push($adminColumn,$admin);
        }        
        return $adminColumn;
    }
    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }
	
}


?>