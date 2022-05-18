<?php 
class Ccc_Process_Model_Option extends Ccc_Process_Model_Process_Abstract
{
	//protected $type = ['int','decimal','varchar','text'];
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
		$this->validateAttributeCode($row);
		$this->validateAttributeType($row);
		$this->validateAttributeOptions($row);
		return $row;
	}

	public function validateAttributeCode($row)
	{
		$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
		$attributeCode = $row['attribute_code'];
		$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);
		if(!$attribute->getId()) 
		{
			throw new Exception("Atrribute code not found", 1);
		}
		return true;

	}
	public function validateAttributeType($row)
	{
		$attributeCode = $row['attribute_code'];
		$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);
		if($attribute->getFrontendInput()!='select') 
		{
			throw new Exception("Atrribute input type wrong", 1);
		}
		return true;
	}
	public function validateAttributeOptions($row)
	{
		$attributeCode = $row['attribute_code'];
		$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);
		$attributeId = $attribute->getId();
		$optionTable        = Mage::getModel('eav/entity_attribute_option')->getCollection()->getSelect()->join('eav_attribute_option_value','main_table.option_id = eav_attribute_option_value.option_id','eav_attribute_option_value.value')->where('attribute_id = ?',$attributeId);
        $options = Mage::getModel('eav/entity_attribute_option')->getResource()->getReadConnection()->fetchAll($optionTable);
        foreach ($options as $option) 
        {
	        if(in_array($row['option'],$option))
	        {
	        	throw new Exception("Option Alredy Exists", 1);
	        }
        }
        return true;
	}

	public function import($entryData)	
	{

		$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
		$installer->startSetup();
		foreach ($entryData as $key => $entry) 
		{
			$optionData = json_decode($entry['data'], true);
			$attributeCode = $optionData['attribute_code'];
			$attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);

			 if($attribute->getId() && $attribute->getFrontendInput()=='select') {
			    $newOptions = array('attribute_id' => $attribute->getId(),'values' => array($optionData['option_order']=>$optionData['option']));       
			    $installer->addAttributeOption($newOptions);
			}
		}
		return true;
	}
}