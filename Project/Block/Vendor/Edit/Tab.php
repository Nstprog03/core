<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Vendor_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('vendor');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Vendor Info',
            'block' => 'Vendor_Edit_Tabs_Vendor',
            'url' => $this->getUrl(null,null,['tab' => 'vendor'])
        ],'vendor');
        $this->addTab([
            'title' => 'Address Info',
            'block' => 'Vendor_Edit_Tabs_Address',
            'url' => $this->getUrl(null,null,['tab' => 'address'])
        ],'address');
    }
}