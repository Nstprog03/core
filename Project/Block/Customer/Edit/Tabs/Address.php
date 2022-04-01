<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Customer_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/customer/edit/tabs/address.php');
    }

    public function getShippingAddress()
    {
        return Ccc::getRegistry('shippingAddress');
    }

    public function getBillingAddress()
    {
        return Ccc::getRegistry('billingAddress');
    }
    public function getCustomer()
    {
        return Ccc::getRegistry('customer');
    }
}