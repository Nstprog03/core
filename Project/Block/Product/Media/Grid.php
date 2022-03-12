<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $productId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Product_Media');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(mediaId) FROM `product_media` WHERE `productId` = $productId ");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = $productId LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $medias;
    }
    
    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $productModel = Ccc::getModel('Product');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
    }
}

?>