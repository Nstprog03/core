<?php Ccc::loadClass("Model_Core_Row_Resource"); ?>
<?php

class Model_Category_Media_Resource extends Model_Core_Row_Resource{

    public function __construct()
    {
        $this->setTableName('category_media')->setPrimaryKey('mediaId');
        parent::__construct();
    }
}

?>