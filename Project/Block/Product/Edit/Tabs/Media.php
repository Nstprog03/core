<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Product_Edit_Tab');

class Block_Product_Edit_Tabs_Media extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/product/edit/tabs/media.php');
    }

    public function getMedia()
    {
        return Ccc::getRegistry('media');
    }

    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $product_id = $request->getRequest('id');
        $productModel = Ccc::getModel('Product');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
    }

}
