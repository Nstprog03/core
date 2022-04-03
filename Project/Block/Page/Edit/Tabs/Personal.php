<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Page_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/page/edit/tabs/personal.php');
    }

    public function getPage()
    {
        return Ccc::getRegistry('page');
    }
}