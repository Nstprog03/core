<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Vendor_Grid extends Block_Core_Grid {

	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

    public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Vendor Id',
		'type' => 'int',
		'key' =>'vendorId'
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
		'title' => 'Address',
		'type' => 'varchar',
		'key' =>'address'
		],'Address');
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
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'vendor' ],'Delete');
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'vendor' ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $vendors = $this->getVendors();
        $this->setCollection($vendors);
        return $this;
    }
    

    public function getVendors()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppr',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('vendorId') FROM `vendor`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $vendors = $vendorModel->fetchAll("SELECT * FROM `vendor` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $vendorColumn = [];
        foreach ($vendors as $vendor) {
            $address = null; 
            //$vendor->status = $vendor->getStatus($vendor->status);
            foreach($vendor->getAddress()->getData() as $key => $value){
                if($key != 'addressId' && $key != 'vendorId'){
                    $address .= $key." : ".$value."<br>";
                }
            }
            $vendor->setData(['address' => $address]);
            array_push($vendorColumn,$vendor);
        }        
        return $vendorColumn;
    }
    public function getAdapter()
    {
    	global $adapter;
    	return $adapter;
    }
	
}


?>