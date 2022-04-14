<?php
    $installer = $this;
    $installer->startSetup();
    $installer->run("
    -- DROP TABLE IF EXISTS {$this->getTable('np')};
    CREATE TABLE {$this->getTable('np')} (
      `std_id` int(11) unsigned NOT NULL auto_increment,
      `stdname` varchar(255) NOT NULL default '',
      `email` varchar(255) NOT NULL default '',
      `rollno` int(11) NOT NULL default '0',
      `gender` varchar(255) NOT NULL default '',
      `filename` varchar(255) NOT NULL default '',
      `status` varchar(255) NOT NULL default '',
      PRIMARY KEY (`std_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    $installer->endSetup();