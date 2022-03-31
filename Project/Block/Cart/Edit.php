<?php Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit extends Block_Core_Template   
{
    public function __construct()
    {
        $this->setTemplate('view/cart/edit.php');
    }  

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('Customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer`");
        return $customer;
    }

    public function getCart()
    {
        if(!Ccc::getModel('Admin_Cart')->getCart())
        {
            return Ccc::getModel('Cart');
        }
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
        $cartModel = Ccc::getModel('Cart')->load($cartId);
        return $cartModel;
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('Product');
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
        if($cartId)
        {
            $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `productId` NOT IN (SELECT `productId` FROM `cart_item` WHERE `cartId` = $cartId)");

            return $products;
        }
        else
        {
            $products = $productModel->fetchAll("SELECT * FROM `product`");
            return $products;
        }
    }

    public function getItems()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
        if($cartId)
        {
            $items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }

    public function getTotal()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = Ccc::getModel('Admin_Cart')->getCart();
        if($cartId)
        {
            $items = $itemModel->getResource()->getAdapter()->fetchOne("SELECT sum(`itemTotal`) FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }
    public function getTax($cartId)
    {
        if($cartId)
        {
            $tax = Ccc::getModel('Core_Row_Resource')->getAdapter()->fetchOne("SELECT sum(c.itemTotal * p.tax / 100) FROM `cart_item` as c JOIN `product` as p ON c.productId = p.productId WHERE c.cartId = {$cartId}");
            return $tax;    
        }
        return null;
    }
    public function getPaymentMethods()
    {
        $payModel = Ccc::getModel('Cart');
        $paymentMethods = $payModel->fetchAll("SELECT * FROM `payment_method`");
        return $paymentMethods;
    }
    public function getShippingMethods()
    {
        $shippModel = Ccc::getModel('Cart');
        $shippingMethods = $shippModel->fetchAll("SELECT * FROM `shipping_method`");
        return $shippingMethods;
    }
}
