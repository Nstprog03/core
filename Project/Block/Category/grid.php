<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Category_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}
	public function getCategories()
	{
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
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