<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Maroua
 * Date: 25/03/2019
 * Time: 9:21 AM
 */

class Announcement_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getRecords()
	{
		$query=$this->db->get('annonce');
		if ($query->num_rows()> 0)
		{
			return $query->result();
		}
	}
	function form_insert($data){
// Inserting in Table(students) of Database(college)
		$this->db->insert('annonce', $data);
	}
	function delete_annonce($id){
		 $this->load->database();
		 $this->db->where('id',$id);
		 $this->db->delete('annonce');
		 return true;
	}
	function getEvent()
	{
		$query = $this->db->query("Select * from annonce where typeee = 'public' or typeee= 'teacher' ORDER BY date DESC");
		return $query->result();
	}

	function getEventParent()
	{
		$query = $this->db->query("Select * from annonce where typeee = 'public' or typeee= 'parent'");
		return $query->result();
	}
	function getEventPublic()
	{
		$query = $this->db->query("Select * from annonce where typeee = 'public' or typeee='parent' or typeee='teacher'");
		return $query->result();
	}
}
