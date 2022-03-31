<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
	}
	public function getProducts()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
		$productModel = Ccc::getModel('Product');
		$totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(productId) FROM `product`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $products = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
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