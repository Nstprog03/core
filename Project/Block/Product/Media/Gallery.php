<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Media_Gallery extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/media/gallery.php");
    }

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Product_Media');
        $medias = $mediaModel->fetchAll("SELECT `name`,`mediaId` FROM `product_media` WHERE `productId` = $productId AND `gallery` = 1 ");
        return $medias;
    }
}

?>