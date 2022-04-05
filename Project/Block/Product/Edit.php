<?php Ccc::loadClass("Block_Core_Edit"); ?>
<?php Ccc::loadClass("Block_Product_Edit_Tab");
class Block_Product_Edit extends Block_Core_Edit
{
    public function __construct()
    {
        parent::__construct();
    }
        
    public function getSaveUrl()
    {
        return $this->getUrl('save','product');
    }

    public function getproduct()
    {
        $product = $this->product;
        return $product;
    }

    public function getCategories()
    {
        $category = Ccc::getModel('Category');
        $categories = $category->fetchAll("SELECT * FROM `category` WHERE `status` = 1 ");
        if(!$categories){
            return null;
        }
        return $categories;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$path1' ");
            if($path1 != $categoryId){
                $finalPath .= $category->name ."=>";
            }else{
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }

}

?>