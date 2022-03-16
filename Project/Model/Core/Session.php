<?php 


class Model_Core_Session
{
	protected $namespace = null;

	public function __construct()
	{
		if(!$this->isStarted())
		{
			$this->setNamespace('core');
			session_start();
		}
	}
	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}
	public function getNamespace()
	{
		return $this->namespace;
	}
	public function start()
	{
		if(!$this->isStarted())
		{
			session_start();
		}
		return $this;
	}

	public function isStarted()
	{
		if($this->getId())
		{
			return true;
		}
		return false;
	}

	public function getId()
	{
		return session_id();
	}

	public function regenerateId()
	{
		if(!$this->isStarted())
		{
			session_start();
		}
		return session_regenerate_id();
	}

	public function destroy()
	{
		if(!$this->isStarted())
		{
			session_start();
		}
		session_destroy();
	}

	public function __set($messages, $message)
	{
		if(!$this->isStarted())
		{
			$this->start();
		}
		$_SESSION[$this->getNamespace()][$messages] = $message;
		return $this;
	}

	public function __get($messages)
	{
		
		if(!$this->isStarted())
		{
			$this->start();
		}
		if(!array_key_exists($this->getNamespace(),$_SESSION))
		{
			$_SESSION[$this->getNamespace()] = [];
		}
		if(!array_key_exists($messages,$_SESSION[$this->getNamespace()])) 
		{
			return null;
		}
		return $_SESSION[$this->getNamespace()][$messages];	
	}

	public function __unset($messages)
	{
		if(!$this->isStarted())
		{
			$this->start();
		}
		if(array_key_exists($messages,$_SESSION[$this->getNamespace()]))
		{
			unset($_SESSION[$this->getNamespace()][$messages]);
		}
		
		return $this;
	}

}