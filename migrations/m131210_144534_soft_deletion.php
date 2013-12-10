<?php

class m131210_144534_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophimultrasound_request_priority','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophimultrasound_request_priority_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophimultrasound_request_priority','deleted');
		$this->dropColumn('ophimultrasound_request_priority_version','deleted');
	}
}
