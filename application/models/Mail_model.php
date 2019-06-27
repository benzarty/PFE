<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getRecords()
	{
		$query=$this->db->get('mail');
		if ($query->num_rows()> 0)
		{
			return $query->result();
		}
	}
	 
    function form_insert($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('mail', $data);

}

	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mail');
	}
	public function geteachRecords($id)
	{

		$query = $this->db->query("Select * from mail where idadmin ='$id'");
		return $query->result();

	}
	public function geteachRecordsteacher($id)
	{
		$query = $this->db->query("Select * from mail where idteacher ='$id'");
		return $query->result();


	}
	public function geteachRecordsparent($id)
	{
		$query = $this->db->query("Select * from mail where idparent ='$id'");
		return $query->result();


	}
	public function getdetail($id)
	{
		$query = $this->db->query("Select * from mail where id = $id");
		return $query->result();
	}
public function getEvent($username)
{
	$query = $this->db->query("Select * from mail where destinataire= '$username'");
	return $query->result();

}
   
}
