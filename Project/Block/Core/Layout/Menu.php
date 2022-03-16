<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout_Menu extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/menu.php');
	}
	public function getLoginName()
	{

		$messageModel = Ccc::getModel('Admin_Message');
		$messages = $messageModel->getSession()->getNamespace();
		if($_SESSION[$messages])
		{
			$email = $_SESSION[$messages]['login']['loginId'];
			$firstName = $this->getAdapter()->fetchOne("SELECT `firstName` FROM `admin` WHERE `email` = '{$email}'");
			$lastName = $this->getAdapter()->fetchOne("SELECT `lastName` FROM `admin` WHERE `email` = '{$email}'");
			return ucfirst($firstName)." ".ucfirst($lastName);
	
		}
		else
		{
			return null;
		}
	}
	function getAdapter()
    {
        global $adapter;
        return $adapter;
    }

}