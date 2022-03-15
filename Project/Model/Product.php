<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	
	protected $media;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
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

	public function getBase()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->base)
		{
			return null;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->base}");
		if(!$base)
		{
			return $mediaModel;
		}

		return $base;
	}
	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->small)
		{
			return null;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->small}");
		if(!$small)
		{
			return $mediaModel;
		}

		return $small;
	}
	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		$thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
		if(!$thumb)
		{
			return $mediaModel;
		}

		return $thumb;
	}
	
	

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->media)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->media;
	}
	public function setMedia(Model_Product_Media $media)
	{
		$this->media =$media;
		return $this;
	}

	public function saveCategories(array $categoryIds)
	{
		
		
		$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$this->productId' ");
		
		foreach($categoryProduct as $category)
		{
			if(!in_array($category->category_id, $categoryIds['exists'])){
				$categoryProductModel->load($category->entity_id)->delete();
			}
		}
		foreach($categoryIds['new'] as $categoryId)
		{
			$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
			$categoryProductModel->product_id = $this->productId;
			$categoryProductModel->category_id = $categoryId;
			$categoryProductModel->save();
		}
	}

}
?>