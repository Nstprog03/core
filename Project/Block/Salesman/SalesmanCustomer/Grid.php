<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesman_SalesmanCustomer_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesman/salesmancustomer/grid.php");
    }

    public function getCustomers()
    {
        $salesmanId = Ccc::getFront()->getRequest()->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE (`salesmanId` is null OR `salesmanId` = '$salesmanId') AND `status` = '1' ");
        return $customers;
    }

    public function getSalesmanId()
    {
        return Ccc::getFront()->getRequest()->getRequest('id');
    }

    public function selected($customerId)
    {
        $request = Ccc::getFront()->getRequest();
        $salesmanId = $request->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $select = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customerId` = '$customerId' AND `salesmanId` = '$salesmanId'");
        if($select){
            return 'checked disabled';
        }
        return null;
    }

}