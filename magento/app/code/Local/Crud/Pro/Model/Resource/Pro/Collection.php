<?php
class Crud_Pro_Model_Resource_Pro_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{   
    protected function _construct()
    {      
        $this->_init('pro/pro');
    }

}