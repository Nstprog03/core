<?php 


class Model_Core_Session
{
	public function start()
	{
		session_start();
	}

	public function getId()
	{
		return session_id();
	}

	public function regenerateId()
	{
		return session_regenerate_id();
	}

	public function destroy()
	{
		session_destroy();
	}

	public function __set($type, $Message)
	{
		$this->start();
		$_SESSION[$type] = $Message;
		return $this;
	}

	public function __get($type)
	{
		if(!array_key_exists($type,$_SESSION)) 
		{
			return null;
		}
		return $_SESSION[$type];	
	}

	public function __unset($type)
	{
		if(array_key_exists($type,$_SESSION))
		{
			unset($_SESSION[$type]);
		}
		return $this;
	}

}