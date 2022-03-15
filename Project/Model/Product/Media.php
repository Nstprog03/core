<?php Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row
{
	protected $product;
	public function __construct()
	{
		$this->setResourceClassName('Product_Media_Resource');
		parent::__construct();
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product'); 
		if(!$this->productId)
		{
			return $productModel;
		}
		if($this->product && !$reload)
		{
			return $this->product;
		}
		$product = $productModel->fetchRow("SELECT * FROM `product` WHERE `productId` = {$this->productId}");
		if(!$product)
		{
			return $productModel;
		}
		$this->setProduct($product);

		return $this->product;
	}

	public function setProduct($product)
	{
		$this->product =$product;
		return $this;
	}

}

?>