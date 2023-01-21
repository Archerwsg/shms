<?php
class Migration_Create_database extends CI_Migration {

		/**
		 * up
		 */
		public function up()
		{
			$CI = &get_instance();
			$CI->load->database();
			$CI->load->dbutil();
			$database_name = $CI->db->database;
			if(!$CI->dbutil->database_exists($database_name)){
				$CI->dbforge->create_database($database_name);
			}

			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'VARCHAR',
					'constraint' => 128,
				),
				'ip_address' => array(
					'type' => 'VARCHAR',
					'constraint' => 45,
				),
				'timestamp' => array(
					'type' => 'INT',
					'constraint' => '128',
					'unsigned' => TRUE,
					'default' => '0',
				),
				'data' => array(
					'type' => 'TEXT',
				)
			));
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_key('ip_address', TRUE);
			
			$this->dbforge->create_table('ci_sessions');
		}
		/**
		 * rollback
		 */
		public function down()
		{
			$CI = &get_instance();
			$CI->load->database();
			$database_name = $CI->db->database;
			$this->dbforge->drop_table('ci_sessions' );
			// $CI->dbforge->drop_database($database_name);
		}
	}
	/* End of file 20150111100537_initial.php */
	/* Location: ./application/migrations/20150111100537_initial.php */