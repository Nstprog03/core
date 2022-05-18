<?php 
class Np_Category_Model_Category extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('category/category');
	}


	public function getPath()
    {

		$category_id = $this->category_id;
		$path = $this->path;
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
        	$name;
        $select = $this->getCollection()->getSelect()->where("category_id = ?",$path1);
        $data = $this->getResource()->getReadConnection()->fetchAll($select);
            if($path1 != $category_id){
                $finalPath .= $data[0]['name'] ."=>";
            }else{
                $finalPath .= $data[0]['name'];
            }
        }
        return $finalPath;
    }
    
}