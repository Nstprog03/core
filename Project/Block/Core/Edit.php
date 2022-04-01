<?php Ccc::loadClass('Block_Core_Template');
//Ccc::loadClass('Block_Customer_Edit_Tab');
// Ccc::loadClass('Block_Admin_Edit_Tab');
// Ccc::loadClass('Block_Category_Edit_Tab');
// Ccc::loadClass('Block_Config_Edit_Tab');

class Block_Core_Edit extends Block_Core_Template  
{
    protected $tab = null; 
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('view/core/edit.php');
    }

    public function getEditUrl()
    {
        return $this->getUrl('save');
    }

    public function getTab()
    {
        if($this->tab)
        {
            return $this->tab;
        }
        $className =  get_class($this).'_Tab';
        $object = new $className();
        $object->setEdit($this);
        $this->setTab($object);
        return $object;
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        return $this;
    }

    public function getTabContent()
    {
        $tabs = $this->getTab()->getSelectedTab();
        $object = Ccc::getBlock($tabs['block']);
        $object->setEdit($this);
        return $object;
    }
}