<?php Ccc::loadClass('Model_Core_Row');

class Model_Cart_Item extends Model_Core_Row
{
	protected $cart = null;
	protected $product = null;
	public function __construct()
	{
		$this->setResourceClassName('Cart_Item_Resource');
		parent::__construct();
	}

	public function setCart(Model_Cart $cart)
	{
		$this->cart = $cart;
		return $this;
	}

	public function getCart($reload = false)
	{
		$cartModel = Ccc::getModel('Cart');
		if(!$this->cartId){
			return $cartModel;
		}
		if($this->cart && !$reload){
			return $this->cart;
		}

		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `cartId` = {$this->cartId}");
		if(!$cart){
			return $cartModel;
		}
		$this->setcart($cart);
		return $this->cart;
	}

	public function setProduct(Model_Product $product)
	{
		$this->product = $product;
		return $this;
	}

	public function getProduct($reload = false)
	{
		$productModel = Ccc::getModel('Product');
		if(!$this->productId){
			return $productModel;
		}
		if($this->product && !$reload){
			return $this->product;
		}

		$product = $productModel->fetchRow("SELECT * FROM `product` WHERE `productId` = {$this->productId}");
		if(!$product){
			return $productModel;
		}
		$this->setProduct($product);
		return $this->product;
	}
}

?>