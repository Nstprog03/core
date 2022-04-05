<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Salesman_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/salesman/edit/tabs/personal.php');
    }

    public function getSalesman()
    {
        return Ccc::getRegistry('salesman');
    }
}