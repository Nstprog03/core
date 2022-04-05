<?php Ccc::loadClass('Model_Core_Row');

class Model_Order_Item extends Model_Core_Row
{
    public function __construct()
    {
        $this->setResourceClassName('Order_Item_Resource');
        parent::__construct();
    }
    public function setProduct(Model_Product $product)
    {
        $this->product = $product;
        return $this;
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
}
