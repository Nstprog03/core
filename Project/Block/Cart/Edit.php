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

   
}
