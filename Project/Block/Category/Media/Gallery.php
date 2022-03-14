<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Media_Gallery extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/media/gallery.php");
    }

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $categoryId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Category_Media');
        $medias = $mediaModel->fetchAll("SELECT `name`,`mediaId` FROM `category_media` WHERE `categoryId` = $categoryId AND `gallery` = 1 ");
        return $medias;
    }
}

?>