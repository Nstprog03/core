<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        $categoryId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Category_Media');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(mediaId) FROM `category_media` WHERE `categoryId` = $categoryId ");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $category = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = $categoryId LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $category;
    } 

    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $categoryId = $request->getRequest('id');
        $categoryModel = Ccc::getModel('Category');
        $select = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
    }
}

?>