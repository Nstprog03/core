<?php
class Ccc_Np_Model_Resource_Np extends Mage_Core_Model_Resource_Db_Abstract
{   
    protected function _construct()
    {      
        $this->_init('np/np','std_id');
    }
}