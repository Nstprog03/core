<?php Ccc::loadClass('Block_Core_Template');

class Block_Page_Grid extends Block_Core_Template   
{
    public $pager;

    public function __construct()
    {
        $this->setTemplate('view/page/grid.php');
    }

    public function getPages()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $pageModel = Ccc::getModel('Page');	
        $totalCount = $pagerModel->getAdapter()->fetchAssos("SELECT count(pageId) AS `count` FROM `page`");

        $pagerModel->execute($totalCount['count'], $page);
        $this->pager = $pagerModel;
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        echo "<pre>";
        
        return $pages;
    }
}

