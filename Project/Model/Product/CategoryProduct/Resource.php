<?php Ccc::loadClass("Model_Core_Row_Resource"); ?>
<?php

class Model_Product_CategoryProduct_Resource extends Model_Core_Row_Resource{

    public function __construct()
    {
        $this->setTableName('category_product')->setPrimaryKey('entity_id');
        parent::__construct();
    }
}

?>