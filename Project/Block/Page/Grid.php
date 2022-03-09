<?php Ccc::loadClass('Block_Core_Template');

class Block_Page_Grid extends Block_Core_Template
{

	public function __construct()
	{
		$this->setTemplate('view\page\grid.php');
	}
	public function getPages()
	{
		$pageModel = Ccc::getModel('Page');
		$pages = $pageModel->fetchAll('SELECT * FROM `page`');
		return $pages;
	}


}




?>


