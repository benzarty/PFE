<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

	var $table = 'student';
	var $column_order = array('image','firstname','lastname','gender','address','dob',null,null); //set column field database for datatable orderable
	var $column_search = array('firstname','lastname','address'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		//
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	function get_datatabless($id=null)
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->where('idclasse',$id);

		$query = $this->db->get();
		return $query->result();
	}

	function get_datatablesp($id=null)
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->where('idparent',$id);

		$query = $this->db->get();
		return $query->result();
	}

	public function updateclasseetudiant($id)
	{


		$this->db->set('idclasse', NULL);
		$this->db->where('id', $id);
		$this->db->update('student');
		return true ;


	}
	public function updateparentetudiant($id)
	{


		$this->db->set('idparent', NULL);
		$this->db->where('id', $id);
		$this->db->update('student');
		return true ;


	}
	public function getavailable()
	{
		$query = $this->db->query("Select * from student where idclasse is NULL ");
		return $query->result();

	}
	public function getavailableparent()
	{
		$query = $this->db->query("Select * from student where idparent is NULL ");
		return $query->result();
	}

	function affectation($id)
	{
		$this->db->set('idclasse',$id);
		$this->db->where('id', $id);
		$this->db->update('student');
		return true ;
	}

	function affectationparent($id)
	{
		$this->db->set('idparent',$id);
		$this->db->where('id', $id);
		$this->db->update('student');
		return true ;
	}

	function acceptstudent($idstudent,$id)
	{
		$this->db->set('idclasse', $id);
		$this->db->where('id', $idstudent);
		$this->db->update('student');
		return true;

	}

	function acceptstudentparent($idstudent,$id)
	{
		$this->db->set('idparent', $id);
		$this->db->where('id', $idstudent);
		$this->db->update('student');
		return true;

	}
	public function get_by_id_classe($id)
	{
		$query = $this->db->query("Select * from student where idclasse =$id ");
		return $query->result();
	}
	public function get_by_id_st($id)
	{
		$query = $this->db->query("Select * from student where idparent =$id ");
		return $query->result();
	}
	public function getall($id)
	{
		$query = $this->db->query("Select * from student where id =$id ");
		return $query->result();
	}

public function get_by_id_pr($id)
	{
		$query = $this->db->query("Select idparent from student where id =$id");
		return $query->row();
	}
	public function getid($id)
	{
		$query = $this->db->query("Select * from note where id =$id");
		return $query->row();
	}


		public function get_by_id_classesss($id,$datee)
	{
				$d=date("Y-m-d",strtotime($datee));

		$query = $this->db->query("Select * from student where idclasse =$id and id not in (select id_student from presence  where datee= '$datee')");
		return $query->result();
	}

	public function getidstudent($id)
	{
		$query = $this->db->query("Select * from student where idparent =$id");
		return $query->row();
	}
	public function getallrow($id)
	{
		$query = $this->db->query("Select * from student where id =$id ");
		return $query->row();
	}

public function countnumberstudents()
	{

		$query = $this->db->query("Select count(*) as n from student");
								return $query->row();
	}

}
	
