<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Category_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}
	public function getCategories()
	{
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
		$categoryModel = Ccc::getModel('Category');
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT count(categoryId) FROM `category`");
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
		$categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
		return $categories;
	}
    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1)
         {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$path1' ");
            if($path1 != $categoryId)
            {
                $finalPath .= $category->name ."=>";
            }
            else
            {
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }
    public function getMedia($mediaId)
    {
        $mediaModel = Ccc::getModel('category');
        $media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `mediaId` = '$mediaId'");
        return $media[0]->getData();
    }
	
}


?>