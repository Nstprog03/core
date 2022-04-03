<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Vendor_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/vendor/edit/tabs/address.php');
    }
    public function getAddress()
    {
        return Ccc::getRegistry('address');
    }
    public function getVendor()
    {
        return Ccc::getRegistry('vendor');
    }
}