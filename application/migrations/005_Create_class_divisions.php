<?php
class Migration_Create_class_divisions extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field (  array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'name_numeric' => array(
				'type'           => 'INT',
				'constraint'     => '8',
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'class_assessment_mark' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'class_exam_mark' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'Subject_specification' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'default' => 'Null',
			),
			'created' => array(
				'type' => 'DATETIME',
			),
			'modified' => array(
				'type' => 'DATETIME',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('class_divisions');
	}

	public function down()
	{
		$this->dbforge->drop_table('class_divisions');
	}
}
