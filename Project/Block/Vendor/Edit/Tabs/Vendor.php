<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Vendor_Edit_Tabs_Vendor extends Block_Core_Edit_Tabs_Content  
{ 
    public function __construct()
    {
        $this->setTemplate('view/vendor/edit/tabs/vendor.php');
    }

    public function getVendor()
    {
        return Ccc::getRegistry('vendor');
    }
}