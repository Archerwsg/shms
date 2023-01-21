<?php
class Migration_Alter_semester extends CI_Migration {

	public function up()
	{
		$fields = array(
			'semester' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
		);
		$this->dbforge->add_column('exam', $fields);
		$this->dbforge->add_column('mark', $fields);
	}

	public function down()
	{
		$this->dbforge->drop_column('exam', 'semester');
		$this->dbforge->drop_column('mark', 'semester');
	}
}
