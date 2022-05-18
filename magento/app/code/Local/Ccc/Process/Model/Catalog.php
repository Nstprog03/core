<?php 
class Ccc_Process_Model_Catalog extends Ccc_Process_Model_Process_Abstract
{
	//protected $type = ['int','decimal','varchar','text'];
	public function getIdentifier($row)
	{
		return $row['name'];
	}
	
	public function prepareRow($row)	
	{
		return[
			'name' => $row['name'],
			'group' => $row['group'],
			'attribute_set' => $row['attribute_set'],
			'type' => $row['type'],
			'input' => $row['input'],
			'lable' => $row['lable'],
			'source' => $row['source'],
			'required' => $row['required']
		];
	}

	public function validateRow(&$row)
	{
		// print_r($row);
		// exit;
		//$this->validateType($row);
		return $row;
	}
	// public function validateType($row)
	// {
	// 	if (in_array($row['type'],$this->type)) 
	// 	{
	// 		throw new Exception("Invalid Type", 1);
	// 	}
	// 	return true;
	// }

	public function import($entryData)	
	{
		$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
		$installer->startSetup();

		foreach ($entryData as $key => $entry) 
		{
			$attributeData = json_decode($entry['data'], true);
			$array = [
					'group' => $attributeData['group'],
					'attribute_set' => $attributeData['attribute_set'],
					'type' => $attributeData['type'],
					'label'=> $attributeData['label'],
					'input' => $attributeData['input'],
					'source' => $attributeData['source'],
					'required' => $attributeData['required'],
				];
				Mage::log($attributeData,null,'Nishith.log',True);
			$installer->addAttribute('catalog_product', $attributeData['name'],$array);
		}
		$installer->endSetup();
		return true;
	}
}