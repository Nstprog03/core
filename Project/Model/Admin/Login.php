<?php 	Ccc::loadClass('Model_Core_Login');

class Model_Admin_Login extends Model_Core_Login
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession(Ccc::getModel('Admin_Session'));
		}
		return $this->session;
	}
}
?>