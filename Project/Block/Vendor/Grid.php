<?php Ccc::loadClass('Block_Core_Template');

class Block_Vendor_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}
	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
		$vendorModel = Ccc::getModel('vendor');
		$totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(vendorId) FROM `vendor`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $vendors = $vendorModel->fetchAll("SELECT * FROM `vendor` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
		return $vendors;
	}
	public function getAddresses()
	{
		$addressModel = Ccc::getModel('vendor_address');
		$addresses = $addressModel->fetchAll("SELECT * FROM `vendor_address`");
		return $addresses;
	}
}