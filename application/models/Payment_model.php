<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Payment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getRecords()
	{
		$query=$this->db->get('payment');
		if ($query->num_rows()> 0)
		{
			return $query->result();
		}
	}

}
