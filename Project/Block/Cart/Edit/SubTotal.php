<?php
Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_SubTotal extends Block_Core_Template{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/subTotal.php");
    }

    public function getCart()
	{
		if(!Ccc::getModel('Admin_Cart')->getCart()){
			return Ccc::getModel('Cart');
		}
		$cartId = Ccc::getModel('Admin_Cart')->getCart();
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		return $cartModel;
	}

    public function getItems()
	{
		$itemModel = Ccc::getModel('Cart_Item');
		if(!Ccc::getModel('Admin_Cart')->getCart()){
			return null;
		}
		$cartId = Ccc::getModel('Admin_Cart')->getCart();
		$items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cartId} ");
		return $items;
	}

    public function getTotal()
	{
		$itemModel = Ccc::getModel('Cart_Item');
		if(!Ccc::getModel('Admin_Cart')->getCart()){
			return null;
		}
		$cartId = Ccc::getModel('Admin_Cart')->getCart();
		$items = Ccc::getModel('Core_Row_Resource')->getAdapter()->fetchOne("SELECT sum(`itemTotal`) FROM `cart_item` WHERE `cartId` = {$cartId} ");
		return $items;
	}

	public function getTax($cartId)
	{
		if($cartId){
			$tax =Ccc::getModel('Core_Row_Resource')->getAdapter()->fetchOne("SELECT sum(ci.itemTotal * p.tax / 100) FROM `cart_item` as ci JOIN `product` as p ON ci.productId = p.productId WHERE ci.cartId = {$cartId}");
			return $tax;	
		}
		return null;
	}


}


?>