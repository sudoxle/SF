<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class System extends Core_Controller  {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_system');
		$this->load->model('applicants/model_applicants');
		$this->load->model('organizations/model_organization_requirements');
		$this->load->model('organizations/model_organization_users');
	}

	public function index() {
		if(!$this->session->has_userdata('login_id')){
			redirect('home');
		}
		$data = [
			'web_title' => 'Scholarship Finder System | System',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id]),
			
		];
		if($this->session->login_type == 'Organization Admin'){
			$organizations_stats = [];
			$this->load->model('model_home');
			foreach ($this->model_system->organizations(['organization_id' => $this->session->organization_id]) as $row) {
				array_push($organizations_stats, [
					'organization_name' => $row->organization_name,
					'applicants_count_pending' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Pending']),
					'applicants_count_approved' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Approved']),
					'applicants_count_disapproved' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Disapproved']),
				]);
			}
			$admin_data = [
				'applicants_table' => $this->model_system->applicants_table(['organizations.organization_id' => $this->session->organization_id]),
				'applicant_form_open' => $this->layout->modal_form_open('Applicant', ''),
				'applicant_form_close' => $this->layout->modal_form_close(),
				'applicant_del_modal' => $this->layout->confirmation('Applicant Delete', 'Are you sure you want to remove?'),
				'applicant_approve_form_open' => $this->layout->modal_form_open('Applicant Approve', 'system/approve'),
				'applicant_approve_form_close' => $this->layout->modal_form_close('Approve'),
				'applicant_disapprove_form_open' => $this->layout->modal_form_open('Applicant Disapprove', 'system/disapprove'),
				'applicant_disapprove_form_close' => $this->layout->modal_form_close('Disapprove'),
				'organizations_table' => $this->model_system->organizations_table(['organization_id' => $this->session->organization_id]),
				'organization_requirement_form_open' => $this->layout->modal_form_open('Organization Requirement', ''),
				'organization_requirement_form_close' => $this->layout->modal_form_close(),
				'organization_users_table' => $this->model_system->organization_users_table(['organizations.organization_id' => $this->session->organization_id]),
				'organization_user_form_open' => $this->layout->modal_form_open('Organization User', 'system/insert_organization_user'),
				'organization_user_form_close' => $this->layout->modal_form_close(),
			];
			$this->load->view('interface/system/index_org_admin', array_merge($data, $admin_data, ['organizations_stats' => $organizations_stats]));
		}else if($this->session->login_type == 'Applicant'){
			$data = array_merge($data, [
				'applicant_form_open' => $this->layout->modal_form_open('Applicant', 'system', true),
				'applicant_form_close' => $this->layout->modal_form_close('Apply'),
			]);
			$applicant_data = $this->model_applicants->applicant_value(['applicant_id' => $this->session->login_id]);
			$applicant_organizations_data = $this->model_system->applicant_organizations_list(['applicant_id' => $this->session->login_id]);
			//Register Applicant
			if(isset($_FILES['applicant_requirement_file_path0'])){
				$this->load->model('model_home');
				$this->load->model('applicants/model_applicants');
				//Insert Applicant Organization
				$values = [
					'applicant_organization_status' => 'Pending'
				];
				$applicant_organization_id = $this->model_applicants->applicant_organization_update([
					'applicant_id' => $this->session->login_id,
					'organization_id' => $this->input->post('organization_id')], $values);
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
					$data['notification'] = $this->layout->notification(1, 'Successfully re-applied an applicant.');
				}
			}
			$this->load->view('interface/system/index_applicant', array_merge($data, $applicant_data, ['applicant_organizations_list' => $applicant_organizations_data]));
		}else{
			$organizations_stats = [];
			$this->load->model('model_home');
			foreach ($this->model_system->organizations() as $row) {
				array_push($organizations_stats, [
					'organization_name' => $row->organization_name,
					'applicants_count_pending' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Pending']),
					'applicants_count_approved' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Approved']),
					'applicants_count_disapproved' => $this->model_home->applicant_organizations_count(['organization_id' => $row->organization_id, 'applicant_organization_status' => 'Disapproved']),
				]);
			}
			$this->load->view('interface/system/index', array_merge($data, ['organizations_stats' => $organizations_stats]));
		}
	}

	public function page_not_found(){
		$data = [
			'web_title' => 'Scholarship Finder System | Page Not Found',
			'modules' => $this->model_system->user_modules(['user_id' => $this->session->login_id])
		];
		if($this->session->has_userdata('login_id')){
			$this->load->view('resources/pages/logged.php', $data);
		}else{
			$this->load->view('resources/pages/not_logged.php', $data);
		}
	}

	//APPLICANTS
	private function validate(){
		$this->form_validation->set_rules('applicant_firstname', 'First Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_middlename', 'Middle Name', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_lastname', 'Last Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('applicant_gender', 'Gender', 'trim|required|alpha');
		$this->form_validation->set_rules('applicant_birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('applicant_address', 'Address', 'trim');
		$this->form_validation->set_rules('applicant_mobile', 'Mobile', 'trim|numeric');
		$this->form_validation->set_rules('applicant_email_address', 'Email Address', 'trim|required|valid_email');
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
			];
		}else{
			return validation_errors();
		}
	}

	public function update(){
		$result = [];
		if(is_array($this->validate())){
			$this->model_applicants->applicant_update(['applicant_id' => $this->input->post('applicant_id')], $this->validate());
			$result = [
				'applicants_table' => $this->model_system->applicants_table(['organizations.organization_id' => $this->session->organization_id]),
				'notification' => $this->layout->notification(1, 'Successfully updated an applicant.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate());
		}
		echo json_encode($result);
	}

	public function delete(){
		$result = [];
		if($this->input->post('applicant_id')){
			//Delete Applicant Requirements
			$this->load->helper('file');
			foreach ($this->model_applicants->applicant_requirements(['applicant_id' => $this->input->post('applicant_id')]) as $row) {
				unlink('./assets/upload/'. $row->applicant_requirement_file_path);
			}
			$this->model_applicants->applicant_requirement_delete(['applicant_id' => $this->input->post('applicant_id')]);
			//Delete Applicant
			$this->model_applicants->applicant_delete(['applicant_id' => $this->input->post('applicant_id')]);
			$result = [
				'applicants_table' => $this->model_system->applicants_table(['organizations.organization_id' => $this->session->organization_id]),
				'notification' => $this->layout->notification(1, 'Successfully deleted an applicant.')
			];
		}
		echo json_encode($result);
	}

	public function approve(){
		$result = [];
		if($this->input->post('applicant_id')){
			if($this->is_internet_connected()){
				//Send Email to Notify
				$is_sent = false;
				foreach ($this->model_applicants->applicants(['applicant_organization_id' => $this->input->post('applicant_organization_id')]) as $row) {
					$config = [
						'fullname' => 'Scholarship Finder',
						'email_to' => $row->applicant_email_address,
						'subject' => $row->organization_name .': Scholarship Approved',
						'message' => $this->input->post('message')
					];
					$is_sent = $this->email($config) ? true:false;
					if($is_sent){
						$this->model_applicants->applicant_organization_message_insert([
							'applicant_organization_message' => $config['message'],
							'applicant_organization_message_status' => 'Approved',
							'applicant_organization_id' => $this->input->post('applicant_organization_id'),
						]);
					}
				}
				//Update Applicant
				if($is_sent){
					$this->model_applicants->applicant_organization_update(['applicant_organization_id' => $this->input->post('applicant_organization_id')], ['applicant_organization_status' => 'Approved']);
					$result = [
						'applicants_table' => $this->model_applicants->applicants_table(['organizations.organization_id' => $this->session->organization_id]),
						'notification' => $this->layout->notification(1, 'Successfully approved an applicant. Email notification sent.')
					];
				}else{
					$result['notification'] = $this->layout->notification(2, 'Failed to approve due to Email Notification Failed to sent. Please check Network.');
				}
			}else{
				$result['notification'] = $this->layout->notification(2, 'Failed to approve due to No Internet Connection.');
			}
		}
		echo json_encode($result);
	}

	public function disapprove(){
		$result = [];
		if($this->input->post('applicant_id')){
			if($this->is_internet_connected()){
				//Send Email to Notify
				$is_sent = false;
				foreach ($this->model_applicants->applicants(['applicant_organization_id' => $this->input->post('applicant_organization_id')]) as $row) {
					$config = [
						'fullname' => 'Scholarship Finder',
						'email_to' => $row->applicant_email_address,
						'subject' => $row->organization_name .': Scholarship Disapproved',
						'message' => $this->input->post('message')
					];
					$is_sent = $this->email($config) ? true:false;
					if($is_sent){
						$this->model_applicants->applicant_organization_message_insert([
							'applicant_organization_message' => $config['message'],
							'applicant_organization_message_status' => 'Disapproved',
							'applicant_organization_id' => $this->input->post('applicant_organization_id'),
						]);
					}
				}
				//Update Applicant
				if($is_sent){
					$this->model_applicants->applicant_organization_update(['applicant_organization_id' => $this->input->post('applicant_organization_id')], ['applicant_organization_status' => 'Disapproved']);
					$result = [
						'applicants_table' => $this->model_applicants->applicants_table(['organizations.organization_id' => $this->session->organization_id]),
						'notification' => $this->layout->notification(1, 'Successfully disapproved an applicant. Email notification sent.')
					];
				}else{
					$result['notification'] = $this->layout->notification(2, 'Failed to disapprove due to Email Notification Failed to sent. Please check Network.');
				}
			}else{
				$result['notification'] = $this->layout->notification(2, 'Failed to disapprove due to No Internet Connection.');
			}
		}
		echo json_encode($result);
	}

	//ORGANIZATION REQUIREMENTS
	public function update_organization(){
		$result = [];
		if($this->input->post('organization_id')){
			//Delete Requirements & Courses
			$this->model_organization_requirements->organization_course_delete(['organization_id' => $this->input->post('organization_id')]);
			$this->model_organization_requirements->organization_requirement_delete(['organization_id' => $this->input->post('organization_id')]);
			//Insert Requirements & Courses
			$count = 0;
			foreach ($this->input->post('organization_course[]') as $organization_course) {
				$this->model_organization_requirements->organization_course_insert([
					'organization_course' => $organization_course .'; ('. $this->input->post('organization_school[]')[$count] .')',
					'organization_course_type' => $this->input->post('organization_course_type[]')[$count],
					'organization_id' => $this->input->post('organization_id')
				]);
				$count++;
			}
			$count = 0;
			foreach ($this->input->post('organization_requirement_description[]') as $organization_requirement_description) {
				$this->model_organization_requirements->organization_requirement_insert([
					'organization_requirement_description' => $organization_requirement_description,
					'organization_requirement_is_uploadable' => empty($this->input->post('organization_requirement_is_uploadable[]')[$count]) ? '':$this->input->post('organization_requirement_is_uploadable[]')[$count],
					'organization_id' => $this->input->post('organization_id')
				]);
				$count++;
			}
			$result = [
				'organizations_table' => $this->model_system->organizations_table(['organization_id' => $this->session->organization_id]),
				'notification' => $this->layout->notification(1, 'Successfully updated an organization requirements and courses.')
			];
		}
		echo json_encode($result);
	}

	//ORGANIZATION USERS
	private function validate_organization_user(){
		$this->form_validation->set_rules('organization_user_username', 'Username', 'trim|required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('organization_user_password', 'Password', 'trim|required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('organization_user_fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('organization_user_gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('organization_user_birthdate', 'Birthdate', 'trim|required');
		$this->form_validation->set_rules('organization_user_address', 'Address', 'trim');
		$this->form_validation->set_rules('organization_user_mobile', 'Contact No.', 'trim|numeric');
		$this->form_validation->set_rules('organization_user_email_address', 'Email Address', 'trim|required|valid_email');
		if ($this->form_validation->run() == TRUE) {
			return [
				'organization_user_username' => $this->input->post('organization_user_username'),
				'organization_user_password' => $this->input->post('organization_user_password'),
				'organization_user_fullname' => $this->input->post('organization_user_fullname'),
				'organization_user_gender' => $this->input->post('organization_user_gender'),
				'organization_user_birthdate' => $this->input->post('organization_user_birthdate'),
				'organization_user_address' => $this->input->post('organization_user_address'),
				'organization_user_mobile' => $this->input->post('organization_user_mobile'),
				'organization_user_email_address' => $this->input->post('organization_user_email_address'),
				'organization_id' => $this->session->organization_id,
			];
		}else{
			return validation_errors();
		}
	}

	public function insert_organization_user(){
		$result = [];
		if(is_array($this->validate_organization_user())){
			$this->model_organization_users->organization_user_insert($this->validate_organization_user());
			$result = [
				'organization_users_table' => $this->model_system->organization_users_table(['organizations.organization_id' => $this->session->organization_id]),
				'notification' => $this->layout->notification(1, 'Successfully added an organization user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_organization_user());
		}
		echo json_encode($result);
	}

	public function update_organization_user(){
		$result = [];
		if(is_array($this->validate_organization_user())){
			$this->model_organization_users->organization_user_update(['organization_user_id' => $this->input->post('organization_user_id')], $this->validate_organization_user());
			$result = [
				'organization_users_table' => $this->model_system->organization_users_table(['organizations.organization_id' => $this->session->organization_id]),
				'notification' => $this->layout->notification(1, 'Successfully updated an organization user.')
			];
		}else{
			$result['notification'] = $this->layout->notification(2, $this->validate_organization_user());
		}
		echo json_encode($result);
	}

	public function ajax(){
		//APPLICANT VALUE
		if($this->input->post('applicant_id')){
			echo json_encode($this->model_applicants->applicant_value(['applicant_id' => $this->input->post('applicant_id')]));
		}
		// APPLICANTS TABLE
		else if($this->input->post('status_filter')){
			if($this->input->post('status_filter') == 'all'){
				echo $this->model_system->applicants_table(['organizations.organization_id' => $this->session->organization_id]);
			}else{
				echo $this->model_system->applicants_table([
					'applicant_organization_status' => $this->input->post('status_filter'),
					'organizations.organization_id' => $this->session->organization_id
				]);
			}
		}
		//ORGANIZATION REQUIREMENT & COURSE VALUE
		else if($this->input->post('organization_id')){
			$organization_course_array = $this->model_organization_requirements->organization_course_value(['organization_id' => $this->input->post('organization_id')]);
			$organization_requirement_array = $this->model_organization_requirements->organization_requirement_value(['organization_id' => $this->input->post('organization_id')]);
			echo json_encode([
				'organization_course' => $organization_course_array, 
				'organization_requirement' => $organization_requirement_array, 
			]);
		}
		//ORGANIZATION USER VALUE
		else if($this->input->post('organization_user_id')){
			echo json_encode($this->model_organization_users->organization_user_value(['organization_user_id' => $this->input->post('organization_user_id')]));
		}
		//ORGANIZATION REQUIREMENTS
		else if($this->input->post('organization_requirements')){
			$count = 0;
			$this->load->model('model_home');
			foreach ($this->model_home->organization_value(['organization_id' => $this->input->post('organization_requirements')])['organization_requirements'] as $value) {
                if($value['organization_requirement_is_uploadable'] == 'uploadable'){
                    echo '<div class="form-group">
                        <label>'. $value['organization_requirement_description'] .' </label>
                        <input type="file" name="applicant_requirement_file_path'. $count .'" required>
                    </div>';
                }
                $count++;
            }
		}
	}

}