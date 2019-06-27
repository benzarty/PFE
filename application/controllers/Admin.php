<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
        {
            parent::__construct();
                // Your own constructor code
            $this->load->helper("url");
			$this->load->helper("form");
			$this->load->library("form_validation");
			$this->load->database("");
			$this->load->model('Teacher_model','person');
			$this->load->model('Note_model','no');
			$this->load->model('Admin_model','admin');


			$this->load->model('Parent_model','p');
			$this->load->model('Matiere_model','ma');
			$this->load->model('Student_model','s');
			$this->load->helper(array('form', 'url'));
			$this->load->library('upload');
			$this->load->model('mail_model' , 'm');
			$this->load->model('Payment_model' , 'pai');
			$this->load->model('Announcement_Model', 'ann');
			$this->load->model('Class_model', 'cl');
			$this->load->model('Dossier_model','d');
			$this->load->model('congee_model','con');
			$this->load->model('Notification_model','notification');
			$this->load->model('Presence_model','presence');
			$this->load->model('Convocation_model','convocation');



			$this->load->library('grocery_CRUD');
		}

	public function index()
	{
		$this->load->view('welcome_message');
	}



	public function  check_session(){

		if($this->session->userdata('username')!=null)
		{
			return true;
		}else{
			return false;
		}
	}

		function login_validation()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run())
			{
				//true
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				//model function
				$this->load->model('main_model');
				if($this->main_model->can_login($username, $password))
				{
					$userdata=$this->db->get_where("users",array("username"=>$username ,"password"=>$password))->first_row();

					$session_data = array(
						'username'     =>     $username,
						'userid'       => $userdata->id,
						'type'         => "admin"

					);
					$this->session->set_userdata($session_data);


					redirect(base_url() . 'Admin/enter');
				}
				if($this->person->can_login($username, $password))
				{
					$userdata=$this->db->get_where("teacher",array("username"=>$username ,"password"=>$password))->first_row();

					$session_data = array(
						'username'     =>     $username,
						'userid'       => $userdata->id,
						'type'         => "teacher"
					);
					$this->session->set_userdata($session_data);


					redirect(base_url() . 'Admin/enter');
				}
				if($this->p->can_login($username, $password))
				{
					$userdata=$this->db->get_where("parent",array("username"=>$username ,"password"=>$password))->first_row();

					$session_data = array(
						'username'     =>     $username,
						'userid'       => $userdata->id,
						'type'         => "parent"
					);
					$this->session->set_userdata($session_data);


					redirect(base_url() . 'Admin/enter');
				}
				else
				{
					$this->session->set_flashdata('error', 'Invalid Username or  Password');
					redirect(base_url() . 'Admin/index');
				}
			}
			else
			{
				//false
				$this->index();
			}
		}

		function enter(){

			if($this->session->userdata('username') != '')
			{
				if($this->session->userdata('type') == 'admin')
				{


				redirect(base_url() . 'Admin/indexadmin');}
				if($this->session->userdata('type') == 'teacher')
				{


					redirect(base_url() . 'Admin/indexteacher');}
				if($this->session->userdata('type') == 'parent')
				{


					//redirect(base_url() . 'Admin/indexparent');
									$userdata=$this->userdata();

													$id=$userdata->id;

					redirect('Admin/Seeyourchildren/'.$id);


				}


			}
			else
			{
				redirect(base_url() . 'Admin/login');
			}
		}
		function logout()
		{
			$this->session->unset_userdata('username');
			redirect(base_url() . 'Admin/index');
		}



		function  userdata(){
		$table="users";			
		$tableteacher="teacher";
			$tableparent="parent";

			if($this->session->userdata("type")== "admin") {
			$query = $this->db->get_where($table, array("id" => $this->session->userdata("userid")))->first_row();
		}
			if($this->session->userdata("type")== "teacher") {
				$query = $this->db->get_where($tableteacher, array("id" => $this->session->userdata("userid")))->first_row();
			}
			if($this->session->userdata("type")== "parent") {
				$query = $this->db->get_where($tableparent, array("id" => $this->session->userdata("userid")))->first_row();
			}


			return $query;

		}


		public function indexadmin(){

			if($this->check_session()){
				if($this->session->userdata("type")== "admin") {
					$userdata = $this->userdata();
					$username="benzarti";
					$id=1;
					$data['blogs'] = $this->m->getEvent($username);
					$data['annonces'] = $this->ann->getEventPublic();
					$data['mails'] = $this->m->geteachRecords($id);
					$data['count'] = $this->s->countnumberstudents();
				 $data['countteacher'] = $this->person->countnumberteacher();

				 
				 $data['absence'] = $this->presence->countabsence();










								$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
					$this->load->view('indexadmin',$data);
					$this->load->view('templates/footer');
				}else{
					redirect(base_url() . 'Admin/index');}

			}else{
				redirect(base_url() . 'Admin/index');
			}

		}

	public function modifiersup(){

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
							$this->load->view('Admin/Student/crud_student');
			$this->load->view('templates/footer');
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
		
	public function modifiersupParent(){

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
							$this->load->view('Admin/Parent/crud_parent');
			$this->load->view('templates/footer');
			}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	
	public function modifiersupMaitresse(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));			$this->load->view('Admin/Maitresse/crud_view');
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	public function Consultationmail($id){

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();

				$data['blogs'] = $this->m->geteachRecords($id);
$idn=$userdata->id;
				 $data1=0;
				 				 $datanotifset= $this->notification->SetReadAdminMail($idn);


							 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/Mail/consultation', $data);
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	public function ajoutmail(){

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
				$all= $this->person->getall();
			    $allparent= $this->p->getall();


$idn=$userdata->id;
				 $data1=0;
				 $datam=0;

				if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
			if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}

			
	
					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Mail/ajoutmail',array("bs"=>$all,"bss"=>$allparent));
			$this->load->view('templates/footer3');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	
	

	public function historique(){

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Paiement/historique');
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}


	public function annoncecreation(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
		   		$this->load->view('Admin/Annonce/annoncecreation');
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function upcoming(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$data['events'] = $this->ann->getEventPublic();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Annonce/upcoming', $data);
			$this->load->view('templates/footer');

		}}
		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {

				$userdata=$this->userdata();
				$data['blogs'] = $this->ann->getEventParent();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
					$this->load->view('parent/Event/consulterevenement', $data);
				$this->load->view('templateparent/footer');

			}}
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {

				$userdata=$this->userdata();
				$data['blogs'] = $this->ann->getEventParent();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
					$this->load->view('teacher/Event/consulterevenement', $data);
				$this->load->view('templateparent/footer');

			}
		}

		else{
			redirect(base_url() . 'Admin/index');}

	}

	public function detailevent(){
		if($this->check_session()){
			$userdata=$this->userdata();
			if($this->session->userdata("type")== "admin") {
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Annonce/detailevent');
			$this->load->view('templates/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	

	public function leaverequest(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$data['requests'] = $this->con->getRecords();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/congee/Viewrequest',$data);
			$this->load->view('templates/footer');

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	
	public function ConvocationRequest(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$data['requests'] = $this->convocation->getpending();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Convocation/ConvocationRequest',$data);
			$this->load->view('templates/footer');

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}


	public function Availability(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$data['requests'] = $this->con->getRecordsenconge();
			$data['requestss'] = $this->con->getRecordsdone();
			$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
								$this->load->view('Admin/congee/Availability',$data);
			$this->load->view('templates/footer');

		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	
	public function profil(){
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {


		    $userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));			$this->load->view('Admin/profil');
			$this->load->view('templates/footer');
		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	

	public function ajax_list()
	{

		$uri=base_url();
		$list = $this->person->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$cote="'";
			//
			$row = array();
			$row[] = '<a href="javascript:void(0)" onclick="afficher_img_teacher('.$cote.''.site_url().'uploads/'.$person->image.''.$cote.')"><img src="'.site_url().'uploads/'.$person->image.'" width="300" height="225" class="img-thumbnail" /></a>';
			$row[] = $person->firstName;
			$row[] = $person->lastName;
			$row[] = $person->gender;
			$row[] = $person->address;
			$row[] = $person->dob;
			$row[] = $person->telephone;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class=" icon-pencil"></i> Edit</a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="
                     "><i class=" icon-trash"></i> Delete</a>
                     <a class="btn btn-sm btn-secondary" href="javascript:void(0)" title="Image Upload"  onclick="Upload_teacher('."'".$person->id."'".')"><i class=" icon-picture "></i> Picture </a>
                     <a class="btn btn-sm btn-success" href="'.base_url('Admin/upload_dossier_t/'.$person->id).'" title="Files" ><i class="icon-cloud-upload"></i> Folder</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->person->count_all(),
			"recordsFiltered" => $this->person->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
			//'picture' => $img,
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'dob' => $this->input->post('dob'),
			'telephone' => $this->input->post('telephone'),
		);
		$insert = $this->person->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{		
		$this->_validate();
		$data = array(
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'dob' => $this->input->post('dob'),
			'telephone' => $this->input->post('telephone'),
		);
		$this->person->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;		

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('telephone') == '')
		{
			$data['inputerror'][] = 'telephone';
			$data['error_string'][] = 'Phone is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function saveadmin()
	{
		//Setting values for tabel columns
		$data = array(
		'idteacher' => $this->input->post('idteacher'),
		'idparent' => $this->input->post('idparent'),


		'message' => $this->input->post('message'),
		'sujet' => $this->input->post('sujet'),
			'destinataire' => $this->input->post('destinataire'),

		);
		$data2 = array(
		'idteacher' => $this->input->post('idteacher'),
			'title' =>$title="Mail",
			'message' =>$message="A new Mail has been Sent To You",
			'status' =>$status="nonlus",

			

		);
		$this->notification->form_insert($data2);

			//Transfering data to Model
		$this->m->form_insert($data);

		$data['message'] = 'Data Inserted Successfully';

		//Loading View
		if($this->check_session()){
			$userdata=$this->userdata();

			if($this->session->userdata("type")== "admin") {

$idn=$userdata->id;
				 $data1=0;
				 $datam=0;

				if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}
		
	
					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/Mail/ajoutmail', $data);
				$this->load->view('templates/footer');

				}
				}
	}

public function saveteachermail()
{
	$data = array(

		'message' => $this->input->post('message'),
		'sujet' => $this->input->post('sujet'),
			'destinataire' => $this->input->post('destinataire'),
					'idadmin' => $this->input->post('idadmin'),


		);
		$data2 = array(
			'title' =>$title="Mail",
			'message' =>$message="A new Mail has been Sent To You",
			'status' =>$status="nonlus",
			'idadmin' => $this->input->post('idadmin'),


			

		);
		$this->notification->form_insert($data2);

			//Transfering data to Model
		$this->m->form_insert($data);

		$data['message'] = 'Data Inserted Successfully';

		//Loading View
		if($this->check_session()){
			$userdata=$this->userdata();

			if($this->session->userdata("type")== "teacher") {

$idn=$userdata->id;
				 $data1=0;
				 $datam=0;

				if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}
		
	
					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/Mail/ajoutmail', $data);
				$this->load->view('templates/footer');

				}
				}

}
public function saveparentmail()
	{
		//Setting values for tabel columns
		$data = array(
		'idadmin' => $idadmin=1,

		'message' => $this->input->post('message'),
		'sujet' => $this->input->post('sujet'),
			'destinataire' => $this->input->post('destinataire'),

		);

		$datamail = array(
		'idadmin' => $idadmin=1,
			'title' =>$title="Mail",
			'message' =>$message="A new Mail has been Sent To You",
			'status' =>$status="nonlus",

			

		);
		$this->notification->form_insert($datamail);

			//Transfering data to Model
		$this->m->form_insert($data);

		$data['message'] = 'Data Inserted Successfully';
    
		//Loading View
		if($this->check_session()){
			$userdata=$this->userdata();

			if($this->session->userdata("type")== "parent") {

$idn=$userdata->id;
				 $data1=0;
				 $datam=0;


				if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}
		
	
					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('parent/Mail/ajoutmail', $data);
				$this->load->view('templateparent/footer');

				}
				}
	}
		
		

	function delete_all()
	{
		if($this->input->post('checkbox_value'))
		{
			$id = $this->input->post('checkbox_value');
			for($count = 0; $count < count($id); $count++)
			{
				$this->m->delete($id[$count]);
			}
		}
	}

    public function ajax_listparent()
    {

		$uri=base_url();
		$list = $this->p->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $p) {
			$no++;
			$cote="'";
			//
			$row = array();
			$row[] = '<a href="javascript:void(0)" onclick="afficher_img_parent('.$cote.''.site_url().'uploads/'.$p->image.''.$cote.')"><img src="'.site_url().'uploads/'.$p->image.'" width="300" height="225" class="img-thumbnail" /></a>';			$row[] = $p->firstName;
			$row[] = $p->lastName;
			$row[] = $p->gender;
			

			//add html for action
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_parent('."'".$p->id."'".')"><i class=" icon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_parent('."'".$p->id."'".')"><i class=" icon-trash"></i> Delete</a>
                  <a class="btn btn-sm btn-secondary" href="javascript:void(0)" title="Image Upload"  onclick="Upload_parent('."'".$p->id."'".')"><i class=" icon-picture "></i> Picture</a>
                  <a class="btn btn-sm btn-success" href="'.base_url('Admin/moredetailparent/'.$p->id).'" title="More Detail"><i class="icon-plus"></i> Add Children</a>
                  <a class="btn btn-sm btn-dark" href="javascript:void(0)" title="View" onclick="view_parent('."'".$p->id."'".')"><i class="ti-fullscreen "></i> View</a></div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->p->count_all(),
			"recordsFiltered" => $this->p->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_editparent($id)
	{
		$data = $this->p->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_viewparent($id)
	{
		$data = $this->p->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_addparent()
	{
		$this->_validate_parent();
		$mail=$this->input->post('mail');
		$username=$this->input->post('username');

				$mailsearch = $this->p->searchmail($mail,$username);


if ($mailsearch == null)
		{$data = array(
			//'picture' => $img,
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'mail' => $this->input->post('mail'),

			'address' => $this->input->post('address'),
			'dob' => $this->input->post('dob'),
			'telephone' => $this->input->post('telephone'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),


		);
		$insert = $this->p->save($data);
		echo json_encode(array("status" => TRUE));}
	}

	public function ajax_updateparent()
	{
		$this->_validate_parent();
		$data = array(
			//'picture' => ajax_upload(),
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'mail' => $this->input->post('mail'),

			'dob' => $this->input->post('dob'),
			'telephone' => $this->input->post('telephone'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),


		);
		$this->p->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_deleteparent($id)
	{
		$this->p->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


    function _validate_parent()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;		

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('telephone') == '')
		{
			$data['inputerror'][] = 'telephone';
			$data['error_string'][] = 'Phone is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('mail') == '')
		{
			$data['inputerror'][] = 'mail';
			$data['error_string'][] = 'Mail is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function ajax_liststudent()
	{

		$uri=base_url();
		$list = $this->s->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;
			$cote="'";

			$row = array();
			$row[] = '<a href="javascript:void(0)" onclick="afficher_img('.$cote.''.site_url().'uploads/'.$s->image.''.$cote.')"><img src="'.site_url().'uploads/'.$s->image.'" width="300" height="225" class="img-thumbnail" /></a>';			$row[] = $s->firstName;
			$row[] = $s->lastName;
			$row[] = $s->gender;
			


			//add html for action
			$row[] = '<div class="text-center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_student('."'".$s->id."'".')"><i class=" icon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_student('."'".$s->id."'".')"><i class=" icon-trash"></i> Delete</a>
                  <a class="btn btn-sm btn-secondary" href="javascript:void(0)" title="Image Upload"  onclick="Upload_student('."'".$s->id."'".')"><i class=" icon-picture "></i> Picture</a>
                  <a class="btn btn-sm btn-success" href="'.base_url('Admin/upload_dossier/'.$s->id).'" title="Files Upload" ><i class="icon-folder-alt"></i> Folder</a>
                  <a class="btn btn-sm btn-dark" href="javascript:void(0)" title="View" onclick="view_student('."'".$s->id."'".')"><i class="ti-fullscreen "></i> View</a></div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->s->count_all(),
			"recordsFiltered" => $this->s->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_editstudent($id)
	{
		$data = $this->s->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_viewstudent($id)
	{
		$data = $this->s->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_addstudent()
	{
		$this->_validate_student();
		$data = array(
			//'picture' => $img,
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'dob' => $this->input->post('dob'),

		);
		$insert = $this->s->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_updatestudent()
	{
		$this->_validate_student();
		$data = array(
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'gender' => $this->input->post('gender'),
			'address' => $this->input->post('address'),
			'dob' => $this->input->post('dob'),

		);
		$this->s->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_deletestudent($id)
	{
		$this->s->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

    function _validate_student()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('firstName') == '')
		{
			$data['inputerror'][] = 'firstName';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastName') == '')
		{
			$data['inputerror'][] = 'lastName';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'Please select gender';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function saveannonce()
	{
		//echo $this->input->post('typeee');
		//Setting values for tabel columns
		$data = array(
			'titre' => $this->input->post('titre'),
			'description' => $this->input->post('description'),
			'typeee' => $this->input->post('typeee'),
			'host' => $this->input->post('host'),
			'place' => $this->input->post('place'),
			'date' => $this->input->post('date'),
			'idadmin' => $this->input->post('idadmin'),

		);

		$typeee=$this->input->post('typeee');



		if($typeee == "parent")
		{

				$idparent = $this->p->getall();
				
//echo json_encode($idparent);
foreach($idparent as $p)
{
	$id=$p->id;

						$this->notification->ajoutannonceparent($id);

}

	}
	if($typeee == "teacher")
		{

				$idteacher = $this->person->getall();
				
//echo json_encode($idparent);
foreach($idteacher as $p)
{
	$id=$p->id;

						$this->notification->ajoutannonceteacher($id);

}

	}
	if($typeee == "public")
		{

				$idteacher = $this->person->getall();
				
foreach($idteacher as $p)
{
	$id=$p->id;

						$this->notification->ajoutannonceteacher($id);

}
				$idparent = $this->p->getall();

foreach($idparent as $parent)
{
	$id=$parent->id;

						$this->notification->ajoutannonceparent($id);

}

	}


		



		//Transfering data to Model
		$this->ann->form_insert($data);



		$data['message'] = 'Data Inserted Successfully';


		//Loading View
		if($this->check_session()){
			$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Annonce/annoncecreation', $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/index');
		}
	}

	public function  deleteevent()
	{
		$id = $this->input->get('id');
            if($this->ann->delete_annonce($id))
			{
				$data['events'] = $this->ann->getRecords();

				if($this->check_session()){
					if($this->session->userdata("type")== "admin") {

						$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					//$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
						//$this->load->view('Admin/Annonce/annoncecreation', $data);
					//$this->load->view('templates/footer');
										redirect(base_url() . 'Admin/upcoming');

			
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}}


	 public function Upload_student()
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();

			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Student/Upload_student');
			$this->load->view('templates/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	function img_student(){
		$picture="";
			//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}

		//Prepare array of user data
		$userData = array(
			'image' => $picture
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('student', $userData);

		//Pass user data to model

	    $this->modifiersup();
		}


		function Upload_parent()
	    {
			if($this->check_session()){
				if($this->session->userdata("type")== "admin") {

					$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
					$this->load->view('Admin/Parent/Upload_parent');
				$this->load->view('templates/footer');
		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	function img_parent(){
		$picture="";
			//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}

		//Prepare array of user data
		$userData = array(
			'image' => $picture
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('parent', $userData);

		//Pass user data to model

	    $this->modifiersupParent();
		}

	function Upload_teacher()
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));			$this->load->view('Admin/Maitresse/Upload_teacher');
			$this->load->view('templates/footer');
		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	function img_teacher(){
		$picture="";
			//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}

		//Prepare array of user data
		$userData = array(
			'image' => $picture
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('teacher', $userData);

		//Pass user data to model

	    $this->modifiersupMaitresse();
		}

	function Profilsetting()
	{
		$picture="";
		//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}
		//Prepare array of user data
		$userData = array(
			'image' => $picture,
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'mail' => $this->input->post('mail'),
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $userData);

		//Pass user data to model
		$data['message'] = 'Data Inserted Successfully';
		if($this->check_session()){
			$userdata=$this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/profil' , $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/index');
		}
	}

	function modifierclasse()
	{

		if($this->check_session()){
			$userdata=$this->userdata();

			if($this->session->userdata("type")== "admin") {




			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/class/crud_class');
			$this->load->view('templates/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	public function ajax_editclass($id)
		{
			$data = $this->cl->get_by_id($id);
			echo json_encode($data);
		}

	public function ajax_listclass()
	{
		$uri=base_url();
		$list = $this->cl->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cl) {
			$no++;
			$row = array();
			$row[] = $cl->nomclasse;

			//add html for action
			$row[] = '<div style="text-align:center"><a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_class('."'".$cl->id."'".')"><i class=" icon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_class('."'".$cl->id."'".')"><i class=" icon-trash"></i> Delete</a>
                  <a class="btn btn-sm btn-success" href="'.base_url('Admin/moredetail/'.$cl->id).'" title="More Detail"><i class="icon-login"></i>Student Detail</a>
                  </div>
                   ';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->cl->count_all(),
			"recordsFiltered" => $this->cl->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_addclass()
	{
				$nom=$this->input->post('nomclasse');
					$nomsearch = $this->cl->searchnomclass($nom);
if($nomsearch == null)
{

		$data = array(
			'nomclasse' => $this->input->post('nomclasse'),
		);
		$nomclasse= $this->input->post('nomclasse');

			if($nomclasse != null){

		$insert = $this->cl->save($data);
		echo json_encode(array("status" => TRUE));}}
	}





	public function ajax_deleteclass($id)
	{
		$this->cl->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_updateclass()
	{

		$data = array(
			'nomclasse' => $this->input->post('nomclasse'),
		);
		$this->cl->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function moredetail($id=null)
	{
		if($this->check_session()){
			$userdata=$this->userdata();
			$classe=null;
			if(isset($id)){
				$classe=$this->db->get_where('classe',array('id'=>$id))->first_row();
			}
			$data= $this->s->getavailable();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));		$this->load->view('Admin/class/moredetail',array('stt'=>$classe,'requests'=>$data));
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	public function moredetailparent($id=null)
	{
		if($this->check_session()){
			$userdata=$this->userdata();
			$parent=null;
			if(isset($id)){
				$parent=$this->db->get_where('parent',array('id'=>$id))->first_row();
			}
			$data= $this->s->getavailableparent();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));			$this->load->view('Admin/parent/moredetailparent',array('stt'=>$parent,'requests'=>$data));
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	public function Upload_dossier($id=null){
		if($this->check_session()){
			$userdata=$this->userdata();
			$student=null;
			$teacher=null;

			if(isset($id)){
				$student=$this->db->get_where('student',array('id'=>$id))->first_row();
				$teacher=$this->db->get_where('teacher',array('id'=>$id))->first_row();
			}
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
								$this->load->view('Admin/Dossier/crud_dossier',array('st'=>$student,'te'=>$teacher));
			$this->load->view('templates/footer');

		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	
	public function dossier_pdf($id=null){
		if($this->check_session()){
			$userdata=$this->userdata();
			//$student=null;
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));			$this->load->view('Admin/Dossier/pdf',array('document'=>$id));
			$this->load->view('templates/footer');

		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	function img_dossier(){

		$dossier="";
		//Check whether user upload picture
		if(!empty($_FILES['document']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['document']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('document')){
				$uploadData = $this->upload->data();
				$dossier = $uploadData['file_name'];
			}else{
				$dossier = '';
			}
		}else{
			$dossier = '';
		}

		//Prepare array of user data
		$userData = array(
			'intitule'=>$this->input->post('intitule'),
			'document' => $dossier,
			'id_student'=>$this->input->post('stid'),
			

		);
		//$this->db->where('id', $this->input->post('id'));
		$this->db->insert('dossier', $userData);

		//Pass user data to model
		if($this->input->post('stid')!=null){
			$this->upload_dossier($this->input->post('stid'));
		}else if($this->input->post('teid')!=null){
			$this->upload_dossier_t($this->input->post('teid'));
		}
	}

	public function ajax_listdossier($id=null)
	{
		$uri=base_url();
		$list = $this->d->get_datatables($id,null);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$cote="'";
			//
			$row = array();
			$row[] = '<div style="text-align:center">'.$d->intitule.'</div>';
			$row[] ='<div style="text-align:center"><a class="btn btn-sm btn-dark"  href="'.base_url('Admin/dossier_pdf/'.$d->document).'" title="pdf"  ><boutton src="'.site_url().'uploads/'.$d->document.'"/><i class="ti-fullscreen"></i>  View</boutton> </a>
		<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_dossier('."'".$d->id."'".')"><i class=" icon-trash"></i> Delete</a></div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->d->count_all(),
			"recordsFiltered" => $this->d->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	function editfolder()
	{
		$picture="";
		//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['document']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('document')){
				$uploadData = $this->upload->data();
				$document = $uploadData['file_name'];
			}else{
				$document = '';
			}
		}else{
			$document = '';
		}
		//Prepare array of user data
		$userData = array(
			'document' => $document,
			'intitule' => $this->input->post('intitule'),
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('dossier', $userData);
		//Pass user data to model

		$data['message'] = 'Data Inserted Successfully';
		if($this->check_session()){
			$userdata=$this->userdata();
					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/upload_dossier' , $data);
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	public function  deleteconge()
	{
		$data = array(
			'idteacher' =>$this->input->post('idteacher'),
			'title' =>$title="Conge",
			'message' =>$message="Your request has been Refused",
			'status' =>$status="nonlus",

			

		);

					$idd =$this->input->post('id');

		$this->notification->form_insert($data);
		if ($this->con->deleteuser($idd))
		{
			redirect(base_url() . 'Admin/leaverequest');
		}
	}

	public function  acceptconge()
	{
		$data = array(
			'idteacher' =>$this->input->post('idteacher'),
			'title' =>$title="Conge",
			'message' =>$message="Your request has been accepted",
			'status' =>$status="nonlus",

			

		);

					$idd =$this->input->post('id');

		$this->notification->form_insert($data);
		if ($this->con->acceptuser($idd))
		{
			redirect(base_url() . 'Admin/leaverequest');
		}
	}
	public function  acceptconvocation()
	{
		$data = array(
			'idteacher' =>$this->input->post('idteacher'),
			'title' =>$title="Convocation",
			'message' =>$message="Your Convocation has been to Accepted",
			'status' =>$status="nonlus",
		);

					$idd =$this->input->post('id');



						$idstudent=$this->input->post('idstudent');
					$idparent=$this->s->get_by_id_pr($idstudent);


		$data2 = array(
			'idparent' =>$idparent=$idparent->idparent,
			'title' =>$title="Conge",
			'message' =>$message="Your have a new Convocation to Review",
			'status' =>$status="nonlus",
		);

		$this->notification->form_insert($data);
			$this->notification->form_insert($data2);

		if ($this->convocation->acceptuser($idd))
		{
			redirect(base_url() . 'Admin/ConvocationRequest');
		}
	}
	public function  deleteconvocation()
	{
		$data = array(
			'idteacher' =>$this->input->post('idteacher'),
			'title' =>$title="Convocation",
			'message' =>$message="Your Convocation has been to Refused",
			'status' =>$status="nonlus",
		);

					$idd =$this->input->post('id');



				
		$this->notification->form_insert($data);

		if ($this->convocation->deleteconvocation($idd))
		{
			redirect(base_url() . 'Admin/ConvocationRequest');
		}
	}

	public function teacher1  ()
	{
		$crud = new grocery_CRUD();
			
			$crud->set_table('teacher');
			$crud->set_subject('Teacher');
			$crud->field_type('password','password');
			$crud->set_field_upload('image','uploads');
 			$crud->set_relation_n_n('Matières', 'teachermatiere', 'matiere', 'idteacher', 'idmatiere', 'libelle');
			$output = $crud->render();
			
			if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
				$output = (array) $output;
				$output['user']=$userdata;
			$this->load->view('templates/header2',$output);
			$this->load->view('Admin/Maitresse/crud_view2',$output);
			$this->load->view('templates/footer2',$output);

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function teacher2  ()
	{
		$crud = new grocery_CRUD();


		$crud->set_table('classe');
		$crud->set_subject('classes');

		$crud->set_relation_n_n('teachers', 'classeteacher', 'teacher', 'idclasse', 'idteacher', 'firstName');


		$output = $crud->render();

		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata=$this->userdata();
				$output = (array) $output;
				$output['user']=$userdata;
				$idn=$userdata->id;
				 $output['data1']=0;

				$output['blogss']= $this->notification->getRecordsallAdmin($idn);
				$output['blogs']= $this->notification->getRecordsadmin($idn);

			
				$this->load->view('templates/header2',$output);
				$this->load->view('Admin/class/test',$output);
				$this->load->view('templates/footer2',$output);

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}	
	public function ajax_listetudiantparclasse($id=null)
	{
		$uri=base_url();
		$list = $this->s->get_datatabless($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;
			//
			$row = array();
			$row[] = $s->firstName;
			$row[] = $s->lastName;
			$row[] = $s->gender;
			$row[] = $s->dob;
			$row[] = '<img src="'.site_url().'uploads/'.$s->image.'"  class="img-thumbnail""/>';
			$row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('Admin/deleteparclassse/'.$s->id).'"  title="Delete" ><i class=" icon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->s->count_all(),
			"recordsFiltered" => $this->s->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

	}

	public function ajax_listetudiantparparent($id=null)
	{
		$uri=base_url();
		$list = $this->s->get_datatablesp($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;

			//
			$row = array();
			$row[] = $s->firstName;
			$row[] = $s->lastName;
			$row[] = $s->gender;
			$row[] = $s->dob;
			$row[] = '<img src="'.site_url().'uploads/'.$s->image.'"  class="img-thumbnail""/>';
			$row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('Admin/deleteparparent/'.$s->id).'"  title="Delete" ><i class=" icon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->s->count_all(),
			"recordsFiltered" => $this->s->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

	}

	public function  deleteparclassse($id)
	{
		if ($this->s->updateclasseetudiant($id))
		{
			redirect(base_url() . 'Admin/modifierclasse');
		}
	}

	public function  deleteparparent($id)
	{
		if ($this->s->updateparentetudiant($id))
		{
			redirect(base_url() . 'Admin/modifiersupParent');
		}
	}

	public function ajax_listerelevevailble($id=null)
	{
		$uri=base_url();
		$list = $this->s->get_datatabless($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;

			//
			$row = array();
			$row[] = $s->id;
			$row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('Admin/deleteparclassse/'.$s->id).'"  title="Delete" ><i class=" icon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->s->count_all(),
			"recordsFiltered" => $this->s->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_listerelevevailbleparent($id=null)
	{
		$uri=base_url();
		$list = $this->s->get_datatablesp($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;
			//
			$row = array();
			$row[] = $s->id;
			$row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('Admin/deleteparparent/'.$s->id).'"  title="Delete" ><i class=" icon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->s->count_all(),
			"recordsFiltered" => $this->s->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

	}

	public function ajax_deletedossier($id)
	{
		$this->d->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_deletedossier_t($id)
	{
		$this->d->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function  acceptstudentinclasse()
	{
		$id=$this->input->get('id');
		if ($this->s->acceptstudentinclasse($id))
		{
			redirect(base_url() . 'Admin/leaverequest');
		}
	}
	
	public function  acceptstudent()
	{
		$id=$this->input->get('id');
		if ($this->s->acceptstudent($id))
		{
			redirect(base_url() . 'Admin/leaverequest');
		}
	}

	public function  acceptstudentparent()
	{
		$id=$this->input->get('id');
		if ($this->s->acceptstudentparent($id))
		{
			redirect(base_url() . 'Admin/leaverequest');
		}
	}

	public function affectationeleve(){
		if($this->check_session()){
			$userdata=$this->userdata();
			$data= $this->s->getavailable();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));		$this->load->view('Admin/class/moredetail',array('requests'=>$data));
			$this->load->view('templates/footer');
			$id=$this->input->post('id');
			if($this->input->post('checkbox_value'))
			{
				$idstudent = $this->input->post('checkbox_value');
				for($count = 0; $count < count($idstudent); $count++)
				{
					$this->s->acceptstudent($idstudent[$count],$id);

				}
				redirect(base_url() . 'Admin/moredetail');
			}

		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}

	public function affectationeleveparent(){
		if($this->check_session()){
			$userdata=$this->userdata();
			$data= $this->s->getavailableparent();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/parent/moredetailparent',array('requests'=>$data));
			$this->load->view('templates/footer');
			$id=$this->input->post('id');

			if($this->input->post('checkbox_value'))
			{
				$idstudent = $this->input->post('checkbox_value');
				for($count = 0; $count < count($idstudent); $count++)
				{
					$this->s->acceptstudentparent($idstudent[$count],$id);
				}
				redirect(base_url() . 'Admin/moredetailparent');
			}
		}else{
			redirect(base_url() . 'Admin/logout');
		}
	}
		public function ADDteachertoclass($id=null)
	{
		if($this->check_session()){
			$userdata=$this->userdata();
			$teacherclass=null;
			if(isset($id)){
				$teacherclass=$this->db->get_where('classeteacher',array('idclasse'=>$id))->first_row();
			}
					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/ClassList',array('stt'=>$teacherclass,"teacherid"=>$id));
			$this->load->view('templates/footer');
		}else{
			redirect(base_url() . 'Admin/index');
		}
	}
	
	public function table_affectationteachertoclass($id=null)
	{
		$uri=base_url();
		$list = $this->person->get_datatabless($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $s) {
			$no++;
			//
			$row = array();
			$row[] = $s->id;
			$row[] = $s->firstName;
			$row[] = $s->lastName;
			$row[] = '<img src="'.site_url().'uploads/'.$s->image.'"  class="img-thumbnail""/>';
			$row[] = '<a class="btn btn-sm btn-danger" href="'.base_url('Admin/deleteparclassse/'.$s->id).'"  title="Delete" ><i class=" icon-trash"></i> Delete</a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->person->count_all(),
			"recordsFiltered" => $this->person->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

	}
	public function detailmail($id)
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "admin") {

				$userdata = $this->userdata();


				$data['blogs'] = $this->m->getdetail($id);
						$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsadmin($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Admin/Mail/detailmail',$data);
				$this->load->view('templates/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	

	public function MarkreadNotifAdmin()
{

	if($this->check_session()){
		if($this->session->userdata("type")== "admin") {

				$userdata = $this->userdata();
								$idn=$userdata->id;


				 $datanotifset= $this->notification->SetReadAdmin($idn);

				$datanotifread= $this->notification->getRecordsallAdmin($idn);
				$datanotif= $this->notification->getRecordsadmin($idn);

			
				 $data1=0;	
				 $datam=0;
			
				if	($datanotifm= $this->notification->getRecordsadminmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templates/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Admin/notif',array("blogs" => $datanotif,"blogss" => $datanotifread));
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}




	//***************************************************Teacher****************************************************//









	public function indexteacher()
	{

		if ($this->check_session()) {
			if($this->session->userdata("type")== "teacher") {


				$userdata = $this->userdata();
		$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}

					$data['annonces'] = $this->ann->getEvent();
					$data['congee'] = $this->con->countconge($idn);

				   $data['classe'] = $this->cl->countnumberstudents($idn);
				   
				   	 $data['convocation'] = $this->convocation->countconvocation($idn);
				   	  $data['avergenote'] = $this->no->getavergenotetoutclasse($idn);




					




					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/indexteacher',$data);
			$this->load->view('templateteacher/footer');

		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function classmanagement()
	{
		if ($this->check_session()) {
			if($this->session->userdata("type")== "teacher") {

				$userdata = $this->userdata();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/ClassList');
			$this->load->view('templateteacher/footer');

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
		public function load_table()
	{
		if ($this->check_session()) {
			if($this->session->userdata("type")== "teacher") {

				$userdata = $this->userdata();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


		
		
		     $postData = $this->input->post();
		     $datee = $this->input->post('datee');
		     



		          $id = $this->input->post('id');


		     				$data = $this->s->get_by_id_classesss($id,$datee);


		   
		  $this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));


			$this->load->view('Teacher/Management/Presence',array("response"=>$postData,"blogs"=>$data));
						$this->load->view('templateteacher/footer');

	}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	public function profilteacher(){
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {

				$userdata=$this->userdata();
						$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			
			$this->load->view('Teacher/profil');
			$this->load->view('templateteacher/footer');
		}else{
			redirect(base_url() . 'Admin/logout');}
		}
	}
	function Profilsettingteacher()
	{
		$picture="";
		//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}
		//Prepare array of user data
		$userData = array(
			'image' => $picture,
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'mail' => $this->input->post('mail'),
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('teacher', $userData);

		//Pass user data to model
		$data['message'] = 'Data Inserted Successfully';
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {

				$userdata=$this->userdata();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('teacher/profil' , $data);
			$this->load->view('templateteacher/footer');
		}else{
			redirect(base_url() . 'Admin/logout');}
		}
	}

	public function Consultationmailteacher($id){

		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {



				$userdata=$this->userdata();

								$data['blogs'] = $this->m->geteachRecordsteacher($id);

				$idn=$userdata->id;
							 $datanotifset= $this->notification->SetReadteacherMail($idn);

				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Mail/consultation', $data);
			$this->load->view('templateteacher/footer');

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

	public function ajoutmailteacher(){

		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {

				$userdata=$this->userdata();
							$all= $this->admin->getall();

				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Mail/ajoutmail',array("bs"=>$all));
			$this->load->view('templateteacher/footer');

		
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function writerequest()
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {
				$userdata = $this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
				$this->load->view('Teacher/congee/Writerequest1');
				$this->load->view('templateteacher/footer');
			}else{
				redirect(base_url() . 'Admin/logout');}

		}else{
			redirect(base_url() . 'Admin/logout');
		}

	}

	public function  viewcongeeteacher()
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {
		$userdata = $this->userdata();
			
		$id=$this->input->get('id');
		$data['requestss'] = $this->con->viewcongeeteacher($id);

			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/congee/Viewcongee',$data);
			$this->load->view('templateteacher/footer');
			}else{
				redirect(base_url() . 'Admin/logout');}

		}else{
			redirect(base_url() . 'Admin/logout');
		}

	}
	public function saveteacher()
	{
		//Setting values for tabel columns
		$data = array(
			'datedebut' => $this->input->post('datedebut'),
			'datefin' => $this->input->post('datefin'),
			'raison' => $this->input->post('raison'),
			'idteacher' => $this->input->post('idteacher'),

		);
					$data2 = array(
			'idadmin' =>$idadmin= 1,
			'title' =>$title="Conge",
			'message' =>$message="A new request has been recieved",
			'status' =>$status="nonlus",

			

		);

		$this->notification->form_insert($data2);
		//Transfering data to Model
		$this->con->form_insert($data);
		$data['message'] = 'Data Inserted Successfully';

		//Loading View
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {

				$userdata=$this->userdata();
						$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/congee/Writerequest1', $data);
			$this->load->view('templateteacher/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function  consultevenementteacher()
	{
		if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {
		$userdata = $this->userdata();
			
		$username=$this->session->userdata("username");
				$data['blogs'] = $this->ann->getEvent($username);


$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
		$this->load->view('Teacher/Event/consulterevenement',$data);
		$this->load->view('templateteacher/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
public function detailmailteacher($id)
{
	if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

			$userdata = $this->userdata();
			


			$data['blogs'] = $this->m->getdetail($id);




$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Mail/detailmail',$data);
			$this->load->view('templateteacher/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
public function ajax_listerclassedemaitresse($id)
	{
		$res = $this->person->get_related_class($id);
		$data = array();
		foreach ($res as $classe)
		{		
			$t = $this->cl->get_by_id($classe->idclasse);
			

			$row = array();

			$row[] = $t->nomclasse;
			$row[] = '<a class="btn btn-sm btn-primary"  href="'.base_url('Admin/Action_par_classe/'.$t->id).'" title="Settings"><i class="icon-settings"></i> More Detail</a>';


		
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->cl->count_all(),
			"recordsFiltered" => $this->cl->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);

	}

	public function Action_par_classe($id)
	{
		if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

			$userdata = $this->userdata();


				$data = $this->s->get_by_id_classe($id);
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/Action_par_classe',array("blogs" => $data,"id"=>$id));
			$this->load->view('templates/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function Convocation($id){

	if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

			$userdata=$this->userdata();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}

$idclasse=$this->s->getallrow($id);


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/convocation',array("id"=>$id,"idclasse" =>$idclasse));
			$this->load->view('templateteacher/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
		public function ConvocationPost(){

	if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

			$userdata=$this->userdata();
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}

$id=$this->input->post('idstudent');
$idclasse=$this->s->getallrow($id);




			$data = array(
			'date' => $this->input->post('date'),
			'time' => $this->input->post('time'),
			'reason' => $this->input->post('reason'),
			'idteacher' => $this->input->post('idteacher'),
			'status' => $status="pending",



			'idstudent' => $this->input->post('idstudent'),	
		);

$data2 = array(
			'idadmin' =>$idadmin=1,
			'title' =>$title="Convocation",
			'message' =>$message="A new Convocation request is on hold ",
			'status' =>$status="nonlus",

			

		);
		$this->notification->form_insert($data2);
		$this->convocation->form_insert($data);
				$data['message'] = 'Data Inserted Successfully';


		
			$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/convocation',array("message" =>$data,"id"=>$id,"idclasse"=>$idclasse));
			$this->load->view('templateteacher/footer');





		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

public function Gradetoeach($id)
{
	if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

			$userdata = $this->userdata();
			$data= $this->s->getall($id);
			
				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}
				$idmatiere=$this->ma->getidmatiers($idn);


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/Gradetoeach',array("blogs" => $data,"id"=>$id,"matieres" =>$idmatiere));
			$this->load->view('templateteacher/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
public function countgrade()
{
	$userdata = array(
			'note' => $this->input->post('count'),
			'remarque' => $this->input->post('remarque'),
			'date' => $this->input->post('date'),
			'idstudent' => $this->input->post('idstudent'),
			'idteacher' => $this->input->post('idteacher'),
							'idmatiere' => $this->input->post('idmatiere'),



		);
				$idstudent =$this->input->post('idstudent');
				$lol= $this->s->get_by_id_pr($idstudent);

			$data2 = array(
			'idparent' =>$idparent=$lol->idparent,
			'title' =>$title="Note",
			'message' =>$message="A new Note has been Added",
			'status' =>$status="nonlus",

			

		);



		$this->notification->form_insert($data2);



			$this->no->form_insert($userdata);
				$data2= 'Data Inserted Successfully';
			$userdata = $this->userdata();
			$data= $this->s->getall($idstudent);

				$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
$this->load->view('Teacher/Management/Gradetoeach',array("blogs" => $data,"id"=>$idstudent,"message" => $data2));
			$this->load->view('templateteacher/footer');

	
			//redirect('Admin/Gradetoeach/'.$idstudent);
		


}
public function ReviewGrades($id)
{
	if($this->check_session()){
			if($this->session->userdata("type")== "teacher") {
				$userdata = $this->userdata();
			$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}
				$dd=$this->no->getRecordss($id);
								

								$ddd=$this->s->getall($id);
						$moyenne=$this->no->getavergenote($id);
												$number=$this->no->getnumber($id);





					$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('Teacher/Management/ReviewGrades',array("blogs" => $dd,"students" => $ddd,"mo"=> $moyenne,"moo"=> $number));
			$this->load->view('templateteacher/footer');


		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
public function  deletenote($id)
	{
 
            		$idd=$this->s->getid($id);


		
		if ($this->no->deletenote($id))
		{

redirect('Admin/ReviewGrades/'.$idd->idstudent);
		}
	}

	function Mark_all()
	{
		if($this->input->post('checkbox_value'))
		{
			$id = $this->input->post('checkbox_value');
			$datee = $this->input->post('datee');



			for($count = 0; $count < count($id); $count++)
			{

				$this->presence->Addpresence($id[$count],$datee[$count]);
			}
		}
	}

public function MarkreadNotifTeacher()
{

	if($this->check_session()){
		if($this->session->userdata("type")== "teacher") {

				$userdata = $this->userdata();
				$idn=$userdata->id;

				
				 $datanotifset= $this->notification->SetRead($idn);

				$datanotifread= $this->notification->getRecordsall($idn);
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsteacher($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsteachermail($idn))
					{	
		$datam = 1;
			}

			
	$this->load->view('templateteacher/header', array("user" => $userdata,"blogs" => $datanotif,"blogss" => $datanotifread,"messagenotif" =>$data1,"blogss" => $datanotifm,"messagenotifm" =>$datam));
			$this->load->view('Teacher/notif',array("blogss" => $datanotifread));
			$this->load->view('templateteacher/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	//************************************************Parent*****************************************//

	
	public function profilparent(){
		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {

				$userdata=$this->userdata();
					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
				$this->load->view('parent/profil');
				$this->load->view('templateparent/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	function Profilsettingparent()
	{
		$picture="";
		//Check whether user upload picture
		if(!empty($_FILES['image']['name'])){
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $_FILES['image']['name'];

			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];
			}else{
				$picture = '';
			}
		}else{
			$picture = '';
		}
		//Prepare array of user data
		$userData = array(
			'image' => $picture,
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'firstName' => $this->input->post('firstName'),
			'lastName' => $this->input->post('lastName'),
			'mail' => $this->input->post('mail'),
		);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('parent', $userData);

		//Pass user data to model
		$data['message'] = 'Data Inserted Successfully';
		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {

				$userdata=$this->userdata();
					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
				$this->load->view('parent/profil',$data);
				$this->load->view('templateparent/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function Consultationmailparent($id){

		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {

				$userdata=$this->userdata();

				$data['blogs'] = $this->m->geteachRecordsparent($id);
					$idn=$userdata->id;
				$datanotifset= $this->notification->SetReadparentMail($idn);

				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	

				$this->load->view('parent/Mail/consultation', $data);
				$this->load->view('templateparent/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
	public function ajoutmailparent(){

		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {

				$userdata=$this->userdata();
				$all= $this->admin->getall();



					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
				$this->load->view('parent/Mail/ajoutmail',array("bs"=>$all));
				$this->load->view('templateparent/footer');

	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
 public function Seeyourchildren($id)
 {
 	if($this->check_session()){
			if($this->session->userdata("type")== "parent") {
				$userdata=$this->userdata();
								$data = $this->s->get_by_id_st($id);



								$id2=$this->s->getidstudent($id);
								$id3=$id2->id;



						$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}
				$moyenne=$this->no->getavergenote($id3);
				$number=$this->no->getnumber($id3);

				$absence=$this->presence->countnumberofabsence($id3);


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
				$this->load->view('parent/Children/Seeyourchildren', array("mooo"=>$absence,"blogs"=>$data,"mo"=> $moyenne,"moo"=> $number));
				$this->load->view('templateparent/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
 public function SeeyourchildrenGrades($id)
 {
 	if($this->check_session()){
			if($this->session->userdata("type")== "parent") {
				$userdata=$this->userdata();

								$data['blogs'] = $this->no->getRecords($id);



	$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));					$this->load->view('parent/Children/SeeyourchildrenGrades',$data);
				$this->load->view('templateparent/footer');


		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}

		public function SeeyourchildrenPresence($id)
 {
 	if($this->check_session()){
			if($this->session->userdata("type")== "parent") {
				$userdata=$this->userdata();

								$data['blogs'] = $this->presence->getRecordss($id);



	$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));				
						$this->load->view('parent/Children/SeeyourchildrenPresence',$data);
				$this->load->view('templateparent/footer');


		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
 public function detailmailparent($id)
{
	if($this->check_session()){
		if($this->session->userdata("type")== "parent") {

			$userdata = $this->userdata();


			$data['blogs'] = $this->m->getdetail($id);





	$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));				$this->load->view('parent/Mail/detailmail',$data);
			$this->load->view('templateparent/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}
public function MarkreadNotifParent()
{

	if($this->check_session()){
		if($this->session->userdata("type")== "parent") {

				$userdata = $this->userdata();
								$idn=$userdata->id;


				 $datanotifset= $this->notification->SetReadParent($idn);
				 $datanotifset= $this->notification->SetReadParent2($idn);
				 $datanotifset= $this->notification->SetReadParent3($idn);




				$datanotifread= $this->notification->getRecordsallParent($idn);
				$datanotif= $this->notification->getRecordsparent($idn);

			
				 $data1=0;	
				 $datam=0;
			
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}


					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));
			$this->load->view('parent/notif',array("blogs" => $datanotif,"blogss" => $datanotifread));
			$this->load->view('templateparent/footer');

		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}


public function SeeConvocation($id){

		if($this->check_session()){
			if($this->session->userdata("type")== "parent") {
				$userdata = $this->userdata();
					$idn=$userdata->id;
				 $data1=0;	
				 $datam=0;
			if	($datanotif= $this->notification->getRecordsparent($idn))
					{	
		$data1 = 1;
			}
				if	($datanotifm= $this->notification->getRecordsparentmail($idn))
					{	
		$datam = 1;
			}

								$Convocation=$this->convocation->getrelatedconvocation($idn);






					$this->load->view('templateparent/header', array("user" => $userdata,"blogs" => $datanotif,"messagenotif" =>$data1,"messagenotifm" =>$datam,"blogss" => $datanotifm));	
				$this->load->view('parent/Convocation/SeeConvocation',array("blogs" => $Convocation));
				$this->load->view('templateparent/footer');
	
		}else{
					redirect(base_url() . 'Admin/logout');}

			}else{
				redirect(base_url() . 'Admin/logout');
			}

		}





}