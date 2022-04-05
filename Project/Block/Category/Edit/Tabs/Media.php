<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Category_Edit_Tab');

class Block_Category_Edit_Tabs_Media extends Block_Core_Edit_Tabs_Content
{ 
    public function __construct()
    {
        $this->setTemplate('view/category/edit/tabs/media.php');
    }

    public function getMedia()
    {
        return Ccc::getRegistry('media');
    }

    public function selected($mediaId, $column)
    {
        $request = Ccc::getFront()->getRequest();
        $categoryId = $request->getRequest('id');
        $categoryModel = Ccc::getModel('Category');
        $select = $categoryModel->fetchAll("SELECT * FROM `category` WHERE {$column} = {$mediaId}");
        if($select)
        {
            return 'checked';
        }
    }
}
