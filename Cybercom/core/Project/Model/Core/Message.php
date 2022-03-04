<?php

class Model_Core_Message
{

	const MESSAGE_SUCCESS = 1;
	const MESSAGE_WARNING = 2;
	const MESSAGE_ERROR = 3;
	const MESSAGE_DEFAULT = 3;
	const MESSAGE_SUCCESS_LBL = 'Success';
	const MESSAGE_WARNING_LBL = 'Warning';
	const MESSAGE_ERROR_LBL = 'Error';

	protected $session = null;

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession();
		}
		return $this->session;
	}

	public function setSession()
	{
		$this->session = Ccc::getModel('Core_Session');
		return $this->session;
	}

	public function getMessages()
	{
		$this->getSession()->start();
		
		return $_SESSION;
	}

	public function unsetSession($key)
	{
		unset($_SESSION['message'][$key]);
	}

	public function addMessage($message,$type = null)
	{
		$messages = [

			self::MESSAGE_SUCCESS => self::MESSAGE_SUCCESS_LBL,
			self::MESSAGE_WARNING => self::MESSAGE_WARNING_LBL,
			self::MESSAGE_ERROR => self::MESSAGE_ERROR_LBL,
			self::MESSAGE_DEFAULT => self::MESSAGE_SUCCESS_LBL
		];

		if(!array_key_exists($type,$messages))
		{
			$type =  self::MESSAGE_DEFAULT;
		}
		$type = $messages[$type];
		$this->getSession()->start();
		return $_SESSION[$type] = $message;
	}

}





 ?>