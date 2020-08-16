<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_home');
	}

	public function index() {
		$data = [
			'organizations_grid' => $this->model_home->organizations_grid(),
		];
		$this->load->view('interface/home/main_landing', $data);
	}
	
	public function example() {
			$this->load->view('interface/home/1.php');
	}


	public function login(){
		$result = [];
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		if ($this->form_validation->run() == TRUE) {
			$where = [
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			];
			if($this->model_home->is_logged_in($where)){
				if($this->input->post('remember') != '1'){
					$this->session->sess_expiration = 10800;
				    $this->session->sess_expire_on_close = TRUE;
				}
				$result['notification'] = $this->layout->notification(1, 'Loading Account...', 'system');
			}else{
				$result['notification'] = $this->layout->notification(2, 'Account does not exist.');
			}
		}else{
			$result['notification'] = $this->layout->notification(2, validation_errors());
		}
		echo json_encode($result);
	}

	public function organization() {
		if(is_numeric($this->uri->segment(3))){
			$data = [
				'applicant_form_open' => $this->layout->modal_form_open('Applicant', 'home/organization/'.$this->uri->segment(3), true),
				'applicant_form_close' => $this->layout->modal_form_close('Apply'),
				'organization_value' => $this->model_home->organization_value(['organization_id' => $this->uri->segment(3)]),
			];
			//Register Applicant
			if(isset($_FILES['applicant_requirement_file_path0'])){
				if($this->model_home->applicant_organizations_count([
					'organization_id' => $this->uri->segment(3), 
					'applicant_id' => $this->session->login_id,
					'applicant_organization_status' => 'Pending']) == 0){
					$this->load->model('applicants/model_applicants');
					//Insert Applicant Organization
					$values = [
						'applicant_id' => $this->session->login_id,
						'organization_id' => $this->uri->segment(3),
						'applicant_organization_status' => 'Pending'
					];
					$applicant_organization_id = $this->model_applicants->applicant_organization_insert($values);
					//Upload Files
					$count = 0; $is_stopped = false;
					$applicant_value = $this->model_applicants->applicant_value(['applicant_id' => $this->session->login_id]);
					foreach ($this->model_home->organization_requirements(['organization_id' => $this->uri->segment(3)]) as $row) {
						if(isset($_FILES['applicant_requirement_file_path'. $count])){
							$ext = explode('.', $_FILES['applicant_requirement_file_path'. $count]['name']);
							$new_name = $applicant_organization_id .'-'. $count .'-'. $applicant_value['applicant_lastname'] .'.'. $ext[1];
							if(move_uploaded_file($_FILES['applicant_requirement_file_path'. $count]['tmp_name'], './assets/upload/'.$new_name)){
								$this->model_applicants->applicant_requirement_insert([
										'applicant_organization_id' => $applicant_organization_id,
										'applicant_requirement_file_path' => $new_name,
										'organization_id' => $this->uri->segment(3)
									]);
							}else{
								$is_stopped = true;
								break;
							}
						}
						$count++;
					}
					if($is_stopped){
						//Delete Requirement & Applicant
						$this->model_applicants->applicant_requirement_delete(['applicant_organization_id' => $applicant_organization_id]);
						$this->model_applicants->applicant_organization_delete(['applicant_organization_id' => $applicant_organization_id]);
						$data['notification'] = $this->layout->notification(3, 'Some files were not uploaded. Applicant failed to apply. Please try again.');
					}else{
						$data['notification'] = $this->layout->notification(1, 'Successfully applied an applicant.');
					}
				}else{
					$data['notification'] = $this->layout->notification(2, 'Applicant already applied in this Organization.');
				}
			}
			$data['applicants_count'] = $this->model_home->applicant_organizations_count(['organization_id' => $this->uri->segment(3), 'applicant_organization_status' => 'Pending']);
			$this->load->view('interface/home/main_organization', $data);
		}else{
			redirect('home');
		}
	}

	private function validate(){
		$this->form_validation->set_rules('applicant_firstname', 'First Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_middlename', 'Middle Name', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_lastname', 'Last Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_gender', 'Gender', 'trim|required|alpha');
		$this->form_validation->set_rules('applicant_birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('applicant_address', 'Address', 'trim');
		$this->form_validation->set_rules('applicant_mobile', 'Mobile', 'trim|numeric');
		$this->form_validation->set_rules('applicant_email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('applicant_username', 'Username', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('applicant_password1', 'Password', 'trim|required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('applicant_password2', 'Confirm Password', 'trim|required|matches[applicant_password1]');
		if ($this->form_validation->run() == TRUE) {
			return [
				'applicant_firstname' => $this->input->post('applicant_firstname'),
				'applicant_middlename' => $this->input->post('applicant_middlename'),
				'applicant_lastname' => $this->input->post('applicant_lastname'),
				'applicant_gender' => $this->input->post('applicant_gender'),
				'applicant_birthdate' => $this->input->post('applicant_birthdate'),
				'applicant_address' => $this->input->post('applicant_address'),
				'applicant_mobile' => $this->input->post('applicant_mobile'),
				'applicant_email_address' => $this->input->post('applicant_email_address'),
				'applicant_username' => $this->input->post('applicant_username'),
				'applicant_password' => $this->input->post('applicant_password1'),
			];
		}else{
			return validation_errors();
		}
	}

	public function register(){
		$result = [];
		if(is_array($this->validate())){
			if($this->model_home->applicants_count([
					'applicant_firstname' => $this->validate()['applicant_firstname'],
					'applicant_middlename' => $this->validate()['applicant_middlename'],
					'applicant_lastname' => $this->validate()['applicant_lastname']]) == 0){
				$this->load->model('applicants/model_applicants');
				$this->model_applicants->applicant_insert($this->validate());
				$result = [
					'notification' => $this->layout->notification(1, 'Successfully registered an applicant. Sign In to Apply Scholarships.')
				];
			}else{
				$result['notification'] = $this->layout->notification(2, 'Name of applicant already registered.');
			}
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('home');
	}

	public function ajax(){
		if($this->input->post('organization_type') == 'all' && $this->input->post('organization_course_type') == 'all' && strlen($this->input->post('search_keyword')) == 0){
			echo $this->model_home->organizations_grid();
		}
		else if($this->input->post('organization_type') == 'all' && $this->input->post('organization_course_type') == 'all' && strlen($this->input->post('search_keyword')) >= 1){
			echo $this->model_home->organization_courses_grid(null, null, $this->input->post('search_keyword'));
		}
		else if($this->input->post('organization_type') != 'all' && $this->input->post('organization_course_type') == 'all' && strlen($this->input->post('search_keyword')) >= 1){
			echo $this->model_home->organization_courses_grid(['organizations.organization_type' => $this->input->post('organization_type')], null, $this->input->post('search_keyword'));
		}
		else if($this->input->post('organization_type') != 'all' && $this->input->post('organization_course_type') == 'all' && strlen($this->input->post('search_keyword')) == 0){
			echo $this->model_home->organization_courses_grid(['organizations.organization_type' => $this->input->post('organization_type')], null);
		}
		else if($this->input->post('organization_type') == 'all' && $this->input->post('organization_course_type') != 'all' && strlen($this->input->post('search_keyword')) >= 1){
			echo $this->model_home->organization_courses_grid(null, ['organization_course_type' => $this->input->post('organization_course_type')], $this->input->post('search_keyword'));
		}
		else if($this->input->post('organization_type') == 'all' && $this->input->post('organization_course_type') != 'all' && strlen($this->input->post('search_keyword')) == 0){
			echo $this->model_home->organization_courses_grid(null, ['organization_course_type' => $this->input->post('organization_course_type')]);
		}
		else if($this->input->post('organization_type') != 'all' && $this->input->post('organization_course_type') != 'all' && strlen($this->input->post('search_keyword')) >= 1){
			echo $this->model_home->organization_courses_grid(['organizations.organization_type' => $this->input->post('organization_type')], ['organization_course_type' => $this->input->post('organization_course_type')], $this->input->post('search_keyword'));
		}
		else if($this->input->post('organization_type') != 'all' && $this->input->post('organization_course_type') != 'all' && strlen($this->input->post('search_keyword')) == 0){
			echo $this->model_home->organization_courses_grid(['organizations.organization_type' => $this->input->post('organization_type')], ['organization_course_type' => $this->input->post('organization_course_type')]);
		}
	}

}
