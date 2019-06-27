<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matiere_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}



	public function get_by_id($id)
	{
		$this->db->from('matiere');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function getidmatiers($id)
	{
				$query = $this->db->query("Select idmatiere from teachermatiere where idteacher ='$id'");
						return $query->result();



	}

}
