<?php Ccc::loadClass("Block_Core_Template");

class Block_Order_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/order/grid.php");
    }
}
