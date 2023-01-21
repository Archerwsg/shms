<?php
class MY_Controller extends CI_Controller {

	
	function __construct() {
		parent::__construct();
		$this->load->library('migration');
		$this->load->database();
		$this->load->dbutil();
		$this->Migration();

	}
	
	public function Migration()
	{
		$database_name = $this->db->database;
		if(!$this->dbutil->database_exists($database_name)){
			$this->dbforge->create_database($database_name);
		}

		if ($this->migration->current() === FALSE)
		{
			show_error($this->migration->error_string());
		}
	}

}


