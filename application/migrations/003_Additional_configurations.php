<?php
class Migration_Additional_configurations extends CI_Migration {

	public function up()
	{
		$data = array(
			array(
				'type' 			=> 'zentech_user',
				'description' 		=> 'null',
			),
			array(
				'type' 			=> 'zentech_password',
				'description' 		=> 'null',
			),
			array(
				'type' 			=> 'zentech_sender_name',
				'description' 		=> 'null',
			),
			array(
				'type' 			=> 'number_of_semester',
				'description' 		=> '2',
			),
			array(
				'type' 			=> 'semester',
				'description' 		=> '2',
			)
		);

		$this->db->insert_batch( 'settings', $data);
	}

	public function down()
	{
		$this->db->empty_table( 'settings' );
	}
}
