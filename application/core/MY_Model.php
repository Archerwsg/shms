<?php
class MY_Model extends CI_Model {
	
	protected $db = null;
	protected $_table_name = '';
	protected $_wyf_connection = false;
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
		$this->db();
	}
	
	public function db (){
		if (!$this->_wyf_connection)
			//load db
			$this->db = $this->load->database('default', TRUE);
		else
			//load default
			$this->db = $this->load->database('wyf_connect', TRUE);
	}
	
	public function query ($query_table){
		return $this->db->query($query_table);
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}	

	public function dynamic_array_from_post(){
		$data = array();
		$images = array("picture" , "cover_picture" , "logo" , "photo" , "company_logo");

		foreach ($this->input->post() as $key => $field) 
		{
			if(!in_array($key, $images))
			{
				$data[$key] = $field;
			}
		}
		return $data;
	}

	public function get_fields(){
		return $this->db->list_fields($this->_table_name);
	}

	public function get_new(){
		$new_stuff = new stdClass();
		foreach ($this->db->list_fields($this->_table_name) as $xmil) {
			if ($xmil == "pubdate") {
				$new_stuff->$xmil = date('Y-m-d');
			} else {
				$new_stuff->$xmil = '';
			}
		}
		return $new_stuff;
	}



	public function get_active(){
		$this->db->where('status', 'Active');
		return $this->get();
	}


	
	public function get($id = NULL, $single = FALSE , $table = null , $count = FALSE , $primary_key=null){
		
		if ($primary_key) {
			$this->_primary_key = $primary_key;
		}
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		else if($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if ($this->_order_by) {
			$this->db->order_by($this->_order_by);
		}

		if ($table == NULL) 
		{
			if ($count == TRUE) {
				return $this->db->count_all_results($this->_table_name);
			}
			else
			{
				return $this->db->get($this->_table_name)->$method();
			}
			
		}
		else
		{
			if ($count == TRUE) {
				return $this->db->count_all_results($table);
			}
			else
			{
				return $this->db->get($table)->$method();
			}
			
		}
		
	}
	
	public function get_by($where, $single = FALSE, $table = null){
		$this->db->where($where);
		return $this->get(NULL, $single ,$table);
	}

	public function count($where, $single = FALSE, $table = null){
		$this->db->where($where);
		return $this->get(NULL, $single ,$table , true);
	}
	
	public function save($data, $id = NULL){
		
		// Set timestamps
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;

		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
			$action = 'created';
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
			$action = 'Modified';
		}
		
		return $id;
	}
	
	public function save_by($data, $perimeters = array() ){
		
		// Set timestamps
		$now = date('Y-m-d H:i:s');
		$id || $data['created'] = $now;
		$data['modified'] = $now;

	
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		$this->db->set($data);
		foreach($perimeters as $key => $value ){
			$this->db->where($key , $value);
		}
		
		$this->db->update($this->_table_name);
		$action = 'Modified';
		
		return $id;
	}

	public function rat($data){		
		// Insert rat
		if (!empty($data)) {
			$this->db->set($data);
			$this->db->insert('logs');
			$id = $this->db->insert_id();
		}
	}

	public function Send(){		
			$this->load->library('email');


			$email = $this->input->post('email');
			$phone_number = $this->input->post('phone_number');
			$Subject = $this->input->post('Subject');
			$message = $this->input->post('message');
			$name = $this->input->post('name').''.$phone_number;
			
			$usermail = $this->db->get('settings')->row()->e_mail;
			// Send rat
			$this->email->from($email, $name);
			$this->email->to($usermail);

			$this->email->subject($Subject);
			$this->email->message($message);

			return $this->email->send();
	}

	public function email_password($Details = null , $Password = null){		
			$this->load->library('email');


			$email = "info@lustergh.com";
			$Subject = "Account Password";
			$message = "Name :: ".$Details['name']."\r\n";
			$message .= "Password :: ".$Password."\r\n";
			$message .= " Thank You\r\n";
			$name = $this->input->post('name');
			
			
			// Send rat
			$this->email->from($email, $name);
			$this->email->to($Details['name']);

			$this->email->subject($Subject);
			$this->email->message($message);

			return $this->email->send();
	}




	public function list_fields(){		
		return $this->db->list_fields($this->_table_name);
	}
	

	
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);


	}
}