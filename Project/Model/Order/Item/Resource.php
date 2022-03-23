<?php Ccc::loadClass('Model_Core_Row_Resource');

class Model_Order_Item_Resource extends Model_Core_Row_Resource
{
    public function __construct()
    {
        $this->setTableName('order_item')->setPrimaryKey('itemId');
        parent::__construct();
    }
}
