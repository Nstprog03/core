<?php Ccc::loadClass('Model_Core_Row');

class Model_Category_Media extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		parent::__construct();
	}

}

?>