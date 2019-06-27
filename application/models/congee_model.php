<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class congee_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getRecords()
	{
	 	$query = $this->db->query("Select * from congee where etat = 'padding'");
		return $query->result();



	}
	public function getRecordsenconge()
	{
		$query = $this->db->query("Select * from congee where etat = 'accepted'");
		return $query->result();



	}
	public function getRecordsdone()
	{
		$query = $this->db->query("Select * from congee where etat = 'refused'");
		return $query->result();



	}


	function form_insert($data){
// Inserting in Table(students) of Database(college)
		$this->db->insert('congee', $data);
	}

	function deleteuser($id){
		$this->db->set('etat', 'refused');
		$this->db->where('id', $id);
		$this->db->update('congee');
		return true ;

	}

	public function acceptuser($id)
	{


		$this->db->set('etat', 'accepted');
		$this->db->where('id', $id);
		$this->db->update('congee');
		return true ;


	}
	public function viewcongeeteacher($id)
	{
		$query = $this->db->query("Select * from congee where idteacher = $id");
		return $query->result();

	}
	public function countconge($id)
	{

		$query = $this->db->query("Select count(*) as n from congee where etat='accepted' and idteacher='$id'");
								return $query->row();
	}


}
