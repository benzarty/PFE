<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
   function form_insert($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('note', $data);
}

	public function getRecords($id)
	{
		
		$query = $this->db->query("Select * from note where idstudent= $id");
					return $query->result();

	}
	public function getRecordss($id)
	{
		
				$query = $this->db->query("Select * from note where idstudent= $id");
						return $query->result();


	}
	public function getavergenote($id)
	{
		$query=$this->db->query("SELECT AVG(note) as n  FROM note where idstudent=$id");
								return $query->row();

	}
	public function getnumber($id)
	{
		$query=$this->db->query("SELECT COUNT(note) as n FROM note where idstudent=$id");
								return $query->row();

	}
		public function deletenote($id)
	{
		$query=$this->db->query("DELETE FROM note WHERE id= $id; ");
								return true;

	}
	public function getavergenotetoutclasse($id)
	{
		$query=$this->db->query("SELECT AVG(note) as n FROM note where idteacher=$id");
								return $query->row();

	}


}
