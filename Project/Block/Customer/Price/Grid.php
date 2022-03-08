<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Price_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/price/grid.php");
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('product');
        $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `status` = '1' ");
        return $products;
    }

    public function getDiscount($productId)
    {

        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $customerPriceModel = Ccc::getModel('Customer_Price');
        $discount = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `productId` = '$productId' AND `customerId` = '$customerId' ");
        if(!$discount){
            return null;
        }
        return $discount[0]->getData()['discount'];
    }

}

?>