<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Edit_Tab extends Block_Core_Template   
{
    protected $tabs = [];
    protected $edit = null;
    protected $currentTab = null;

    public function __construct()
    {
        $this->setTemplate('view/core/edit/tab.php');
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        return $this;
    }

    public function getSelectedTab()
    {
        $tabKey = Ccc::getModel('Core_Request')->getRequest('tab');
        $tab = $this->getTab($tabKey);
        if(!$tab)
        {
            return $this->getTab($this->currentTab);
        }
        $this->setCurrentTab($tab);
        return $tab;
    }

    public function setEdit($edit)
    {
        $this->edit = $edit;
        return $this;
    }

    public function getEdit()
    {
        return $this->edit;
    }

    public function setCurrentTab($currentTab = null)
    {
        $tabKey = Ccc::getModel('Core_Request')->getRequest('tab');
        $tab = $this->getTab($tabKey);
        if(!$tab)
        {
            $this->currentTab = $currentTab;
        }
        else
        {
            $this->currentTab = $tabKey;
        }
        return $this;
    }

    public function getCurrentTab()
    {
        return $this->currentTab;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($tab, $key)
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function getTab($key)
    {
        if(array_key_exists($key,$this->tabs))
        {
            return $this->tabs[$key];
        }
        return null;

    }
    public function removeTab($tab)
    {
        if(array_key_exists($key,$this->tabs))
        {
            unset($this->tabs[$key]);
        }
        return $this;
    }
}