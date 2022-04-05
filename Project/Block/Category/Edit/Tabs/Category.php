<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Category_Edit_Tabs_Category extends Block_Core_Edit_Tabs_Content
{ 
    public function __construct()
    {
        $this->setTemplate('view/category/edit/tabs/category.php');
    }

    public function getCategory()
    {
        return Ccc::getRegistry('category');
    }

    public function getCategories()
    {
        $categoryModel = Ccc::getModel('category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $categories;
    }

    public function getPath($categoryId, $path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1)
        {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->load($path1);
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
}
