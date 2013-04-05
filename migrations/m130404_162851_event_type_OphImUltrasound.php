<?php 
class m130404_162851_event_type_OphImUltrasound extends CDbMigration
{
	public function up() {

		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphImUltrasound'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Image events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphImUltrasound', 'name' => 'Ultrasound','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphImUltrasound'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Request',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Request','class_name' => 'Element_OphImUltrasound_Request', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Request'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Report',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Report','class_name' => 'Element_OphImUltrasound_Report', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Report'))->queryRow();

		// element lookup table ophimultrasound_request_priority
		$this->createTable('ophimultrasound_request_priority', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophimultrasound_request_priority_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophimultrasound_request_priority_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophimultrasound_request_priority_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophimultrasound_request_priority_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophimultrasound_request_priority',array('name'=>'Routine','display_order'=>1));
		$this->insert('ophimultrasound_request_priority',array('name'=>'Soon','display_order'=>2));
		$this->insert('ophimultrasound_request_priority',array('name'=>'Urgent','display_order'=>3));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophimultrasound_request', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'priority_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // Priority
				'indication' => 'text DEFAULT \'\'', // Indication
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophimultrasound_request_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophimultrasound_request_cui_fk` (`created_user_id`)',
				'KEY `et_ophimultrasound_request_ev_fk` (`event_id`)',
				'KEY `ophimultrasound_request_priority_fk` (`priority_id`)',
				'CONSTRAINT `et_ophimultrasound_request_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophimultrasound_request_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophimultrasound_request_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophimultrasound_request_priority_fk` FOREIGN KEY (`priority_id`) REFERENCES `ophimultrasound_request_priority` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophimultrasound_report', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'report' => 'text DEFAULT \'\'', // Report
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophimultrasound_report_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophimultrasound_report_cui_fk` (`created_user_id`)',
				'KEY `et_ophimultrasound_report_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophimultrasound_report_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophimultrasound_report_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophimultrasound_report_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down() {
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophimultrasound_request');


		$this->dropTable('ophimultrasound_request_priority');

		$this->dropTable('et_ophimultrasound_report');




		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphImUltrasound'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphImUltrasound does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>