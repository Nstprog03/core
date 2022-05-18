<?php   
class Ccc_Process_Model_Category extends Ccc_Process_Model_Process_Abstract
{
	protected $categories = [];
	protected $identifiers = [];
	protected $existingCategories = [];

	protected function _construct()
	{
		$this->_init('process/category');
	}	
	public function verify()
	{
		echo "<pre>";
		$this->fetchExistingCategories(); 
		$this->readFile();
		$this->validateData();
		  //exit;
		$this->processEntry();
		  // print_r($this->getFiledDatas());
		  // foreach ($this->getFiledDatas() as $key => $value) {
		  //    // code...
		  // print_r(json_decode($value['data'], true));
		  // }
		  // print_r($this->getExistingCategories());
		  // exit;
		$this->genrateInvalidDataReport();
		return true;          
	}
	public function setFiledDatas($filedData)
    {
        $this->filedData = $filedData;
        return $this;
    }
	public function fetchExistingCategories()
	{
		$this->existingCategories = array_flip($this->getPaths());
		$this->existingCategories['root'] = null;
		  //return $this;
	}

	public function getExistingCategories()
	{
		if($this->existingCategories)
		{
			return $this->existingCategories;
		}
		return null;
	}
	public function addExistingCategories($key,$value)
	{
		$this->existingCategories[$key]=$value;
		return $this;
	}

	public function getIdentifier($row)
	{
		return $row['name'];
	}

	public function prepareRow($row)
	{
		return [
			'name' => $row['name'],
			'description' => $row['description'],
			'link' => $row['link'],
			'path' => $row['path'],
			'parent' => $row['parent'],
			'status' => $row['status'],
			'exception' => $row['exception'],
		];
	}

	public function validateRow($row)
	{
		$row['path'] = $row['name'];
		$row = $this->getName($row);
		$row = $this->getParent($row);
		$row = $this->validateParent($row);
		$this->validateName($row);
		$this->addExistingCategories($row['path'],0);
		$this->checkDuplicateEntry($row);
		$this->validateDuplicateCategory($row);
		return $row;
	}
	public function getName($row)
	{
		$array = explode('/',$row['path']);
		$row['name'] = array_pop($array);
		return $row;
	}
	public function getParent($row)
	{
		$array = explode('/',$row['path']);
		$temp = array_pop($array);
		$row['parent'] = implode('/',$array);
		if($row['parent'] == null)
		{
			$row['parent'] = 'root';
		}
		return $row;
	}
	public function validateParent($row)
	{
		$parent = $row['parent'];
		if (!array_key_exists($parent,$this->getExistingCategories())) 
		{
			$row['exception'] = "Parent Category does not exists.";
		}
		return $row;
	}

	public function validateName($row)
	{
		if (array_key_exists($row['path'],$this->getExistingCategories())) 
		{
			throw new Exception("Category already exists.", 1);
		}
		return true;
	}
	
	public function checkDuplicateEntry($row)
	{
		
	}

	public function validateDuplicateCategory($row)
	{

		if(!$this->categories){
			$category = Mage::getModel('category/category');
			$select = $category->getCollection()
			->getSelect()
			->reset(Zend_Db_Select::COLUMNS)
			->columns(['name','category_id']);

			$categories = $category->getResource()->getReadConnection()->fetchPairs($select);
			$this->categories = $categories;
		}
		if(array_key_exists($row['name'],$this->categories)){
			throw new Exception("Category already exists.", 1);
		}
		return true;
	}
	public function getPaths()
	{

		$selectQuery = $this->getCollection()->getSelect();
		$categories = $this->getResource()->getReadConnection()->fetchAll($selectQuery);
		
		$finalCategories = [];
		foreach ($categories as $key => $category) 
		{
			$category_id = $category['category_id'];
			$path = $category['path'];
			$finalPath = NULL;
			$path = explode("/",$path);
			foreach ($path as $path1) {
				
				$select = $this->getCollection()->getSelect()->where("category_id = ?",$path1);
				$data = $this->getResource()->getReadConnection()->fetchAll($select);
				if($path1 != $category_id){
					$finalPath .= $data[0]['name'] ."/";
				}else{
					$finalPath .= $data[0]['name'];
				}
			}
			$finalCategories[$category_id] = $finalPath;
		}
		return $finalCategories;
	}

	public function import($entryData)
	{

		if (!$this->getExistingCategories()) 
		{
			$this->fetchExistingCategories();
		}
		  //array_multisort($entryData);
		$category = Mage::getModel('process/category');
		foreach ($entryData as $key => $entry) 
		{
			$category->setData(json_decode($entry['data'], true));
			unset($category->exception);
			$category->parent_id = $this->existingCategories[$category->parent];
			$category->status = ($category->status == 'yes') ? 1 : 0;
			unset($category->parent);
			$categoriesPath= $category->path;
			unset($category->path);
			$category->created_at = date('Y-m-d H:i:s');
			$category->save();
			if(!$category->save()){
				throw new Exception("Data was not processed", 1);
			}


			$categoryId = $category->getId();
			$this->existingCategories[$categoriesPath] = $categoryId;
			$parent = Mage::getModel('process/category')->load($category->parent_id);
			if($category->parent_id == null)
			{
				$path = $categoryId;
			}
			else
			{
				$path = $parent->path.'/'.$categoryId;
			}
			$category = Mage::getModel('category/category')->load($categoryId);
			$category->path = $path;
			$category->save();
			if(!$category->save()){
				throw new Exception("Data was not processed", 1);
			}
		}
		Mage::log($this->existingCategories,null,'se.log',true);
		
	}


}