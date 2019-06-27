<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Presence_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function Addpresence($id,$datee)
	{
		$d=date("Y-m-d",strtotime($datee));

	$query = $this->db->query("INSERT INTO presence (datee,status,id_student) VALUES ('$d','absent',$id)");

return true;

	}

	public function countnumberofabsence($id)
	{

		$query = $this->db->query("Select count(*) as n from presence where id_student =$id");
								return $query->row();
	}


public function getRecordss($id)
	{

		$query = $this->db->query("Select * from presence where id_student =$id ORDER BY datee DESC");
								return $query->result();
	}

public function countabsence()
	{
		$d=date("Y-m-d");

		$query = $this->db->query("Select count(*) as n from presence where datee ='$d'");
								return $query->row();
	}
}
