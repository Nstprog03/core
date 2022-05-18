<?php

$installer = $this;

$installer->startSetup();

$installer->addEntityType(Np_Vendor_Model_Resource_Vendor::ENTITY, [
	'entity_model' => 'vendor/vendor',
	'table' => 'vendor/vendor',
]);

$installer->createEntityTables($installer->getTable('vendor/vendor'));

$installer->endSetup();
