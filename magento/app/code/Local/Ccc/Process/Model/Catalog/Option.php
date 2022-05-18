<?php 
class Ccc_Process_Model_Catalog_Option extends Ccc_Process_Model_Process_Abstract
{
	public function getIdentifier($row)
	{
		return $row['attribute_code'];
	}
	
	public function prepareRow($row)	
	{
		return[
			'attribute_code' => $row['attribute_code'],
			'option_order' => $row['option_order'],
			'option' => $row['option'],
		];
	}

	public function validateRow(&$row)
	{
		return $row;
	}
	
	public function import($entryData)	
	{

		$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
		$installer->startSetup();
		foreach ($entryData as $key => $entry) 
		{
			$OptionData = json_decode($entry['data'], true);
			$attributeCode = $optionData['attribute_code'];
			$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);

			 if($attribute->getId() && $attribute->getFrontendInput()=='select') 
			 {
			    $newOptions =  array($optionData['option_order']=>$optionData['order']);
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
		}
		$installer->endSetup();
		return true;
	}
}