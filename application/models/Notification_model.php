<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	    function form_insert($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('notification', $data);
}

	

		public function getRecordsadmin($idn)
	{
		
				$query = $this->db->query("Select * from notification where idadmin = $idn and status = 'nonlus' and title = 'Conge' or idadmin = $idn and status = 'nonlus'and title = 'Convocation'  ORDER BY datee DESC");
						return $query->result();


	}
		public function getRecordsparent($idn)
	{
		

		$query = $this->db->query("Select * from notification where title='Note' and idparent = $idn and status = 'nonlus' or title='Convocation' and idparent = $idn and status = 'nonlus' or title='Annonce' and idparent = $idn and status = 'nonlus'  ORDER BY datee DESC");
						return $query->result();


	}
	public function SetRead($idn)
	{

		
		$query = $this->db->query("UPDATE notification SET status = 'lus' WHERE title= 'Conge' and idteacher= $idn  or title='Convocation' and idteacher= $idn or title= 'Annonce' and idteacher= $idn" );

return true ;
	

	}
	public function getRecordsall($idn)
	{
			$query = $this->db->query("Select * from notification where idteacher = $idn and status = 'lus' and title='Conge' or idteacher = $idn and status = 'lus' and title='Convocation' or idteacher = $idn and status = 'lus' and title='Annonce'  ORDER BY datee DESC");
						return $query->result();


	}

	public function SetReadAdmin($idn)
	{

	$query = $this->db->query("UPDATE notification SET status = 'lus' WHERE title= 'Conge' and idAdmin= $idn  or title='Convocation' and idAdmin= $idn" );


		return true ;

	

	}
	public function SetReadParent($idn)
	{

		$this->db->set('status', 'lus');
		$this->db->where('idparent', $idn);
			$this->db->where('title', 'Annonce');



		$this->db->update('notification');
					//$query = $this->db->query("UPDATE notification SET status = 'lus' WHERE title= 'mail' and idAdmin= $idn");


		return true ;
	}
public function SetReadParent2($idn)
	{

		$this->db->set('status', 'lus');
		$this->db->where('idparent', $idn);
			$this->db->where('title', 'Note');



		$this->db->update('notification');
					//$query = $this->db->query("UPDATE notification SET status = 'lus' WHERE title= 'mail' and idAdmin= $idn");


		return true ;
	}
	public function SetReadParent3($idn)
	{

		$this->db->set('status', 'lus');
		$this->db->where('idparent', $idn);
			$this->db->where('title', 'Convocation');



		$this->db->update('notification');
					//$query = $this->db->query("UPDATE notification SET status = 'lus' WHERE title= 'mail' and idAdmin= $idn");


		return true ;
	}


		public function getRecordsallAdmin($idn)
	{
			$query = $this->db->query("Select * from notification where idAdmin = $idn and status = 'lus' and title='Conge' or idAdmin = $idn and status = 'lus'and title='Convocation' ORDER BY datee DESC");
						return $query->result();


	}
	public function getRecordsallParent($idn)
	{
			$query = $this->db->query("Select * from notification where idparent = $idn and status = 'lus' and title='Conge' or idparent = $idn and status = 'lus' and title='Note' or idparent = $idn and status = 'lus' and title='Convocation' or idparent = $idn and status = 'lus' and title='Annonce' ORDER BY datee ASC");
						return $query->result();


	}




	public function getRecordsadminmail($idn)
	{
		
				$query = $this->db->query("Select * from notification where idadmin = $idn and status = 'nonlus' and title = 'Mail'  ORDER BY datee DESC");
						return $query->result();


	}
	public function getRecordsparentmail($idn)
	{
		$query = $this->db->query("Select * from notification where idparent = $idn and status = 'nonlus' and title = 'Mail'  ORDER BY datee DESC");
						return $query->result();

	}

	public function SetReadAdminMail($idn)
	{
		$this->db->set('status', 'lus');
		$this->db->where('idadmin', $idn);
				$this->db->where('title', 'Mail');

		$this->db->update('notification');


		return true ;

	}

	public function getRecordsteacher($idn)
	{
		
				$query = $this->db->query("Select * from notification where idteacher = $idn and status = 'nonlus' and title = 'Conge'  or idteacher = $idn and status = 'nonlus' and title = 'Convocation' or idteacher = $idn and status = 'nonlus' and title = 'Annonce'   ORDER BY datee DESC");
						return $query->result();


	}
		public function getRecordsteachermail($idn)
	{
		
				$query = $this->db->query("Select * from notification where idteacher = $idn and status = 'nonlus' and title = 'Mail'  ORDER BY datee DESC");
						return $query->result();


	}


public function SetReadparentMail($idn)
	{
		$this->db->set('status', 'lus');
		$this->db->where('idparent', $idn);
				$this->db->where('title', 'Mail');

		$this->db->update('notification');


		return true ;

	}
	public function SetReadteacherMail($idn)
	{
		$this->db->set('status', 'lus');
		$this->db->where('idteacher', $idn);
				$this->db->where('title', 'Mail');

		$this->db->update('notification');


		return true ;

	}

public function ajoutannonceparent($idparent)
 {
 
 	$query = $this->db->query("INSERT INTO notification (title, message, status , idparent)
VALUES ('Annonce', 'A new annonce Has Been Added', 'nonlus', $idparent)");
			return true;

 }

 public function ajoutannonceteacher($idteacher)
 {
 
 	$query = $this->db->query("INSERT INTO notification (title, message, status , idteacher)
VALUES ('Annonce', 'A new annonce Has Been Added', 'nonlus', $idteacher)");
			return true;

 }
	
}
