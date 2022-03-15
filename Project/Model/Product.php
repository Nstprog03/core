<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	protected $baseId;
	protected $thumbId;
	protected $smallId;
	protected $mediaData;
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

	public function getBase($reload = false)
	{
		$MediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->base)
		{
			return null;
		}
		if($this->baseId && !$reload)
		{
			return $this->baseId;
		}
		$base = $MediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->base}");
		$baseId = $base->name;
		if(!$baseId)
		{
			return null;
		}
		$this->setBase($baseId);

		return $this->baseId;
	}
	public function setBase($baseId)
	{
		$this->baseId =$baseId;
		return $this;
	}
	public function getSmall($reload = false)
	{
		$MediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->small)
		{
			return null;
		}
		if($this->smallId && !$reload)
		{
			return $this->smallId;
		}
		$small = $MediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->small}");
		$smallId = $small->name;
		if(!$smallId)
		{
			return null;
		}
		$this->setSmall($smallId);

		return $this->smallId;
	}
	public function setSmall($smallId)
	{
		$this->smallId =$smallId;
		return $this;
	}


	public function getThumb($reload = false)
	{
		$MediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		if($this->thumbId && !$reload)
		{
			return $this->thumbId;
		}
		$thumb = $MediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
		$thumbId = $thumb->name;
		if(!$thumbId)
		{
			return null;
		}
		$this->setThumb($thumbId);

		return $this->thumbId;
	}
	public function setThumb($thumbId)
	{
		$this->thumbId =$thumbId;
		return $this;
	}

	public function getMedia($reload = false)
	{
		$MediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->mediaData)
		{
			return null;
		}
		if($this->mediaData && !$reload)
		{
			return $this->mediaData;
		}
		$media = $MediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->mediaData;
	}
	public function setMedia($mediaData)
	{
		$this->mediaData =$mediaData;
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