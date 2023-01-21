<?php
class Migration_Dump_initials_data extends CI_Migration {

		/**
		 * up
		 */
		public function up()
		{
			$CI = &get_instance();
			$CI->load->database();
			$database_name = $CI->db->database;

			// Name of the file
			$filename = dirname(__FILE__) . '../../../uploads/install.sql';
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;

				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					$this->db->query($templine);
					// Reset temp variable to empty
					$templine = '';
				}
			}
		}
		/**
		 * rollback
		 */
		public function down()
		{
			// $this->db->empty_table();
		}
	}
	/* End of file 20150111100537_initial.php */
	/* Location: ./application/migrations/20150111100537_initial.php */