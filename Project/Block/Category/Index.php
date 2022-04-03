<?php Ccc::loadClass('Block_Core_Template');

class Block_Category_Index extends Block_Core_Template   
{
    public function __construct()
    {
        $this->setTemplate('view/category/index.php');
    }
}
