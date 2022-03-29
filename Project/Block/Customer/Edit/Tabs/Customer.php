<?php Ccc::loadClass('Block_Core_Template');

class Block_Customer_Edit_Tabs_Customer extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/customer/edit/tabs/customer.php');
    }

    public function getCustomer()
    {
        return Ccc::getRegistry('customer');
    }
}