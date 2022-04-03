<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Config_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/config/edit/tabs/personal.php');
    }

    public function getConfig()
    {
        return Ccc::getRegistry('config');
    }
}