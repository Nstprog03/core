<?php
Ccc::loadClass('Block_Core_Template');
class Block_Product_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{

		$this->setTemplate('view/product/edit.php');
	}
	
	public function getProduct()
   	{
  
   		return $this->getData('product');
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

    public function selected($categoryId)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $categoryProductModel = Ccc::getModel('Product_CategoryProduct');
        $select = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$productId' AND `category_id` = '$categoryId'");
        if($select){
            return 'checked';
        }
        return null;
    }

}
?>