<?php
class Migration_Alter_class extends CI_Migration {

	public function up()
	{
		$fields = array(
			'class_divisions_id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
		);
		$this->dbforge->add_column('class', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('class', 'class_divisions_id');
	}
}
