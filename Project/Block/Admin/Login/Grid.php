<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Admin_Login_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/admin/login/grid.php");
    }

}

?>