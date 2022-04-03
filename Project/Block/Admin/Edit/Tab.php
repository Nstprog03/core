    <?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Admin_Edit_Tab extends Block_Core_Edit_Tab
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('personal');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Personal Info',
            'block' => 'Admin_Edit_Tabs_Personal',
            'url' => $this->getUrl(null,null,['tab' => 'personal'])
        ],'personal');
        // $this->addTab([
        //     'title' => 'Address Info',
        //     'block' => 'Admin_Edit_Tabs_Address',
        //     'url' => $this->getUrl(null,null,['tab' => 'address'])
        // ],'address');
        // $this->addTab([
        //     'title' => 'Address Info 1',
        //     'block' => 'Admin_Edit_Tabs_Address',
        //     'url' => $this->getUrl(null,null,['tab' => 'address1'])
        // ],'address1');
    }
}