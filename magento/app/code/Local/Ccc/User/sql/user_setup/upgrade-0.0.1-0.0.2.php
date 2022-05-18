<?php

$installer = $this;

$installer->startSetup();

$defaultSetId = Mage::getModel('eav/entity_setup', 'core_setup')
	->getAttributeSetId('user', 'Default');
$installer->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = '{$defaultSetId}' WHERE `entity_type_code` = 'user'");

$installer->endSetup();
