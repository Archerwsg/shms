<?php
class Migration_Assessment_marks extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field (  array(
			'mark_id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'auto_increment' => TRUE
			),
			'student_id' => array(
				'type'           => 'INT',
				'constraint'     => 100,
			),
			'subject_id' => array(
				'type' => 'INT',
				'constraint' => 100,
			),
			'class_id' => array(
				'type' => 'INT',
				'constraint' => 100,
			),
			'section_id' => array(
				'type' => 'INT',
				'constraint' => 100,
			),
			'assessment_id' => array(
				'type' => 'INT',
				'constraint' => 100,
			),
			'mark_obtained' => array(
				'type' => 'INT',
				'constraint' => 100,
			),
			'mark_total' => array(
				'type' => 'INT',
				'constraint' => 100,
				'default' => null,
			),
			'assessment_id' => array(
				'type' => 'INT',
				'constraint' => 100,
				'default' => null,
			),
			'semester' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'year' => array(
				'type' => 'longtext',
			),
			'comment' => array(
				'type' => 'longtext',
			),
		));
		$this->dbforge->add_key('mark_id', TRUE);
		$this->dbforge->create_table('assessment_marks');
	}

	public function down()
	{
		$this->dbforge->drop_table('assessment_marks');
	}
}