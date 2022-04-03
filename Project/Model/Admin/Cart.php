<?php 	Ccc::loadClass('Model_Core_Cart');

class Model_Admin_Cart extends Model_Core_Cart
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