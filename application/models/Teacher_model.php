<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model {

	var $table = 'teacher';
	var $column_order = array('image','firstname','lastname','gender','address','dob','telephone',null); //set column field database for datatable orderable
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
	function can_login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('teacher');
		//SELECT * FROM users WHERE username = '$username' AND password = '$password'
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function form_insert($data){
// Inserting in Table(students) of Database(college)
		$this->db->insert('congee', $data);
	}
	public function get_related_class($id)
	{		$this->db->from('classeteacher');
		$this->db->where('idteacher',$id);
		$query = $this->db->get();
		return $query->result();

	}
	public function get_related_matiere($id)
	{		$this->db->from('teachermatiere');
		$this->db->where('idteacher',$id);
		$query = $this->db->get();
		return $query->result();



	}

	public function getids()
	{

			$query = $this->db->query("Select id from teacher");
						return $query->result();
	}
	public function getall()
	{            

			$query = $this->db->query("Select * from teacher");

				return $query->result();

	}
	public function countnumberteacher()
	{

		$query = $this->db->query("Select count(*) as n from teacher");
								return $query->row();
	}

}
