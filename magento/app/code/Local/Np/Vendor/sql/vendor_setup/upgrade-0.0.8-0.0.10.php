<?php  
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute('catalog_product', 'sm_manufacturer', array(          
            'group'                 => 'General',
            'label'                 => 'SM_Menufacturer',
            'input'                 => 'select',
            'type'                  => 'varchar',
            'required'              => 0,
            'visible_on_front'      => false,
            'filterable'            => 0,
            'filterable_in_search' => 0,
            'searchable'            => 0,
            'used_in_product_listing' => true,
            'visible_in_advanced_search' => false,
            'comparable'      => 0,
            'user_defined'    => 1,
            'is_configurable' => 0,
            'global'          => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            // 'option'          => array('values' => array('Default', 'Available at authorized dealer','Not available yet')),
            // 'note'            => ''
));

$installer->endSetup(); 

?>