<?php   
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$attributeCode = 'addtocart_settings';
$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);

 if($attribute->getId() && $attribute->getFrontendInput()=='select') {
    $newOptions =  array('Red','Black', 'Yellow');
    $exitOptions =  array();
    $options = Mage::getModel('eav/entity_attribute_source_table')
                        ->setAttribute($attribute)
                        ->getAllOptions(false);
    foreach ($options as $option) {
        if (in_array($option['label'], $newOptions)) {
            array_push($exitOptions, $option['label']);
        }else {

        }
    }
    $insertOptions = array_diff($newOptions, $exitOptions);
    if(!empty($insertOptions)) {
        $option['attribute_id'] = $attribute->getId();
        $option['values']        =  $insertOptions;  
        $installer->addAttributeOption($option);
    }            
}

$installer->endSetup();