<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	public function getProducts()
	{
		$productModel = Ccc::getModel('Product');
		$query = "SELECT * FROM `product`";
		$products = $productModel->fetchAll($query);
		return $products;	

	}
	public function getMedia($mediaId)
	{
		$mediaModel=Ccc::getModel('Product_Media');
		$query="SELECT * FROM `product_media` WHERE `mediaId` = {$mediaId}";
		$media = $mediaModel->fetchAll($query);
		return $media[0]->getData();
	}
	
}


?>