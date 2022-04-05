<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout_Menu extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/menu.php');
	}
	public function getLoginName()
	{

		$loginModel = Ccc::getModel('Admin_Login');
		if($loginModel->getLogin())
		{
			$email = $loginModel->getLoginId();
			$firstName = $this->getAdapter()->fetchOne("SELECT `firstName` FROM `admin` WHERE `email` = '{$email}'");
			return ucfirst($firstName);			
		}
		else
		{
			return 'Login';
		}
	}
	public function getLoginLastName()
	{

		$loginModel = Ccc::getModel('Admin_Login');
		if($loginModel->getLogin())
		{
			$email = $loginModel->getLoginId();
			$lastName = $this->getAdapter()->fetchOne("SELECT `lastName` FROM `admin` WHERE `email` = '{$email}'");
			return ucfirst($lastName);			
		}
		else
		{
			return 'Please';
		}
	}
	function getAdapter()
    {
        global $adapter;
        return $adapter;
    }

}