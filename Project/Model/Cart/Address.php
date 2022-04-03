<?php Ccc::loadClass('Model_Core_Row');

class Model_Cart_Address extends Model_Core_Row
{
	protected $cart = null;
	public function __construct()
	{
		$this->setResourceClassName('Cart_Address_Resource');
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
}

?>