<?php

class m131205_134501_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophimultrasound_report_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`report` text COLLATE utf8_bin,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophimultrasound_report_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophimultrasound_report_cui_fk` (`created_user_id`),
	KEY `acv_et_ophimultrasound_report_ev_fk` (`event_id`),
	CONSTRAINT `acv_et_ophimultrasound_report_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophimultrasound_report_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophimultrasound_report_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophimultrasound_report_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophimultrasound_report_version');

		$this->createIndex('et_ophimultrasound_report_aid_fk','et_ophimultrasound_report_version','id');
		$this->addForeignKey('et_ophimultrasound_report_aid_fk','et_ophimultrasound_report_version','id','et_ophimultrasound_report','id');

		$this->addColumn('et_ophimultrasound_report_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophimultrasound_report_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophimultrasound_report_version','version_id');
		$this->alterColumn('et_ophimultrasound_report_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophimultrasound_request_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`priority_id` int(10) unsigned NOT NULL DEFAULT '1',
	`indication` text COLLATE utf8_bin,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophimultrasound_request_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophimultrasound_request_cui_fk` (`created_user_id`),
	KEY `acv_et_ophimultrasound_request_ev_fk` (`event_id`),
	KEY `acv_ophimultrasound_request_priority_fk` (`priority_id`),
	CONSTRAINT `acv_et_ophimultrasound_request_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophimultrasound_request_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophimultrasound_request_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_ophimultrasound_request_priority_fk` FOREIGN KEY (`priority_id`) REFERENCES `ophimultrasound_request_priority` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophimultrasound_request_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophimultrasound_request_version');

		$this->createIndex('et_ophimultrasound_request_aid_fk','et_ophimultrasound_request_version','id');
		$this->addForeignKey('et_ophimultrasound_request_aid_fk','et_ophimultrasound_request_version','id','et_ophimultrasound_request','id');

		$this->addColumn('et_ophimultrasound_request_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophimultrasound_request_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophimultrasound_request_version','version_id');
		$this->alterColumn('et_ophimultrasound_request_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophimultrasound_request_priority_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) COLLATE utf8_bin NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophimultrasound_request_priority_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophimultrasound_request_priority_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophimultrasound_request_priority_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophimultrasound_request_priority_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('ophimultrasound_request_priority_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophimultrasound_request_priority_version');

		$this->createIndex('ophimultrasound_request_priority_aid_fk','ophimultrasound_request_priority_version','id');
		$this->addForeignKey('ophimultrasound_request_priority_aid_fk','ophimultrasound_request_priority_version','id','ophimultrasound_request_priority','id');

		$this->addColumn('ophimultrasound_request_priority_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophimultrasound_request_priority_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophimultrasound_request_priority_version','version_id');
		$this->alterColumn('ophimultrasound_request_priority_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophimultrasound_report','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_report_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_request','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_request_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophimultrasound_request_priority','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophimultrasound_request_priority_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophimultrasound_request_priority','deleted');

		$this->dropColumn('et_ophimultrasound_report','deleted');
		$this->dropColumn('et_ophimultrasound_request','deleted');

		$this->dropTable('et_ophimultrasound_report_version');
		$this->dropTable('et_ophimultrasound_request_version');
		$this->dropTable('ophimultrasound_request_priority_version');
	}
}
