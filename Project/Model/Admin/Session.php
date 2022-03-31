<?php Ccc::loadClass('Model_Core_Session');


class Model_Admin_Session extends Model_Core_Session
{
	public function __construct()
	{
		parent::__construct();
		$this->setNamespace('admin');
	}




	
}