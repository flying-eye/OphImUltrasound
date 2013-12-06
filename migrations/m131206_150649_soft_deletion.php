<?php

class m131206_150649_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophimultrasound_report','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_report_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_request','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophimultrasound_request_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophimultrasound_report','deleted');
		$this->dropColumn('et_ophimultrasound_report_version','deleted');
		$this->dropColumn('et_ophimultrasound_request','deleted');
		$this->dropColumn('et_ophimultrasound_request_version','deleted');
	}
}
