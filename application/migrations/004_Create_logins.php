<?php
class Migration_Create_logins extends CI_Migration {


	public function up()
	{
		$data = array(
		        'name' 					=> 'Emmanuel Kwabena Dadzie',
		        'email' 				=> 'emmanuel@zentechgh.com',
		        'password' 				=> '283f4c262dd9e9a48170cb4da4b0a54e233b8c2d',
		        'phone' 				=> '233209137654'
		);
		$this->db->insert( 'admin', $data);
		$language = array(
			array(
				'phrase' 				=> 'student_subjects',
				'english' 				=> 'Students Mudule',
			),
			array(
				'phrase' 				=> 'change_skin',
				'english' 				=> 'Change Theme',
			)
		);
		$this->db->insert_batch( 'language', $language);
		$fields = array(
			'subjects' => array(
				'type' => 'TEXT',
			)
		);

		$this->dbforge->add_column('enroll', $fields);
		$this->db->update('settings', array('description' => 'Zentech College'), 	array('type' => 'system_name'));
		$this->db->update('settings', array('description' => 'Zentech College'), 	array('type' => 'system_title'));
		$this->db->update('settings', array('description' => 'info@zentechgh.com'),	array('type' => 'system_email'));
		$this->db->update('settings', array('description' => '233209137654'), 		array('type' => 'phone'));
		
	}

	public function down()
	{
		$this->db->empty_table( 'admin' );
		$this->dbforge->drop_column('enroll', 'subjects');
	}
}