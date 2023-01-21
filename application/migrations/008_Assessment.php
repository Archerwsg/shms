<?php
class Migration_Assessment extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field (  array(
			'assessment_id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'longtext',
			),
			'mark_total' => array(
				'type' => 'INT',
				'constraint' => 100,
				'default' => null,
			),
			'semester' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'date' => array(
				'type' => 'longtext',
			),
			'year' => array(
				'type' => 'longtext',
			),
			'comment' => array(
				'type' => 'longtext',
			),
		));
		$this->dbforge->add_key('assessment_id', TRUE);
		$this->dbforge->create_table('assessment');
	}

	public function down()
	{
		$this->dbforge->drop_table('assessment');
	}
}