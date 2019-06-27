<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getall()
	{            

			$query = $this->db->query("Select * from users");

				return $query->result();

	}   
}
