		<?php 


		class Model_Core_Session
		{
			public function __construct()
			{
				if(!$this->isStarted())
				{
					session_start();
				}
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

			public function __set($messages, $Message)
			{
				if(!$this->isStarted())
				{
					$this->start();
				}
				$_SESSION[$messages] = $Message;
				return $this;
			}

			public function __get($messages)
			{
				if(!$this->isStarted())
				{
					$this->start();
				}
				if(!array_key_exists($messages,$_SESSION)) 
				{
					return null;
				}
				return $_SESSION[$messages];	
			}

			public function __unset($messages)
			{
				if(!$this->isStarted())
				{
					$this->start();
				}
				if(array_key_exists($messages,$_SESSION))
				{
					unset($_SESSION[$messages]);
				}
				return $this;
			}

		}