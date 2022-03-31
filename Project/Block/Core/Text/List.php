<?php Ccc::loadClass('Block_core_Template');

class Block_Core_Text_List extends Block_core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('view/core/text/list.php');
    }

}