<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convocation_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	 
    function form_insert($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('convocation', $data);

}
   function getpending(){
// Inserting in Table(students) of Database(college)
$query = $this->db->query("Select * from convocation where status='pending'");
		return $query->result();
}


public function acceptuser($id)
	{

        $this->db->set('status', 'accepted');
		$this->db->where('id', $id);
		$this->db->update('convocation');
		return true ;


	}
	function deleteconvocation($idd){
		$this->db->set('status', 'refused');
		$this->db->where('id', $idd);
		$this->db->update('convocation');
		return true ;
		
	}
	function getrelatedconvocation($id)
	{
		$query = $this->db->query("select * from convocation where idstudent  IN (select id from student where idparent ='$id') and status='accepted' order by datedepostulation DESC");
				return $query->result();


	}
	public function countconvocation($id)
	{
		

		$query = $this->db->query("Select count(*) as n from convocation where idteacher ='$id'");
								return $query->row();
	}
}