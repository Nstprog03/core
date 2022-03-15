<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{

	protected $media;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Category_Resource');
		parent::__construct();
	}

	public function getBase()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->base)
		{
			return null;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `mediaId` = {$this->base}");
		if(!$base)
		{
			return $mediaModel;
		}

		return $base;
	}
	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->small)
		{
			return null;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `mediaId` = {$this->small}");
		if(!$small)
		{
			return $mediaModel;
		}

		return $small;
	}
	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		$thumb = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `mediaId` = {$this->thumb}");
		if(!$thumb)
		{
			return $mediaModel;
		}

		return $thumb;
	}
	

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->media)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `categoryId` = {$this->categoryId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->media;
	}
	public function setMedia($media)
	{
		$this->media =$media;
		return $this;
	}



	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses)) {
			return $statuses[$key];
		}
		return self::STATUS_DEFAULT;
	}
}

?>