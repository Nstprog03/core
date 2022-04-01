<?php 
Ccc::loadClass('Block_Core_Template');

class Block_Core_Edit_Tabs_Content extends Block_Core_Template{

    protected $edit = null;

	public function __construct()
	{
		parent::__construct();
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


}

?>