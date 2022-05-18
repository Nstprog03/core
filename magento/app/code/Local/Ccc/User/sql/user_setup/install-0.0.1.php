<?php

$installer = $this;

$installer->startSetup();

$installer->addEntityType(Ccc_User_Model_Resource_User::ENTITY, [
	'entity_model' => 'user/user',
	'table' => 'user/user',
]);

$installer->createEntityTables($installer->getTable('user/user'));

$installer->endSetup();
