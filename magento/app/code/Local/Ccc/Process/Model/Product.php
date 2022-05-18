<?php   
class Ccc_Process_Model_Product extends Ccc_Process_Model_Process_Abstract
{
   protected $products;
   protected $existingCategories;
   protected function _construct()
   {
      $this->_init('process/product');
   }

   public function getIdentifier($row)
   {
      return $row['sku'];
   }
   public function prepareRow($row)
   {
      return [
         'name' => $row['name'],
         'category_id' => $row['category_id'],
         'price' => $row['price'],
         'costPrice' => $row['costPrice'],
         'quantity' => $row['quantity'],
         'sku' => $row['sku'],
      ];
   }
   public function fetchExistingCategories()
   {
      $this->existingCategories = Mage::getModel('process/category')->getPaths();
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
   public function verify()
   {
      $this->fetchExistingCategories();
      $this->readFile();
      $this->validateData();
      //exit;
      $this->processEntry();
      $this->genrateInvalidDataReport();
      return true;          
   }
   public function fetchProducts()
   {
      $select = $this->getCollection()
      ->getSelect()
      ->reset(Zend_Db_Select::COLUMNS)
      ->columns(['product_id','sku']);
      return $this->getResource()->getReadConnection()->fetchPairs($select);
   }
   public function getProducts()
   {
      if(!$this->products)
      {
         $this->products = $this->fetchProducts();
      }
      return $this->products;
   }

   public function validateRow($row)
   {
      $flag = $this->validateCategory($row);
      if($flag)
      {
         $row = $this->addCategoryId($row);
      }
      return $row;
   }
   public function validateCategory($row)
   {
      if (!in_array($row['category'],$this->getExistingCategories())) 
      {
         throw new Exception("Category not exists.", 1);
      }
      return true;
   }
   public function addCategoryId($row)
   {
      if (in_array($row['category'],$this->getExistingCategories())) 
      {   
         $row['category_id'] = array_search($row['category'],$this->getExistingCategories());
         unset($row['category']);
      }
      else
      {
         throw new Exception("Category Not exists.", 1);
      }
      return $row;
   }
   public function import($entryData)
   {
      $products = $this->getProducts();
      foreach ($entryData as $key => $entry) 
      {
         $product = Mage::getModel('process/product');
         $product->setData(json_decode($entry['data'], true));
         if(in_array($product->sku,$products))
         {
            $product->product_id = array_search($product->sku,$products);
         }
         if(!$product->save())
         {
           throw new Exception("Data was not processed", 1);
         }
      }
  }
}