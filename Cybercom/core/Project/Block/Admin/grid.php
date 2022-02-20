<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Admin_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
	}
	public function getAdmins()
	{
		$adminModel = Ccc::getModel('Admin');
		$admins = $adminModel->fetchAll("SELECT * FROM admin");
		return $admins;	

	}
	
}


?>