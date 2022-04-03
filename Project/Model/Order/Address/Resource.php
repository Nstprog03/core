<?php Ccc::loadClass('Model_Core_Row_Resource');

class Model_Order_Address_Resource extends Model_Core_Row_Resource
{
    public function __construct()
    {
        $this->setTableName('order_address')->setPrimaryKey('addressId');
        parent::__construct();
    }
}
