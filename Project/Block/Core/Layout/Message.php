<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Layout_Message extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/message.php');
	}

	public function getMessages()
	{
		$messageModel = Ccc::getModel('Admin_Message');
		$messages = $messageModel->getMessages();
		$messageModel->unsetMessages();
		return $messages;
	}
}